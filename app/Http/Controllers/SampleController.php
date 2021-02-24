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
use Maatwebsite\Excel\Facades\Excel;

class SampleController extends Controller
{
    public function index(Request $request, User $user)
    {
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
                $query=Sample::where('sensor_id',$sensorId)->where('user_id',$user->id);
                $dateArray=explode('-',$request->date);
                $searchData=Carbon::create($dateArray[0],$dateArray[1],$dateArray[2],0);
                $startTimeString="timestamp '".$searchData->toDateTimeString()."'";
                $endTimeString="timestamp '".$searchData->addDay()->toDateTimeString()."'";
                $query=$query->whereRaw('time >= '.$startTimeString.' AND time < '.$endTimeString);
                $data=$query->orderBy('time','desc')->firstOrFail();
                $l['sensor']=$sensor;
                if ($sensor->name != 'Position')
                    $l['latest']=round($data->value,1);
                else
                    $l['latest']=__('samples.'.PositionEnum::fromValue((int)$data->value)->key);

                if ($sensor->name != 'Position')
                    $l['average']=round($query->avg('value'),2);
                else {
                    $data=DB::table('samples')->select(DB::raw('percentile_disc(0.5) WITHIN GROUP (ORDER BY value)  as median'))
                        ->whereRaw('time >= '.$startTimeString.' AND time < '.$endTimeString.' AND sensor_id = '.$sensor->id.' AND user_id = '.$user->id)->first();
                    /* $data=Sample::select('value')
                        ->whereRaw('time >= '.$startTimeString.' AND time < '.$endTimeString.' AND sensor_id = '.$sensor->id.' AND user_id = '.$user->id)
                        ->orderBy('value')->get(); */
                    $l['average']=__('samples.'.PositionEnum::fromValue((int)$data->median)->key);
                }

                $latests[]=$l;
            }
        }
        return view('wearable.samples', compact('user','date','sensors','ecg','latests'));
    }

    public function viewEcg (Request $request, User $user) {
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
        $startTimeString="'".$searchData->toDateTimeString()."'";
        $endTimeString="'".$searchData->addDay()->toDateTimeString()."'";
        $now=new Carbon();
        $diffInSecs=$now->addDay()->diffInSeconds($searchData->addDay());
        $availablesDate['first']=Sample::whereRaw('time between '.$startTimeString.' and '.$endTimeString)
            ->whereRaw('sensor_id = 6 AND user_id = '.$user->id)->orderBy('time')->first();
        $availablesDate['last']=Sample::whereRaw('time between '.$startTimeString.' and '.$endTimeString)
            ->whereRaw('sensor_id = 6 AND user_id = '.$user->id)->orderBy('time','desc')->first();
        $pagination=Sample::selectRaw('time_bucket(\'5 minutes\', "time") AS "x",count(value)::DOUBLE PRECISION AS y')
            ->whereRaw('sensor_id = 6 AND user_id = '.$user->id)
            ->whereRaw("EXTRACT(MONTH FROM time) = {$dateArray[1]} AND EXTRACT(YEAR FROM time) = {$dateArray[0]}  AND EXTRACT(DAY FROM time) = {$dateArray[2]}")
            ->groupBy('x')->get();
        return view('wearable.viewEcg', compact('user','date','availablesDate','pagination'));

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
            $selectString='time_bucket(\'5 minutes\', "time") AS "x", avg(value)::DOUBLE PRECISION AS y';
            $dateArray=explode('-',$request->date);
            $searchData=Carbon::create($dateArray[0],$dateArray[1],$dateArray[2],0);
            $startTimeString="'".$searchData->toDateTimeString()."'";
            $endTimeString="'".$searchData->addDay()->toDateTimeString()."'";
            $now=new Carbon();
            $diffInSecs=$now->timezone('Europe/Rome')->addDay()->diffInSeconds($searchData->addDay());
        } else if (isset($request->startTime) && isset($request->endTime)){
            $range = $request->endTime - $request->startTime;
            if ($range < 0.5 * 3600 * 1000) { // 1/2 hrs
                $selectString='time AS "x", value::DOUBLE PRECISION AS y';
                $group=false;
            } else if ($range < 1 * 3600 * 1000) { // 1 hrs
                $selectString='time_bucket(\'30 seconds\', "time") AS "x", avg(value)::DOUBLE PRECISION AS y';
            } else if ($range < 3 * 3600 * 1000) { // 3 hrs
                $selectString='time_bucket(\'1 minutes\', "time") AS "x", avg(value)::DOUBLE PRECISION AS y';
            } else if ($range < 6 * 3600 * 1000) { // 3 hrs
                $selectString='time_bucket(\'2 minutes\', "time") AS "x", avg(value)::DOUBLE PRECISION AS y';
            } else if ($range < 12 * 3600 * 1000) { // 12 hrs
                $selectString='time_bucket(\'3 minutes\', "time") AS "x",avg(value)::DOUBLE PRECISION AS y';
            } else { // 12 hrs

                $selectString='time_bucket(\'5 minutes\', "time") AS "x",avg(value)::DOUBLE PRECISION AS y';
            }
            $startTimeString="'".Carbon::createFromTimestampMs($request->startTime)->toDateTimeString()."'";
            $endTimeString="'".Carbon::createFromTimestampMs($request->endTime)->addDay()->toDateTimeString()."'";


            $now=new Carbon();
            $diffInSecs=$now->timezone('Europe/Rome')->diffInSeconds(Carbon::createFromTimestampMs($request->endTime));
        }
        else {
            return response($request->all(),200);
        }
        if ($sensor->name=='Position')
        {
            $selectString='time AS "x", value::DOUBLE PRECISION AS y';
            $group=false;
        }
        $selectString='time AS "x", value::DOUBLE PRECISION AS y';
        $group=false;
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

        $lastPosition=0;
        $dataOut=[];
        $c=0;

        foreach ($data as $i=>$d){
            if ($sensor->name!='Position') {
                $currDate = new Carbon($d->x);
                $dataOut[$c]['x'] = $currDate->getPreciseTimestamp(3);
                if ($sensor->id == 6)
                    $dataOut[$c]['y'] = round((float)$d->y * 1000, 0);
                else
                    $dataOut[$c]['y'] = (float)$d->y;
                $c++;
            }
            else {
                if ($lastPosition!=$d->y) {

                    $lastPosition=$d->y;
                    $currDate = new Carbon($d->x);
                    $dataOut[$c]['x'] = $currDate->getPreciseTimestamp(3);
                    $dataOut[$c]['name'] =__('samples.'.PositionEnum::fromValue((int)$d->y)->key);
                    $dataOut[$c]['label'] = __('samples.'.PositionEnum::fromValue((int)$d->y)->key);;
                    $dataOut[$c]['color'] = $this->getPositionColor($d->y);
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
        $data=DB::table('samples')->select(DB::raw($selectString))
            ->whereRaw('time >= '.$startTimeString.' AND time < '.$endTimeString.' AND sensor_id = '.$sensor->id.' AND user_id = '.$user->id)
            ->orderBy('x')->get();
        $clean=[];
        $movingAvgDepth=10;
        foreach ($data as $i=>$d){
            /* $mACount=0;
            $mATotal=0;
            for ($idx=$i; $idx<=$i+$movingAvgDepth; $idx++) {
                if (isset($data[$idx])) {
                   $mACount++;
                   $mATotal+=$data[$idx]->y;
                   if ($mACount==1) {
                       $mATotal*=$movingAvgDepth;
                       $mACount=$movingAvgDepth;
                   }
                }
            } */
            // $clean[$i]['y']=round($mATotal * 1000 / $mACount);
            $currDate=new Carbon($d->x);
            $data[$i]->x = $currDate->getPreciseTimestamp(3);
            $clean[$i]['x']=$data[$i]->x;
            $data[$i]->y = round( $d->y * 1000);

        }


        $out['sensor']=$sensor;
        $out['data']['ECG_Raw']=$data;
        //$out['data']['Moving_Average_Filter']=$clean;
        $out['startDate']=$firstFound->time->toDateTimeString();
        return response()->json($out);

    }

    public function getMeasureses(Request $request) {
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

        $startTimeString="timestamp '".Carbon::createFromTimestampMs($request->startTime)->sub(30, 'seconds')->format('Y-m-d H:i:s.u')."'";
        $endTimeString="timestamp '".Carbon::createFromTimestampMs($request->endTime)->add(30, 'seconds')->format('Y-m-d H:i:s.u')."'";

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

        //$pyOut=trim($pyOut, '"');
        //dump($pyOut);
        $rawEcgPoints=json_decode($pyOut);
        $rawEcgPoints=json_decode($rawEcgPoints);
        //dd($rawEcgPoints);

        $out=null;
        $startTime=Carbon::createFromTimestampMs($request->startTime);
        $endTime=Carbon::createFromTimestampMs($request->endTime);
        $count=-1;
        $ecgClean=null;
        foreach ($rawEcgPoints as $idx=>$rawEcgPoint) {
            if ($ecgDatas[$idx]->time < $startTime)
                continue;
            else if ($ecgDatas[$idx]->time > $endTime)
                break;
            $np['x']=$ecgDatas[$idx+1]->time->getPreciseTimestamp(3);
            $np['y']=round($rawEcgPoint->ECG_Clean * 1000);
            $ecgClean[]=$np;
            $types=['Q','P','R','S','T'];
            foreach ($types as $type){
                $key="ECG_".$type."_Peaks";
                if ($rawEcgPoint->$key) {
                    $count++;
                    $app['time']=$ecgDatas[$idx+1]->time;
                    $app['value']=round($ecgDatas[$idx+1]->value * 1000);
                    $k=strtolower($type)."s";
                    $out[$k][]=$app;
                }
            }
        }
        if (count($out['rs']) < count($out['ts']))
            $out['ts']=array_shift($out['ts']);
        if (count($out['rs']) < count($out['ss']))
            $out['ss']=array_shift($out['ss']);
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

        foreach ($out['qs'] as $idx=>$q) {
            if (isset($out['ts'][$idx]))
            {
                $averages['qt']+=$measures[$idx]['qt']=$out['ts'][$idx]['time']->diffInMilliseconds($q['time']);
                $qtCount++;
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
