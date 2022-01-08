<?php

namespace App\Helpers;

use App\Events\ProgressEvent;
use \App\Models\Dive;

use Carbon\Carbon;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Sentry\Util\JSON;

class DiveParser
{
    private $file;
    private $type;
    private $user_id;

    public function __construct($file = null, $type = null, $user_id = null)
    {
        $this->file = $file;
        if (!$type)
            $type = 1;
        $this->type = $type;
        $this->user_id = $user_id;
    }

    public function parseUDDF()
    {
        $uddf = simplexml_load_string($this->file);
        $gases = array();
        $gases['21']['o2'] = '21';
        $gases['21']['he'] = '0';
        foreach ($uddf->gasdefinitions->mix as $mix) {
            $gas_name = (string) $mix['id'];
            $gases[$gas_name]['o2'] = (string) $mix->o2;
            if ((float) $mix->o2 < 1)
                $gases[$gas_name]['o2'] = (string) ($mix->o2 * 100);
            $gases[$gas_name]['he'] = (string) $mix->he;
            if ((float) $mix->he < 1)
                $gases[$gas_name]['he'] = (string) ($mix->he * 100);
        }
        $dives_count = 0;
        $step_count = 0;
        $dives = [];

        foreach ($uddf->profiledata->repetitiongroup as $dive) {
            $step_count = 0;
            $dives_count++;
            $allowed_format = ['Y-m-d H:i:s', 'Y-m-d H:i', 'Y-m-d\TH:i:s', 'Y-m-d\TH:i'];
            $start_time = false;
            foreach ($allowed_format as $format) {
                try {
                    $start_time = Carbon::createFromFormat($format, (string) $dive->dive->informationbeforedive->datetime);
                    if ($start_time)
                        break;
                } catch (Exception $e) {
                    continue;
                }
            }
            //dd(str_replace("T", " ", (string) $dive->dive->informationbeforedive->datetime));
            //$start_time = \DateTime::createFromFormat('Y-m-d H:i:s', str_replace("T", " ", (string) $dive->dive->informationbeforedive->datetime));
            $dives[$dives_count]['date'] = $start_time;
            $dives[$dives_count]['uploadTime'] = Carbon::now();
            $dives[$dives_count]['uploaderId'] = auth()->id();
            $dives[$dives_count]['type'] = $this->type;
            $dives[$dives_count]['userId'] = $this->user_id;
            $surface_step = null;
            $max_depth = 0;
            $min_temp = 9999;
            $line_count = 0;
            ProgressEvent::dispatch("PARSING_DIVE", 0, $dives_count);
            $totalLines = count($dive->dive->samples->waypoint);
            foreach ($dive->dive->samples->waypoint as $waypoint) {
                $dives[$dives_count]['profile'][$line_count]['timesec'] = (int) $waypoint->divetime;
                $dives[$dives_count]['profile'][$line_count]['depth'] = (float) $waypoint->depth;

                if ($dives[$dives_count]['profile'][$line_count]['depth'] > $max_depth)
                    $max_depth = $dives[$dives_count]['profile'][$line_count]['depth'];
                $dives[$dives_count]['profile'][$line_count]['tank_pressure'] = null;
                if (isset($waypoint->tankpressure))
                    $dives[$dives_count]['profile'][$line_count]['tank_pressure'] = round((float) $waypoint->tankpressure / 100000);
                $dives[$dives_count]['profile'][$line_count]['temp'] = null;
                if (isset($waypoint->temperature)) {
                    $dives[$dives_count]['profile'][$line_count]['temp'] = (float) $waypoint->temperature - 272.15;
                    if ($dives[$dives_count]['profile'][$line_count]['temp'] < $min_temp)
                        $min_temp = $dives[$dives_count]['profile'][$line_count]['temp'];
                }
                $dives[$dives_count]['profile'][$line_count]['tank_volume'] = null;
                if (isset($waypoint->switchmix)) {
                    $mix = null;
                    $used_gas = $gases[(string) $waypoint->switchmix['ref']];
                    if (!isset($gases[(string) $waypoint->switchmix['ref']]))
                        $mix = '1.21';
                    elseif ($used_gas['o2'] == '21' && $used_gas['he'] == '0')
                        $mix = '1.21';
                    elseif ($used_gas['he'] == '0')
                        $mix = '2.' . $used_gas['o2'];
                    else {
                        $o2 = (int) $used_gas['o2'];
                        $he = (int) $used_gas['he'];
                        $n = 100 - $o2 - $he;
                        $o2 = $o2 * 10;
                        $N = $n * 10;
                        $mix = '6.' . $o2 . $N;
                    }
                    if ($mix) {
                        $used_gas = $this->getGasSwitch($mix);

                        $dives[$dives_count]['profile'][$line_count]['gases'] = $used_gas;
                        $dives[$dives_count]['profile'][$line_count]['marker'] = self::getMarkerUrl(($used_gas));
                    }
                    if (isset($volumes[(string) $waypoint->switchmix['ref']]))
                        $dives[$dives_count]['profile'][$line_count]['tank_volume'] = $volumes[(string) $waypoint->switchmix['ref']];
                } elseif (!$line_count) {
                    $mix = '1.21';
                    if ($mix) {
                        $used_gas = $this->getGasSwitch($mix);

                        $dives[$dives_count]['profile'][$line_count]['gases'] = $used_gas;
                        $dives[$dives_count]['profile'][$line_count]['marker'] = self::getMarkerUrl(($used_gas));
                    }
                    if (isset($volumes[(string) $waypoint->switchmix['ref']]))
                        $dives[$dives_count]['profile'][$line_count]['tank_volume'] = $volumes[(string) $waypoint->switchmix['ref']];
                }
                $line_count++;
                $perc = ceil($line_count * 100 / $totalLines);
                ProgressEvent::dispatch("PARSING_DIVE", $perc, $dives_count);
            }
        }
        $warnings = $this->diveArrayToDb($dives);
        if (!$warnings)
            $out['success'] = true;
        else
            $out['warning'] = $warnings;
        return $out;
    }

    public function parseConftech()
    {

        $dives_count = 0;
        $step_count = 0;
        $dives = [];
        $dive = $this->file;
        $dives_count++;
        $dives[$dives_count]['date'] = Carbon::createFromTimestamp($dive['datetime']);
        $dives[$dives_count]['confetechId'] = $dive['diveId'];
        $dives[$dives_count]['uploadTime'] = Carbon::now();
        $dives[$dives_count]['uploaderId'] = auth()->id();
        $dives[$dives_count]['type'] = $this->type;
        $dives[$dives_count]['userId'] = $this->user_id;

        $surface_step = null;
        $max_depth = 0;
        $min_temp = 9999;
        $line_count = 0;
        //ProgressEvent::dispatch("PARSING_DIVE", 0, $dives_count);
        //$totalLines = count($dive->dive->samples->waypoint);
        foreach ($dive['divepoints'] as $divePoint) {
            $dives[$dives_count]['profile'][$line_count]['timesec'] = (int) $divePoint['time'] - $dive['datetime'];
            $dives[$dives_count]['profile'][$line_count]['depth'] = (float) $divePoint['depth'] * -1;

            if ($dives[$dives_count]['profile'][$line_count]['depth'] > $max_depth)
                $max_depth = $dives[$dives_count]['profile'][$line_count]['depth'];
            $dives[$dives_count]['profile'][$line_count]['tankPressure'] = null;
            if (isset($divePoint['tankPressure']))
                $dives[$dives_count]['profile'][$line_count]['tankPressure'] = round((float) $divePoint['tankPressure'] / 100000);
            $dives[$dives_count]['profile'][$line_count]['temp'] = null;
            if (isset($divePoint['temperature'])) {
                $dives[$dives_count]['profile'][$line_count]['temp'] = (float) $divePoint['temperature'] - 272.15;
                if ($dives[$dives_count]['profile'][$line_count]['temp'] < $min_temp)
                    $min_temp = $dives[$dives_count]['profile'][$line_count]['temp'];
            }
            $dives[$dives_count]['profile'][$line_count]['tankVolume'] = null;
            if (isset($divePoint['gases'])) {
                $used_gas = $divePoint['gases'];
                $dives[$dives_count]['profile'][$line_count]['gases'] = $used_gas;
                $dives[$dives_count]['profile'][$line_count]['marker'] = self::getMarkerUrl(($used_gas));
                if (isset($divePoint["tankVolume"]))
                    $dives[$dives_count]['profile'][$line_count]['tankVolume'] = $divePoint["tankVolume"];
            }
        }

        $warnings = $this->diveArrayToDb($dives);
        if (!$warnings)
            $out['success'] = true;
        else
            $out['warning'] = $warnings;
        return $out;
    }

    private function getGasSwitch($field)
    {
        //0=N2
        //1=He
        //2=OXY
        $gas_out = array();
        if ((float) $field < 1.99) {
            $gas_out[0] = 0.79;
            $gas_out[1] = 0;
        }
        if ((float) $field == 1.99 || (float) $field == 2.100) {
            $gas_out[0] = 0;
            $gas_out[1] = 0;
        } elseif ((float) $field > 2 && (float) $field < 3) {
            if (((float) $field - 2) == 0.100)
                $gas_out[0] = 0;
            else
                $gas_out[0] = 1 - ((float) $field - 2);
            $gas_out[1] = 0;
        } elseif ((float) $field > 6 && (float) $field < 7) {
            $gas_app = explode('.', $field);
            $gas_out[2] = round(((int) substr($gas_app[1], 0, 3)) / 1000, 2);
            $gas_out[0] = round(((int) substr($gas_app[1], 3, 3)) / 1000, 2);
            //echo $actual_N2_fraction.'<br>';
            $gas_out[1] = round((1 - $gas_out[2] - $gas_out[0]), 2);
        } else {
            $gas_out[0] = 0.79;
            $gas_out[1] = 0;
        }
        $gas_out[2] = round((1 - $gas_out[1] - $gas_out[0]), 2);
        $out['n2'] = round($gas_out[0] * 100);
        $out['he'] = round($gas_out[1] * 100);
        $out['o2'] = round($gas_out[2] * 100);
        return $out;
    }

    public static function getMarkerUrl($gases)
    {
        if ($gases) {
            if ($gases['he'] == 0)
                return Storage::url("gas_switch/" . $gases['o2'] . ".png");
            else
                return Storage::url("gas_switch/trmx.png");
        }
        return null;
    }

    private function diveArrayToDb($dives)
    {
        ini_set('memory_limit', '-1');
        $mess = null;

        foreach ($dives as $diveId => $dive) {
            $user_id = $dive['userId'];
            $surface_step = null;
            if (!$dive['date']) {
                $mess['warning']['date'] = 'One dive has a missformatted date';
                continue;
            }
            $start_time_carbon = $dive['date']->clone();
            $error_code = null;
            $max_depth = 0;
            $min_temp = 999;
            $count = 0;

            $time_shift = 0;
            if ($dive['profile'][0]['depth'] > 0) {

                $first_point = $dive['profile'][0];
                $first_point['depth'] = 0;
                $first_point['timesec'] = 0;
                if ($dive['profile'][0]['timesec']  == 0)
                    $time_shift = (int)$dive['profile'][0]['timesec'];
                array_unshift($dive['profile'], $first_point);
            }
            $p_count = count($dive['profile']);
            $last_idx = $p_count - 1;
            if ($dive['profile'][$last_idx]['depth'] > 0) {

                $time_interval=$dive['profile'][$last_idx]['timesec'] - $dive['profile'][$last_idx -1]['timesec'];
                $curr_time = $dive['profile'][$last_idx]['timesec'];
                $curr_idx = $last_idx;
                $curr_time += $time_interval;
                $curr_idx++;
                $dive['profile'][$curr_idx]['depth'] = 0;
                $dive['profile'][$curr_idx]['timesec'] = $curr_time;
                $dive['profile'][$curr_idx]['tankPressure'] =  Arr::get($dive, 'profile.'.$last_idx.'.tankPressure', 0);
                $dive['profile'][$curr_idx]['temp'] = $dive['profile'][$last_idx]['temp'];
                $dive['profile'][$curr_idx]['tankVolume'] = Arr::get($dive, 'profile.'.$last_idx.'.tankVolume', 0);
                if (isset($dive['profile'][$last_idx]['gases']))
                    $dive['profile'][$curr_idx]['gases'] = $dive['profile'][$last_idx]['gases'];
                $dive['profile'][$curr_idx]['calculated'] = true;
            }
            $prev_temp = null;
            $prev_depth = null;
            $prev_time = null;
            ProgressEvent::dispatch("SAVING_DIVE", 0, $diveId);
            $lastGas = null;
            foreach ($dive['profile'] as $idx => $step) {
                if ($time_shift > 0 && $idx > 0) {
                    $dive['profile'][$idx]['timesec'] += $time_shift;
                }

                $ts = $start_time_carbon->clone()->addSeconds((int) $dive['profile'][$idx]['timesec']);
                $dive['profile'][$idx]['compartmentLoad'] = [];
                $dive['profile'][$idx]['compartmentGfs'] = [];
                $dive['profile'][$idx]['timestamp'] = new \DateTime($ts->toDateTimeString());
                $dive['profile'][$idx]['time'] = $step['timesec'] / 60;
                if (isset($step['gases'])) {
                    if ($step['gases'] == $lastGas) {
                        unset($dive['profile'][$idx]['gases']);
                        unset($dive['profile'][$idx]['marker']);
                    }
                    $lastGas = $step['gases'];
                }
                $vs = 0;
                if ($idx > 0) {
                    $d_depth = $step['depth'] - $prev_depth;
                    $d_time = $dive['profile'][$idx]['time'] - $prev_time;
                    $vs = round($d_depth / $d_time);
                }
                $dive['profile'][$idx]['vs'] = $vs * -1;
                if (!$dive['profile'][$idx]['temp'])
                    $dive['profile'][$idx]['temp'] = $prev_temp;
                if (!isset($step['calculated']))
                    $step['calculated'] = false;
                if ($step['depth'] > $max_depth)
                    $max_depth = $step['depth'];
                if ($dive['profile'][$idx]['temp'] === null && $prev_temp) {
                    $dive['profile'][$idx]['temp'] = $prev_temp;
                }
                if ($dive['profile'][$idx]['temp'] !== null) {
                    $temp = (float)$dive['profile'][$idx]['temp'];
                    if ($temp < $min_temp)
                        $min_temp = $temp;
                } else
                if ((float) $step['depth'] <= 0.05 && !$surface_step)
                    $surface_step = $count;
                elseif ((float) $step['depth'] > 0.50)
                    $surface_step = null;
                $dive_time = $dive['profile'][$idx]['timesec'];
                $prev_temp = $temp;
                $prev_depth = $step['depth'];
                $prev_time = $dive['profile'][$idx]['time'];
                $count++;
                if ($count==1 || $count%30 == 0 || $count==$p_count) {
                    dump($count);
                    $dive['miniChart'][]=$step['depth']*-1;
                }
                $perc = ceil($count * 100 / $p_count);
                if ($perc > 100)
                    $perc = 100;
                ProgressEvent::dispatch("SAVING_DIVE", $perc, $diveId);
            }

            $endtime = $dive['date']->clone()->addSeconds($dive_time);
            $dive['endDate'] = $endtime;

            //CHECK ALREADY UPLOADED
            $old_dives = Dive::where('date', $dive['date'])->where('end_date', $dive['endDate'])->where('depth', $max_depth)->get();
            if ($old_dives && count($old_dives) > 0) {
                $mess['duplicated'][] = $dive['date'];
                continue;
            }
            //CHECK ALREADY INWATER
            $in_water = Dive::where('user_id', $user_id)->whereBetween('date', [$dive['date'], $dive['endDate']])->get();
            if ($in_water && count($in_water) > 0) {
                $mess['in_water'][] = $dive['date'];
                continue;
            }


            //echo $dive['event_id'];
            $dive['depth'] = $max_depth;
            $dive['temp'] = $min_temp;
            $dive['runtime'] = round($dive_time / 60, 2);
            dump($dive['miniChart']);
            $d = Dive::create($dive);
            ProgressEvent::dispatch("SAVING_PROFILE", null, $diveId);
            //$d->profile()->createMany($profile);

            $gfCalculator = new DecoCalculator($d);
            ProgressEvent::dispatch("ANALYZING_DIVE", 0, $diveId);
            $gfCalculator->calculateGF();


            //GradientFactor::calculate(null, $event->divesInfos, false);
            //CalcDeepStop($dive);
        }
        return $mess;
    }
}
