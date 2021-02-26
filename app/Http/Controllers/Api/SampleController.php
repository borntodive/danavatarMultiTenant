<?php

namespace App\Http\Controllers\Api;

use App\Events\NewEcgData;
use App\Http\Controllers\Controller;
use App\Models\Sensor;
use App\Models\SensorsPerDay;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SampleController extends Controller
{
    public function store (Request $request)
    {
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
        $ecgEvent=null;
        $userId=null;
        foreach ($samples as $idx=>$sample){
            $validator = Validator::make($sample, [
                "date"=>'required|integer|between:0,2147483648',
                "value"=>'required|array',
                "value.*"=>'numeric',
                "userId"=>'required|integer|exists:users,id',
                "projectId"=>'sometimes|integer|exists:projects,id',
                "measureType"=>'required|string|exists:sensors,name',
            ]);
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
                unset($sample['measureType']);
            }
            if (!$errors) {
                if (is_array($sample['value'])){
                    $delta=1000/count($sample['value']);
                    $time=Carbon::createFromTimestamp($sample['date']);
                    foreach ($sample['value'] as $val) {
                        $datas[]=[
                            "time" => $time->format('Y-m-d H:i:s.u'),
                            "user_id" => $sample['userId'],
                            "sensor_id" => $sample['sensor_id'],
                            "value" => $val
                        ];
                        if ($sensor->name=='Ecg') {
                            $d['x']=$time->getPreciseTimestamp();
                            $d['y']=round((float)$val * 1000, 0);
                            $ecgEvent[]=$d;
                            $userId=$sample['userId'];
                        }
                        $time=$time->addMicroseconds(floor($delta*1000));
                    }

                } else {
                    $datas[]=[
                        "time" => $sample['date'],
                        "user_id" => $sample['userId'],
                        "sensor_id" => $sample['sensor_id'],
                        "value" => $sample['value']
                    ];

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
        if ($ecgEvent) {
            event(new NewEcgData($userId, json_encode($ecgEvent)));
        }
        foreach (collect($datas)->chunk(1000) as $data){

            DB::table('samples')->insert($data->toArray());
        }
        if ($status==200)
            $respose['message']='All samples created successfully';
        else
            $respose['message']='One or more samples were invalid';
        return response($respose, $status);
    }

    private function toSnakeCase($array){
        $snakeCase = array();
        foreach($array as $name => $value){
            $snakeCase[Str::snake($name)] = $value;
        }
        return $snakeCase;
    }

}
