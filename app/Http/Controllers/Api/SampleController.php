<?php

namespace App\Http\Controllers\Api;

use App\Events\NewEcgData;
use App\Helpers\DiveParser;
use App\Http\Controllers\Controller;
use App\Models\Dive;
use App\Models\Sensor;
use App\Models\SensorsPerDay;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use InfluxDB2\Client;
use InfluxDB2\Model\WritePrecision;
use InfluxDB2\Point;
use InfluxDB2\WriteType as WriteType;



class SampleController extends Controller
{
    public function store (Request $request)
    {
        # You can generate a Token from the "Tokens Tab" in the UI
        $token = env("INFLUX_TOKEN");
        $org = env("INFLUX_ORG");
        $bucket = env("INFLUX_BUCKET");

        $client = new Client([
            "url" => env("INFLUX_URL"),
            "token" => $token,
            "org" => $org,
            "debug" => false,
            "timeout"=>0
        ]);
        $writeApi = $client->createWriteApi();
        ini_set('max_execution_time',120);
        $validator = Validator::make($this->toSnakeCase($request->all()), [
            'data' => 'required|array'

        ]);

        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $respose=[];
        $samples=$request['data'];
        $status=200;
        $insertedSensors=[];
        $datas=[];
        $userId=null;
        foreach ($samples as $idx=>$sample){
            $validator = Validator::make($sample, [
                "date"=>'required|integer|between:0,2147483648',
                "value"=>'required|array',
                "value.*"=>'numeric',
                "userId"=>'required|integer|exists:users,id',
                "measureType"=>'required|string|exists:sensors,name',
            ]);
            $ecgEvent=[];
            if ($validator->fails())
            {
                $status=422;
                continue;
            }
            $errors=false;
            $sensor=Sensor::firstWhere('name',$sample['measureType']);


            if (!$sensor){
                $errors=true;
                $status=422;
            }
            else {
                $sample['sensor_id'] = $sensor->id;
                $sample['measureType'];
            }
            if (!$errors) {
                if (is_array($sample['value'])){
                    $delta=1000/count($sample['value']);
                    $time=Carbon::createFromTimestamp($sample['date'])->timezone('UTC');

                    foreach ($sample['value'] as $val) {

                        $datas[]=Point::measurement($sample['measureType'])
                            ->addTag('user_id', strval($sample['userId']))
                            ->addField('value', (float)$val)
                            ->time( (int)($time->getPreciseTimestamp()/1000));

                        /*$datas[]=['name' =>  $sample['measureType'],
                            'tags' => ['user_id' => strval($sample['userId'])],
                            'fields' => ['value' => $val],
                            //'time' => (int)$time->getPreciseTimestamp()
                            'time' => (int)($time->getPreciseTimestamp(6))
                        ];*/


                        if ($sensor->name=='Ecg') {
                            $d['x']=$time->getPreciseTimestamp()/1000;
                            $d['y']=round((float)$val * 1000, 0);

                            $userId=$sample['userId'];
                            $ecgEvent[]=$d;

                        }
                        $time=$time->addMicroseconds(floor($delta*1000));
                    }

                } else {
                    $datas[]=Point::measurement($sample['measureType'])
                        ->addTag('user_id', strval($sample['userId']))
                        ->addField('value', (float)$sample['value'])
                        ->time( $sample['date']);

                }
                if ($ecgEvent) {
                    event(new NewEcgData($userId, json_encode($ecgEvent)));
                }
                $currentDate=Carbon::createFromTimestamp($sample['date'])->previous('00:00');
                if (!isset($insertedSensors[$currentDate->format('Y-m-d H:i:s.u')]) || !in_array($sample['sensor_id'], $insertedSensors[$currentDate->format('Y-m-d H:i:s.u')])){
                    $insertedSensors[$currentDate->format('Y-m-d H:i:s.u')][]=$sample['sensor_id'];
                }
            }

        }
        foreach ($insertedSensors as $date=>$sensorsIds) {
            $currentSensorsPerDay=SensorsPerDay::firstOrNew (['date' => $date,'user_id'=>$sample['userId']]);
            if (is_array($currentSensorsPerDay->sensors))
                $currentSensorsPerDay->sensors=array_unique(array_merge($currentSensorsPerDay->sensors,$sensorsIds));
            else
                $currentSensorsPerDay->sensors=$sensorsIds;
            $currentSensorsPerDay->save();
        }
        foreach ($datas as $data){
            $writeApi->write($data, WritePrecision::MS, $bucket, $org);
            //DB::table('samples')->insertOrIgnore($data->toArray());
        }

        if ($status==200)
            $respose['message']='All samples created successfully';
        else
            $respose['message']='One or more samples were invalid';
        return response($respose, $status);
    }

    public function storeDives(Request $request)
    {
        # You can generate a Token from the "Tokens Tab" in the UI

        ini_set('max_execution_time', 0);
        $validator = Validator::make($this->toSnakeCase($request->all()), [
            'data' => 'required|array'

        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
        $respose = [];
        $dives = $request['data'];
        $status = 200;
        $userId = null;
        $gdras = [];
        foreach ($dives as $idx => $dive) {
            $validator = Validator::make($dive, [
                "datetime" => 'required|integer|between:0,2147483648',
                "diveId" => 'required',
                "userId" => 'required|integer|exists:users,id',
                "divepoints" => 'required|array',
            ]);
            $diveParser= new DiveParser($dive,'oc',$dive['userId']);
            $result=$diveParser->parseConftech();
            if (isset($result['warning']) && $result['warning'])
                $status=202;
            $d=data_get($result,'createdDives.0',null);
            $gdras[]=[
                'diveId'=>$dive['diveId'],
                'gdra'=> $d ? $d->faceColor() : null,
                'error'=> data_get($result,'warning',null)
            ];

        }
        if ($status == 200)
            $respose['message'] = 'All dives created successfully';
        else
            $respose['message'] = 'One or more dives were invalid';
        $respose['result'] = $gdras;
        return response($respose, $status);
    }

    private function toSnakeCase($array)
    {
        $snakeCase = array();
        foreach ($array as $name => $value) {
            $snakeCase[Str::snake($name)] = $value;
        }
        return $snakeCase;
    }
}
