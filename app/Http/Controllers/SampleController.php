<?php

namespace App\Http\Controllers;

use App\Enums\PositionEnum;
use App\Exports\SamplesExport;
use App\Models\Sample;
use App\Models\Sensor;
use App\Models\SensorsPerDay;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use InfluxDB2\Client;
use Maatwebsite\Excel\Facades\Excel;

class SampleController extends Controller
{
    public function index(Request $request, User $user)
    {
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

        $queryApi = $client->createQueryApi();
        $validator = Validator::make($request->all(), [
            'date'=>'required|date',

        ]);
        if ($validator->fails())
        {
            dd('validation error');
        }

        $date=$request->date;
        $sensorsPerDay=SensorsPerDay::where('date',$date)->where('user_id',$user->id)->first();
        if (!$sensorsPerDay)
        {
            dd('sensor per day error');
        }
        $sensors=[];
        $latests=[];
        $ecg=false;
        foreach ($sensorsPerDay->sensors as $sensorId) {
            $sensor=Sensor::findOrFail($sensorId);
            if ($sensor->name !=='Ecg')
                $sensors[]=$sensor;
            else
                $ecg=true;
            $allowedLatestSensors = [
                'BreathFrequency',
                'HeartRate',
                'Saturation',
                'Temperature',
                'Position'
            ];
            if (in_array($sensor->name,$allowedLatestSensors)){
                $dateArray=explode('-',$request->date);
                $searchData=Carbon::create($dateArray[0],$dateArray[1],$dateArray[2],0);
                $startTimeString=$searchData->toIso8601ZuluString();
                $endTimeString=$searchData->endOfDay()->toIso8601ZuluString();
                $q='from(bucket: "'.$bucket.'")
                      |> range(start: '.$startTimeString.', stop: '.$endTimeString.')
                      |> last()
                      |> filter(fn: (r) => r["_measurement"] == "'.$sensor->name.'")
                      |> filter(fn: (r) => r["user_id"] == "'.$user->id.'")';
                $records=$queryApi->query($q);
                $latestValue=$records[0]->records[0]->getValue();
                $l['sensor']=$sensor;
                if ($sensor->name != 'Position')
                    $l['latest']=round($latestValue,1);
                else
                    $l['latest']=__('samples.'.PositionEnum::fromValue((int)$latestValue)->key);

                $q='from(bucket: "'.$bucket.'")
                      |> range(start: '.$startTimeString.', stop: '.$endTimeString.')
                      |> last()
                      |> filter(fn: (r) => r["_measurement"] == "'.$sensor->name.'")
                      |> filter(fn: (r) => r["user_id"] == "'.$user->id.'")';
                $records=$queryApi->query($q);
                $latestValue=$records[0]->records[0]->getValue();
                $l['sensor']=$sensor;

                if ($sensor->name != 'Position') {
                    $q='from(bucket: "'.$bucket.'")
                      |> range(start: '.$startTimeString.', stop: '.$endTimeString.')
                      |> filter(fn: (r) => r["_measurement"] == "'.$sensor->name.'")
                      |> filter(fn: (r) => r["user_id"] == "'.$user->id.'")
                      |> aggregateWindow(every: 24h, fn: mean, createEmpty: false)
                      |> yield(name: "mean")';
                    $records=$queryApi->query($q);
                    $meanValue=$records[0]->records[0]->getValue();
                    $l['average'] = round($meanValue, 2);
                }
                else {
                    $q='from(bucket: "'.$bucket.'")
                      |> range(start: '.$startTimeString.', stop: '.$endTimeString.')
                      |> filter(fn: (r) => r["_measurement"] == "'.$sensor->name.'")
                      |> filter(fn: (r) => r["user_id"] == "'.$user->id.'")
                      |> median(method: "exact_selector")';
                    $records=$queryApi->query($q);
                    $meanValue=$records[0]->records[0]->getValue();
                    $l['average']=__('samples.'.PositionEnum::fromValue((int)$meanValue)->key);
                }

                $latests[]=$l;
            }
        }
        return view('wearable.samples', compact('user','date','sensors','ecg','latests'));
    }

    public function viewEcg (Request $request, User $user) {
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

        $queryApi = $client->createQueryApi();
        $validator = Validator::make($request->all(), [
            'date'=>'required|date',

        ]);
        if ($validator->fails())
        {
            abort(404);
        }

        $date=$request->date;
        $dateArray=explode('-',$request->date);
        $searchData=Carbon::create($dateArray[0],$dateArray[1],$dateArray[2],0);
        $endDate=$searchData->clone()->endOfDay();
        //$startTimeString="'".$searchData->toDateTimeString()."'";
        //$endTimeString="'".$searchData->endOfDay()->toDateTimeString()."'";
        $now=new Carbon();
        //$diffInSecs=$now->addDay()->diffInSeconds($searchData->addDay());
        //$availablesDate['first']=new Carbon();
        $q='from(bucket: "'.$bucket.'")   |> range(start: '.$searchData->toIso8601ZuluString().', stop: '.$endDate->toIso8601ZuluString().')
             |> last()
             |> filter(fn: (r) => r["_measurement"] == "Ecg") |> filter(fn: (r) => r["user_id"] == "'.$user->id.'")';
        $lastRecords = $queryApi->query($q);
        $availablesDate['last']=new Carbon($lastRecords[0]->records[0]->getTime(),"UTC");
        $q='from(bucket: "'.$bucket.'")   |> range(start: '.$searchData->toIso8601ZuluString().', stop: '.$endDate->toIso8601ZuluString().')
         |> first()
         |> filter(fn: (r) => r["_measurement"] == "Ecg") |> filter(fn: (r) => r["user_id"] == "'.$user->id.'")';
        $firstRecords = $queryApi->query($q);
        $availablesDate['first']=new Carbon($firstRecords[0]->records[0]->getTime());
        /*$pagination=Sample::selectRaw('time_bucket(\'5 minutes\', "time") AS "x",count(value) AS y')
            ->whereRaw('sensor_id = 6 AND user_id = '.$user->id)
            ->whereRaw("EXTRACT(MONTH FROM time) = {$dateArray[1]} AND EXTRACT(YEAR FROM time) = {$dateArray[0]}  AND EXTRACT(DAY FROM time) = {$dateArray[2]}")
            ->groupBy('x')->get();*/

        $pagination=[];
        return view('wearable.viewEcg', compact('user','date','availablesDate','pagination'));

    }

    public function viewEcgLive (Request $request, User $user) {

        return view('wearable.viewEcgLive', compact('user'));

    }

    /*
        ********
        * AJAX *
        ********
        */
    public function getSampleByMonth (Request $request) {
        $validator = Validator::make($request->all(), [
            "userId"=>'required|integer|exists:users,id',
            'month'=>'required|integer',
            'year'=>'required|integer'

        ]);
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        $user=User::findOrFail($request->userId);

        $sensorsPerDay=SensorsPerDay::query()
            ->whereRaw("EXTRACT(MONTH FROM date) = {$request->month} AND EXTRACT(YEAR FROM date) = {$request->year}  AND user_id = {$user->id}")
            ->get();
        $sensors=Sensor::all();
        $out=[];
        foreach ($sensorsPerDay as $s){
            $currDate=new Carbon($s->date);
            foreach ($sensors as $sensor){

                if (is_array($s->sensors) && in_array($sensor->id,$s->sensors)){
                    $out[$currDate->toDateString()][]=$sensor;
                } else if ($sensor->id==$s->sensors) {
                    $out[$currDate->toDateString()][]=$sensor;
                }
            }
        }
        return response()->json($out);
    }

    public function getSampleByYear (Request $request) {
        $validator = Validator::make($request->all(), [
            "userId"=>'required|integer|exists:users,id',
            'year'=>'required|integer'

        ]);
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }

        $user=User::findOrFail($request->userId);


        $sensorsPerDay=SensorsPerDay::query()
            ->whereRaw("EXTRACT(YEAR FROM date) = {$request->year}  AND user_id = {$user->id}")
            ->get();
        $sensors=Sensor::all();
        $out=[];
        foreach ($sensorsPerDay as $s){
            $currDate=new Carbon($s->date);
            foreach ($sensors as $sensor){

                if (is_array($s->sensors) && in_array($sensor->id,$s->sensors)){
                    $out[$currDate->month()][]=$sensor;
                } else if ($sensor->id==$s->sensors) {
                    $out[$$currDate->month()][]=$sensor;
                }
            }
        }
        return response()->json($out);
    }

    public function getSampleByDateAC(Request $request) {

        ini_set('memory_limit','2048M');
        $validator = Validator::make($request->all(), [
            "userId"=>'required|integer|exists:users,id',
            'date'=>'sometimes|date',
            "sensorId"=>'required|integer|exists:sensors,id',

        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $user= User::findOrFail($request->userId);
        $sensor= Sensor::findOrFail($request->sensorId);

        $selectString='time AS "x", value::DOUBLE PRECISION AS y';
        $group=false;
        $dateArray=explode('-',$request->date);
        $searchData=Carbon::create($dateArray[0],$dateArray[1],$dateArray[2],0);
        $startTimeString="'".$searchData->toDateTimeString()."'";
        $endTimeString="'".$searchData->addDay()->toDateTimeString()."'";
        $data=DB::table('samples')->select(DB::raw($selectString))
            ->whereRaw('time between '.$startTimeString.' and '.$endTimeString)
            ->whereRaw('sensor_id = '.$sensor->id.' AND user_id = '.$user->id)
            ->orderBy('x');

        if ($group){
            $data=$data->groupBy('x')
                ->get();
        }
        else
            $data=$data->get();

        $lastPosition=null;
        $firstPosition=null;
        $dataOut=[];
        $c=0;

        foreach ($data as $i=>$d){
            if ($sensor->name!='Position') {
                $currDate = new Carbon($d->x);
                $dataOut[$c]['x'] = $currDate->toDateTimeString();
                if ($sensor->id == 6)
                    $dataOut[$c]['y'] = round((float)$d->y * 1000, 0);
                else
                    $dataOut[$c]['y'] = (float)$d->y;
                $c++;
            }
            else {
                if (!$firstPosition) {
                    $firstPosition=$lastPosition=$d;
                }
                if ($lastPosition->y!=$d->y) {

                    $lastPosition=$d;
                    $currDate = new Carbon($d->x);
                    $startD=new Carbon($firstPosition->x);
                    $dataOut[$c]["category"]= "";
                    $dataOut[$c]["start"]= $startD->toDateTimeString();
                    $dataOut[$c]["end"]= $currDate->toDateTimeString();
                    $dataOut[$c]["color"]= $this->getPositionColor($d->y);
                    $dataOut[$c]["text"]= __('samples.'.PositionEnum::fromValue((int)$lastPosition->y)->key);
                    $dataOut[$c]["textDisabled"]= false;
                    $dataOut[$c]["icon"]= asset('storage/positions/'.$lastPosition->y.'.png');
                    $c++;
                    $firstPosition=$lastPosition=$d;
                }
            }
        }
        $out['data']=$dataOut;
        $out['sensor']=$sensor;
        return response()->json($out);

    }

    public function getSampleByDate(Request $request) {

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
        $queryApi = $client->createQueryApi();

        ini_set('memory_limit','2048M');
        $validator = Validator::make($request->all(), [
            "userId"=>'required|integer|exists:users,id',
            'date'=>'sometimes|date',
            "sensorId"=>'required|integer|exists:sensors,id',
            'startTime'=>'sometimes|integer',
            'endTime'=>'sometimes|integer'

        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $user= User::findOrFail($request->userId);
        $sensor= Sensor::findOrFail($request->sensorId);
        $group=true;
        if (isset($request->date)) {
            $dateArray=explode('-',$request->date);
            $searchData=Carbon::create($dateArray[0],$dateArray[1],$dateArray[2],0);
            $startTimeString=$searchData->toIso8601ZuluString();
            $endTimeString=$searchData->addDay()->toIso8601ZuluString();
            $now=new Carbon();
        } else if (isset($request->startTime) && isset($request->endTime)){

            $startTimeString=Carbon::createFromTimestampMs($request->startTime)->toIso8601ZuluString();
            $endTimeString=Carbon::createFromTimestampMs($request->endTime)->addDay()->toIso8601ZuluString();
        }
        else {
            return response($request->all(),200);
        }
        if ($sensor->name!='Position') {
            $q = 'from(bucket: "'.$bucket.'")
                          |> range(start: ' . $startTimeString . ', stop: ' . $endTimeString . ')
                          |> filter(fn: (r) => r["_measurement"] == "' . $sensor->name . '")
                          |> filter(fn: (r) => r["user_id"] == "' . $user->id . '")
                           |> aggregateWindow(every: 1s, fn: mean, createEmpty: false)
      |> yield(name: "mean")
                          ';
        }
        else {
            $q = 'from(bucket: "'.$bucket.'")
                          |> range(start: ' . $startTimeString . ', stop: ' . $endTimeString . ')
                          |> filter(fn: (r) => r["_measurement"] == "' . $sensor->name . '")
                          |> filter(fn: (r) => r["user_id"] == "' . $user->id . '")                          ';
        }
        $records=$queryApi->query($q);
        $lastPosition=0;
        $dataOut=[];
        $c=0;

        foreach ($records[0]->records as $record) {
            if ($sensor->name!='Position') {
                $currDate = new Carbon($record->getTime());
                $dataOut[$c]['x'] = $currDate->getPreciseTimestamp(3);
                if ($sensor->id == 6)
                    $dataOut[$c]['y'] = round((float)$record->getValue() * 1000, 0);
                else
                    $dataOut[$c]['y'] = (float)$record->getValue();
                $c++;
            }
            else {
                if ($lastPosition!=$record->getValue()) {

                    $lastPosition=$record->getValue();
                    $currDate = new Carbon($record->getTime());
                    $dataOut[$c]['x'] = $currDate->getPreciseTimestamp(3);
                    $dataOut[$c]['name'] =__('samples.'.PositionEnum::fromValue((int)$record->getValue())->key);
                    $dataOut[$c]['label'] = __('samples.'.PositionEnum::fromValue((int)$record->getValue())->key);;
                    $dataOut[$c]['color'] = $this->getPositionColor($record->getValue());
                    $c++;
                }
            }
        }
        $out['data']=$dataOut;
        $out['sensor']=$sensor;
        return response()->json($out);

    }

    public function getEcgByDateAC(Request $request) {
        ini_set('memory_limit','2048M');
        $validator = Validator::make($request->all(), [
            "userId"=>'required|integer|exists:users,id',
            'date'=>'required|integer',

        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $user=User::findOrFail($request->userId);
        $sensor=Sensor::where('name','Ecg')->first();

        $searchDate="timestamp '".Carbon::createFromTimestampMs($request->date)->toDateTimeString()."'";
        $firstFound=Sample::whereRaw('time >= '.$searchDate.' AND sensor_id = '.$sensor->id.' AND user_id = '.$user->id)->orderBy('time')->first();
        $startTimeString="timestamp '".$firstFound->time->toDateTimeString()."'";
        $endTimeString="timestamp '".$firstFound->time->addMinutes(5)->toDateTimeString()."'";
        $selectString='time AS "x", value AS y';
        $query=Sample::whereRaw('time >= '.$startTimeString.' AND time <= '.$endTimeString.' AND sensor_id = '.$sensor->id.' AND user_id = '.$user->id);
        $ecgDatas=$query->orderBy('time')->get();
        $maxEcg=$query->max('value');
        $minEcg=$query->min('value');
        $ecgCount=count($ecgDatas);
        $firstTime=$ecgDatas[0]->time;

        $lastTime=$ecgDatas[$ecgCount -1]->time;
        $ecgDuration=$lastTime->diffInSeconds($firstTime);
        $sampleRate=(int)round($ecgCount/$ecgDuration);
        $plucked = $ecgDatas->pluck('value');
        $out=null;
        foreach ($plucked->all() as $data) {
            if (abs($maxEcg)>abs($minEcg))
                $out[]=[$data];
            else
                $out[]=[$data*-1];
        }
        //dd($ecgDuration,$ecgCount, $sampleRate);
        //dd($plucked->all());
        Excel::store(new SamplesExport($out), 'samples.csv');

        $pyOut = exec("python3 ../app/Python/ecgPoints.py -s $sampleRate 2>&1");
        //dump($pyOut);

        //$pyOut=trim($pyOut, '"');
        //dump($pyOut);
        $out=null;
        $rawEcgPoints=json_decode($pyOut);
        $rawEcgPoints=json_decode($rawEcgPoints);
        $dataOut=[];
        foreach ($ecgDatas as $idx=>$ecgData){
            if (isset($rawEcgPoints[$idx])) {
                $dataOut[$idx]['x']=$ecgData->time->getPreciseTimestamp(3);
                $dataOut[$idx]['ECG_Raw']=round($ecgData->value * 1000);
            }
        }
        $out['sensor']=$sensor;
        $out['data']=$dataOut;
        //$out['data']['Moving_Average_Filter']=$clean;
        $out['startDate']=$firstFound->time->toDateTimeString();
        return response()->json($out);

    }

    public function getEcgByDate(Request $request) {
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

        $queryApi = $client->createQueryApi();
        ini_set('memory_limit','2048M');
        $validator = Validator::make($request->all(), [
            "userId"=>'required|integer|exists:users,id',
            'date'=>'required|integer',

        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $user=User::findOrFail($request->userId);
        $sensor=Sensor::where('name','Ecg')->first();
        $searchDate=Carbon::createFromTimestampMs($request->date)->toIso8601ZuluString();
        $endSearchDate=Carbon::createFromTimestampMs($request->date)->endOfDay()->toIso8601ZuluString();
        $q='from(bucket: "'.$bucket.'")   |> range(start: '.$searchDate.', stop: '.$endSearchDate.')
             |> first()
             |> filter(fn: (r) => r["_measurement"] == "Ecg") |> filter(fn: (r) => r["user_id"] == "'.$user->id.'")';
        $firstRecords = $queryApi->query($q);
        $firstFound=new Carbon($firstRecords[0]->records[0]->getTime());
        $lastFound=$firstFound->clone()->addMinutes(5);
        $q='from(bucket: "'.$bucket.'")   |> range(start: '.$firstFound->toIso8601ZuluString().', stop: '.$lastFound->toIso8601ZuluString().')
             |> filter(fn: (r) => r["_measurement"] == "Ecg") |> filter(fn: (r) => r["user_id"] == "'.$user->id.'")';
        $records = $queryApi->query($q);
        $data=[];
        foreach ($records[0]->records as $record) {
            $time=new Carbon($record->getTime());
            $data[]=[
                "x"=>$time->getPreciseTimestamp(3),
                "y"=>round ($record->getValue() * 1000)
            ];
        }

        $out['sensor']=$sensor;
        $out['data']['ECG_Raw']=$data;
        //$out['data']['Moving_Average_Filter']=$clean;
        $out['startDate']=$firstFound->timezone("Europe/Rome")->toDateTimeString();
        return response()->json($out);

    }

    public function getMeasureses(Request $request) {
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

        $queryApi = $client->createQueryApi();
        $validator = Validator::make($request->all(), [
            "userId"=>'required|integer|exists:users,id',
            "sensorId"=>'required|integer|exists:sensors,id',
            'startTime'=>'required',
            'endTime'=>'required'

        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $user= User::findOrFail($request->userId);
        $sensor= Sensor::findOrFail($request->sensorId);

        $startTimeString=Carbon::createFromTimestampMs($request->startTime)->sub(30, 'seconds')->toIso8601ZuluString();
        $endTimeString=Carbon::createFromTimestampMs($request->endTime)->add(30, 'seconds')->toIso8601ZuluString();
        $q='from(bucket: "'.$bucket.'")   |> range(start: '.$startTimeString.', stop: '.$endTimeString.')
             |> max()
             |> filter(fn: (r) => r["_measurement"] == "Ecg") |> filter(fn: (r) => r["user_id"] == "'.$user->id.'")';
        $maxRecords=$queryApi->query($q);
        $q='from(bucket: "'.$bucket.'")   |> range(start: '.$startTimeString.', stop: '.$endTimeString.')
             |> min()
             |> filter(fn: (r) => r["_measurement"] == "Ecg") |> filter(fn: (r) => r["user_id"] == "'.$user->id.'")';
        $minRecords=$queryApi->query($q);
        $q='from(bucket: "'.$bucket.'")   |> range(start: '.$startTimeString.', stop: '.$endTimeString.')
             |> filter(fn: (r) => r["_measurement"] == "Ecg") |> filter(fn: (r) => r["user_id"] == "'.$user->id.'")';
        $records=$queryApi->query($q);
        $query=Sample::whereRaw('time >= '.$startTimeString.' AND time <= '.$endTimeString.' AND sensor_id = '.$sensor->id.' AND user_id = '.$user->id);
        $ecgDatas=$records[0]->records;
        $maxEcg=$maxRecords[0]->records[0]->getValue();
        $minEcg=$minRecords[0]->records[0]->getValue();
        $ecgCount=count($ecgDatas);
        $firstTime=new Carbon($ecgDatas[0]->getTime());

        $lastTime=new Carbon($ecgDatas[$ecgCount -1]->getTime());

        $ecgDuration=$lastTime->diffInSeconds($firstTime);
        $sampleRate=(int)round($ecgCount/$ecgDuration);
        $plucked = collect($ecgDatas)->pluck('_value');
        $out=null;
        foreach ($ecgDatas as $data) {
            if (abs($maxEcg)>abs($minEcg))
                $out[]=[$data->getValue()];
            else
                $out[]=[$data->getValue()*-1];
        }
        //dd($ecgDuration,$ecgCount, $sampleRate);
        //dd($plucked->all());
        Excel::store(new SamplesExport($out), 'samples.csv');
        $pyOut = exec("python3 ../app/Python/ecgPoints.py -s $sampleRate 2>&1");

        //$pyOut=trim($pyOut, '"');
        $rawEcgPoints=json_decode($pyOut);
        $rawEcgPoints=json_decode($rawEcgPoints);

        $out=null;
        $startTime=Carbon::createFromTimestampMs($request->startTime);
        $endTime=Carbon::createFromTimestampMs($request->endTime);
        $count=-1;
        $ecgClean=null;
        foreach ($rawEcgPoints as $idx=>$rawEcgPoint) {
            if (new Carbon($ecgDatas[$idx]->getTime()) < $startTime)
                continue;
            else if (new Carbon($ecgDatas[$idx]->getTime())  > $endTime)
                break;
            $t=new Carbon($ecgDatas[$idx+1]->getTime());
            $np['x']=$t->getPreciseTimestamp(3);
            $np['y']=round($rawEcgPoint->ECG_Clean * 1000);
            $ecgClean[]=$np;
            $types=['Q','P','R','S','T'];
            foreach ($types as $type){
                $key="ECG_".$type."_Peaks";
                if ($rawEcgPoint->$key) {
                    $count++;
                    $app['time']=$t;
                    $app['value']=round($ecgDatas[$idx+1]->getValue() * 1000);
                    $k=strtolower($type)."s";
                    $out[$k][]=$app;
                }
            }
        }
        if (isset($out['ts']) && count($out['rs']) < count($out['ts']))
            array_shift($out['ts']);
        if (count($out['rs']) < count($out['ss']))
            array_shift($out['ss']);
        $measures=null;
        $averages['rr']=0;
        $averages['qt']=0;
        $rrCount=0;
        $qtCount=0;
        foreach ($out['rs'] as $idx=>$r) {
            $nextIdx=$idx+1;
            if (isset($out['rs'][$nextIdx]))
            {
                $averages['rr']+=$measures[$idx]['rr']=$out['rs'][$nextIdx]['time']->diffInMilliseconds($r['time']);
                $rrCount++;
            }
        }
        if (isset($out['qs'] )) {
            foreach ($out['qs'] as $idx => $q) {
                if (isset($out['ts'][$idx])) {
                    $averages['qt'] += $measures[$idx]['qt'] = $out['ts'][$idx]['time']->diffInMilliseconds($q['time']);
                    $qtCount++;
                }
            }
        }

        if ($rrCount)
        {
            $averages['rr']=round($averages['rr'] / ($rrCount));

        }
        else
        {
            $averages['rr']=0;
        }
        if ($qtCount)
        {
            $averages['qt']=round($averages['qt'] / ($qtCount));

        }
        else
        {
            $averages['qt']=0;
        }
        //dump($firstTime);
        //dd($rawEcgPoints);
        $out['averages']=$averages;
        $out['measures']=$measures;
        $out['clean']=$ecgClean;
        return response()->json($out);

    }
    public function getMeasuresesAndrea(Request $request) {
        $validator = Validator::make($request->all(), [
            "userId"=>'required|integer|exists:users,id',
            "sensorId"=>'required|integer|exists:sensors,id',
            'startTime'=>'required',
            'endTime'=>'required'

        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $user= User::findOrFail($request->userId);
        $sensor= Sensor::findOrFail($request->sensorId);

        $startTimeString="timestamp '".Carbon::createFromTimestampMs($request->startTime)->format('Y-m-d H:i:s.u')."'";
        $endTimeString="timestamp '".Carbon::createFromTimestampMs($request->endTime)->format('Y-m-d H:i:s.u')."'";

        $query=Sample::whereRaw('time >= '.$startTimeString.' AND time <= '.$endTimeString.' AND sensor_id = '.$sensor->id.' AND user_id = '.$user->id);
        $ecgDatas=$query->orderBy('time')->get();
        $maxEcg=$query->max('value');
        $minEcg=$query->min('value');
        $averageEcg=$query->avg('value');
        $medianEcg=$ecgDatas->median('value');

        $maxEcgPeek=$maxEcg;

        $peaks=[];
        $rrFlag=$maxEcgPeek * 0.6;
        $tFlag=$medianEcg * 1.5;
        $pFlagCoefficient=0.7;
        $rrLookingFlag=true;
        $prevIdx=null;
        $currentPeek=null;
        $rPoints=[];
        $qPoints=[];
        $sPoints=[];
        $tPoints=[];
        $pPoints=[];
        $currentPeekPoint=null;
        $currentPeekIdx=null;
        $cvsArray=null;
        $currentTime=0;
        foreach ($ecgDatas as $idx=>$ecgData) {
            if ($idx>0) {
                $i=$idx-1;
                if ($cvsArray) {
                    $deltaMs=$ecgData->time->diffInMilliseconds($ecgDatas[$i]->time);
                    $currentTime+=$deltaMs;
                }
                $cvsArray[]=[$ecgData->value];
            }
            $eData['time']=$ecgData->time;
            $eData['value']=round($ecgData->value * 1000);
            if ($rrLookingFlag && $prevIdx) {
                if ($ecgData->value > $rrFlag) {

                    if (($ecgData->value) > ($ecgDatas[$prevIdx]->value)) {
                        $currentPeekIdx=$idx;
                        $currentPeek=$ecgData->time;
                        $currentPeekPoint=$eData;
                    }
                }
                else if ($currentPeek){
                    $peaks[]=$currentPeek;
                    $rPoints[]=$currentPeekPoint;
                    $pCount=count($rPoints) -1;
                    $q=null;
                    $searchIdx=$currentPeekIdx;
                    $qPointIdx=null;
                    while ($q==null) {
                        $prevSearchIdx=$searchIdx - 1;
                        if (!isset($ecgDatas[$prevSearchIdx]))
                        {
                            break;
                        }
                        if (($ecgDatas[$prevSearchIdx]->value) > ($ecgDatas[$searchIdx]->value)) {
                            $app['time']=$ecgDatas[$searchIdx]->time;
                            $app['value']=round($ecgDatas[$searchIdx]->value * 1000);
                            $qPoints[$pCount]=$app;
                            $qPointIdx=$searchIdx;

                            $q=true;
                        }
                        $searchIdx--;
                    }
                    $p=null;
                    $searchIdx=$qPointIdx - 1;
                    $pPointIdx=null;
                    $currentPPoint=null;
                    $currentPIdx=null;
                    if ($qPointIdx) {
                        if ($ecgDatas[$qPointIdx]->value > 0)
                            $pFlag=$ecgDatas[$qPointIdx]->value * (1+$pFlagCoefficient);
                        else
                            $pFlag=$ecgDatas[$qPointIdx]->value * ($pFlagCoefficient);
                        $out['debug']['pflag'.$pCount]=round($pFlag *1000);
                        while ($p==null) {
                            $prevSearchIdx=$searchIdx - 1;
                            $doublePrevSearchIdx=$prevSearchIdx -1;
                            $triplePrevSearchIdx=$doublePrevSearchIdx -1;
                            if (!isset($ecgDatas[$prevSearchIdx]) || !isset($ecgDatas[$doublePrevSearchIdx]) || !isset($ecgDatas[$triplePrevSearchIdx]))
                            {
                                break;
                            }
                            if ($ecgDatas[$searchIdx]->value > $pFlag) {
                                // && $ecgDatas[$doublePrevSearchIdx]->value < $ecgDatas[$prevSearchIdx]->value
                                if ($ecgDatas[$prevSearchIdx]->value > $ecgDatas[$searchIdx]->value ) {
                                    $currentPIdx=$searchIdx;
                                    $currentPPoint=$ecgDatas[$searchIdx];
                                }
                            }
                            if ($searchIdx!= $currentPIdx && $currentPPoint)
                            {
                                $index=$searchIdx;
                                $flag=false;
                                for ($i=0; $i<2;$i++){
                                    $index2 = $index - $i;
                                    if (isset($ecgDatas[$index2])) {
                                        if ($ecgDatas[$index2]->value < $ecgDatas[$index]->value) {
                                            $flag=true;
                                        }
                                        else {
                                            $flag=false;
                                            break;
                                        }
                                    }
                                    $index++;
                                }
                                if ($flag) {
                                    $app['time']=$currentPPoint->time;
                                    $app['value']=round($currentPPoint->value * 1000);
                                    $pPoints[$pCount]=$app;
                                    $pPointIdx=$currentPIdx;
                                    $p=true;
                                }
                            }
                            $searchIdx--;
                        }
                    }

                    $s=null;
                    $searchIdx=$currentPeekIdx;
                    $sPointIdx=null;
                    while ($s==null) {
                        $nextSearchIdx=$searchIdx + 1;
                        if (!isset($ecgDatas[$nextSearchIdx]))
                        {
                            break;
                        }
                        if (($ecgDatas[$nextSearchIdx]->value) > ($ecgDatas[$searchIdx]->value)) {
                            $app['time']=$ecgDatas[$searchIdx]->time;
                            $app['value']=round($ecgDatas[$searchIdx]->value * 1000);
                            $sPoints[$pCount]=$app;
                            $sPointIdx=$nextSearchIdx;
                            $s=true;
                        }
                        $searchIdx++;
                    }
                    $t=null;
                    $searchIdx=$sPointIdx + 1;
                    $tPointIdx=null;
                    while ($t==null) {
                        $app=null;
                        $nextSearchTIdx=$searchIdx + 1;
                        if (!isset($ecgDatas[$nextSearchTIdx]))
                        {
                            break;
                        }
                        if (abs($ecgDatas[$searchIdx]->value) > $tFlag) {
                            if (abs($ecgDatas[$nextSearchTIdx]->value) < abs($ecgDatas[$searchIdx]->value)) {
                                $app['time']=$ecgDatas[$searchIdx]->time;
                                $app['value']=round($ecgDatas[$searchIdx]->value * 1000);
                                error_log($app['value']);
                                $tPoints[$pCount]=$app;
                                $tPointIdx=$nextSearchTIdx;
                                $t=true;
                            }
                        }
                        $searchIdx++;
                    }
                    $currentPeekIdx=null;
                    $currentPeek=null;
                    $rrLookingFlag=false;
                }
            }
            if (!empty($peaks) && $idx==$sPointIdx) {
                $rrLookingFlag=true;
            }
            $prevIdx=$idx;
        }
        $measures=[];
        $averages['rr']=0;
        $averages['qt']=0;
        $rrCount=0;
        $qtCount=0;
        foreach ($peaks as $idx=>$peak) {
            $nextIdx=$idx+1;
            if (isset($peaks[$nextIdx]))
            {
                $averages['rr']+=$measures[$idx]['rr']=$peaks[$nextIdx]->diffInMilliseconds($peak);
                $rrCount++;
            }
            if (isset($tPoints[$idx]) && isset($qPoints[$idx])) {
                $averages['qt']+=$measures[$idx]['qt']=$tPoints[$idx]['time']->diffInMilliseconds($qPoints[$idx]['time']);
                $qtCount++;
            }
        }
        //$measures['rrs']=$rrs;

        if ($rrCount)
        {
            $averages['rr']=round($averages['rr'] / ($rrCount));

        }
        else
        {
            $averages['rr']=0;
        }
        if ($qtCount)
        {
            $averages['qt']=round($averages['qt'] / ($qtCount));

        }
        else
        {
            $averages['qt']=0;
        }
        $out['measures']=$measures;
        $out['rs']=$rPoints;
        $out['qs']=$qPoints;
        $out['ss']=$sPoints;
        $out['ts']=$tPoints;
        $out['ps']=$pPoints;
        $out['averages']=$averages;
        $out['debug']['rflag']=round($rrFlag *1000);
        //$out['debug']['tflag']=round($tFlag *1000);
        Excel::store(new SamplesExport($cvsArray), 'samples.csv');
        //return (new SamplesExport($cvsArray))->download('invoices.csv', \Maatwebsite\Excel\Excel::CSV);

        return response()->json($out);

    }
    private function getPositionColor($code) {
        switch ($code) {
            case 1:
                return '#90ED7D';
            case 2:
                return '#f7a35c';
            case 4:
                return '#8085E9';
            case 8:
                return '#f15c80';
            case 16:
                return '#2b908f';
            case 32:
                return '#91E8E1';
        }
    }
}
