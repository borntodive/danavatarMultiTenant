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

use InfluxDB2\Client;
use InfluxDB2\Model\WritePrecision;
use InfluxDB2\Point;
use InfluxDB2\WriteType as WriteType;



class SampleController extends Controller
{
    public function store(Request $request)
    {
        # You can generate a Token from the "Tokens Tab" in the UI
        $token = '2N8qnyK4qyHSfQaZYEoXOdUDkrp9fMx1FPBBnu9VgBREGnRMczw1U2xcNT-aGL4rz7esMjHr10nhTL4Gb6yhZg==';
        $org = 'danrni';

        $bucket = env('INFLUX_BUCKET');

        $client = new Client([
            "url" => env('INFLUX_URL'),
            "token" => $token,
        ]);
        //$writeApi = $client->createWriteApi( ["writeType" => WriteType::BATCHING, 'batchSize' => 1000]);
        $writeApi = $client->createWriteApi();
        ini_set('max_execution_time', 0);
        $validator = Validator::make($this->toSnakeCase($request->all()), [
            'data' => 'required|array'

        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
        $respose = [];
        $samples = $request['data'];
        $status = 200;
        $insertedSensors = [];
        $datas = [];
        $userId = null;
        foreach ($samples as $idx => $sample) {
            $validator = Validator::make($sample, [
                "date" => 'required|integer|between:0,2147483648',
                "value" => 'required|array',
                "value.*" => 'numeric',
                "userId" => 'required|integer|exists:users,id',
                "measureType" => 'required|string|exists:sensors,name',
            ]);
            $ecgEvent = [];
            if ($validator->fails()) {
                $status = 422;
                continue;
            }
            $errors = false;
            $sensor = Sensor::firstWhere('name', $sample['measureType']);


            if (!$sensor) {
                $errors = true;
                $status = 422;
            } else {
                $sample['sensor_id'] = $sensor->id;
                $sample['measureType'];
            }
            if (!$errors) {
                if (is_array($sample['value'])) {
                    $delta = 1000 / count($sample['value']);
                    $delta = 20;
                    $time = Carbon::createFromTimestamp($sample['date'])->timezone('UTC');

                    foreach ($sample['value'] as $val) {

                        $data = Point::measurement($sample['measureType'])
                            ->addTag('user_id', strval($sample['userId']))
                            ->addField('value', (float)$val)
                            ->time((int)($time->getPreciseTimestamp() / 1000));
                        //$data = $sample['measureType'] . ',user_id=' . strval($sample['userId']) . ' value="' . (float)$val . '" ' . (int)($time->getPreciseTimestamp() / 1000);


                        $writeApi->write($data, WritePrecision::MS, $bucket, $org);

                        /*$datas[]=['name' =>  $sample['measureType'],
                            'tags' => ['user_id' => strval($sample['userId'])],
                            'fields' => ['value' => $val],
                            //'time' => (int)$time->getPreciseTimestamp()
                            'time' => (int)($time->getPreciseTimestamp(6))
                        ];*/


                        if ($sensor->name == 'Ecg') {
                            $d['x'] = $time->getPreciseTimestamp() / 1000;
                            $d['y'] = round((float)$val * 1000, 0);

                            $userId = $sample['userId'];
                            $ecgEvent[] = $d;
                        }
                        $time = $time->addMicroseconds(floor($delta * 1000));
                    }
                } else {
                    $data = Point::measurement($sample['measureType'])
                        ->addTag('user_id', strval($sample['userId']))
                        ->addField('value', (float)$sample['value'])
                        ->time($sample['date']);
                    //$data = $sample['measureType'] . ',user_id=' . strval($sample['userId']) . ' value="' . (float)$sample['value'] . '" ' . (int)($time->getPreciseTimestamp() / 1000);
                    $writeApi->write($data, WritePrecision::MS, $bucket, $org);
                }
                if ($ecgEvent) {
                    event(new NewEcgData($userId, json_encode($ecgEvent)));
                }
                $currentDate = Carbon::createFromTimestamp($sample['date'])->previous('00:00');
                if (!isset($insertedSensors[$currentDate->format('Y-m-d H:i:s.u')]) || !in_array($sample['sensor_id'], $insertedSensors[$currentDate->format('Y-m-d H:i:s.u')])) {
                    $insertedSensors[$currentDate->format('Y-m-d H:i:s.u')][] = $sample['sensor_id'];
                }
            }
        }
        foreach ($insertedSensors as $date => $sensorsIds) {
            $currentSensorsPerDay = SensorsPerDay::firstOrNew(['date' => $date, 'user_id' => $sample['userId']]);
            if (is_array($currentSensorsPerDay->sensors))
                $currentSensorsPerDay->sensors = array_unique(array_merge($currentSensorsPerDay->sensors, $sensorsIds));
            else
                $currentSensorsPerDay->sensors = $sensorsIds;
            $currentSensorsPerDay->save();
        }



        if ($status == 200)
            $respose['message'] = 'All samples created successfully';
        else
            $respose['message'] = 'One or more samples were invalid';
        return response($respose, $status);
    }

    public function storeDives(Request $request)
    {
        # You can generate a Token from the "Tokens Tab" in the UI
        $token = '2N8qnyK4qyHSfQaZYEoXOdUDkrp9fMx1FPBBnu9VgBREGnRMczw1U2xcNT-aGL4rz7esMjHr10nhTL4Gb6yhZg==';
        $org = 'danrni';

        $bucket = env('INFLUX_BUCKET');

        $client = new Client([
            "url" => env('INFLUX_URL'),
            "token" => $token,
        ]);
        //$writeApi = $client->createWriteApi( ["writeType" => WriteType::BATCHING, 'batchSize' => 1000]);
        $writeApi = $client->createWriteApi();
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
        foreach ($dives as $idx => $dive) {
            $validator = Validator::make($dive, [
                "datetime" => 'required|integer|between:0,2147483648',
                "diveId" => 'required',
                "userId" => 'required|integer|exists:users,id',
                "divepoints" => 'required|array',
            ]);
            $userId = $dive['userId'];
            $diveId = $dive['diveId'];
            $diveDate = Carbon::createFromTimestamp($dive['datetime'])->timezone('UTC');
            $lastO2=null;
            $lastHe=null;
           // "gases": { "o2": <int>, "he": <int>}
            foreach ($dive['divepoints'] as $divepoint) {
                $dvTime = Carbon::createFromTimestamp($divepoint['time'])->timezone('UTC');
                if (isset($divepoint['gases']['o2']) && isset($divepoint['gases']['he'])) {
                    if ($divepoint['gases']['o2']!=$lastO2 || $divepoint['gases']['he']!=$lastHe) {
                       $lastO2=(int)$divepoint['gases']['o2'];
                       $lastHe=(int)$divepoint['gases']['he'];

                    }
                }
                if (!$lastO2 || !$lastHe) {
                    $lastO2=21;
                    $lastHe=0;
                }
                $data = Point::measurement('dive')
                    ->addTag('user_id', strval($userId))
                    ->addTag('dive_id', strval($diveId))
                    ->addTag('o2', strval($lastO2))
                    ->addTag('he', strval($lastHe))
                    ->addTag('temperature', (float)$divepoint['temperature'])
                    ->addField('value', (float)$divepoint['depth'])
                    ->time((int)($dvTime->getPreciseTimestamp() / 1000));
                $writeApi->write($data, WritePrecision::MS, $bucket, $org);
            }
        };



        if ($status == 200)
            $respose['message'] = 'All samples created successfully';
        else
            $respose['message'] = 'One or more samples were invalid';
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
