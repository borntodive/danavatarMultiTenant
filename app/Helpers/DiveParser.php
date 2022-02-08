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
                //dd($dives);
                if (isset($waypoint->switchmix)) {
                    if (!isset($gases[(string) $waypoint->switchmix['ref']])) {
                        $used_gas['o2'] = 21;
                        $used_gas['he'] = 0;
                    } else {
                        dd($gases);
                        $used_gas = $gases[(string) $waypoint->switchmix['ref']];
                        $used_gas['o2'] = (int) $used_gas['o2'];
                        $used_gas['he'] = (int) $used_gas['he'];
                    }
                    $used_gas['n2'] = 100 - $used_gas['o2'] - $used_gas['he'];


                    $dives[$dives_count]['profile'][$line_count]['gases'] = $used_gas;
                    $dives[$dives_count]['profile'][$line_count]['marker'] = self::getMarkerUrl(($used_gas));

                    if (isset($volumes[(string) $waypoint->switchmix['ref']]))
                        $dives[$dives_count]['profile'][$line_count]['tank_volume'] = $volumes[(string) $waypoint->switchmix['ref']];
                } elseif (!$line_count) {
                    $used_gas['o2'] = 21;
                    $used_gas['he'] = 0;
                    $used_gas['n2'] = 100 - $used_gas['o2'] - $used_gas['he'];
                    $dives[$dives_count]['profile'][$line_count]['gases'] = $used_gas;
                    $dives[$dives_count]['profile'][$line_count]['marker'] = self::getMarkerUrl(($used_gas));
                    if (isset($volumes[(string) $waypoint->switchmix['ref']]))
                        $dives[$dives_count]['profile'][$line_count]['tank_volume'] = $volumes[(string) $waypoint->switchmix['ref']];
                }

                $line_count++;
                $perc = ceil($line_count * 100 / $totalLines);

                ProgressEvent::dispatch("PARSING_DIVE", $perc, $dives_count);
            }
        }

        $message = $this->diveArrayToDb($dives);
        if (!$message['warnings'])
            $out['success'] = true;
        else
            $out['warning'] = $message['warnings'];
        return $out;
    }

    public function parseZXL()
    {
        //$zxl = file_get_contents($this->file);
        $rows = preg_split('/\r\n|\r|\n|' . PHP_EOL . '/', $this->file);
        $profile_check = false;
        $dives_count = 0;
        $step_count = 0;
        $line_count = 0;
        $dives = [];
        $rows_count = count($rows);
        ProgressEvent::dispatch("PARSING_DIVE", 0, $rows_count);
        foreach ($rows as $idx => $row) {
            if (empty($row))
                continue;
            $row = str_replace(",", ".", $row);
            if (!$profile_check) {
                if (strstr($row, '|')) {
                    $fields = explode('|', $row);
                    if (!is_array($fields) || empty($fields) || empty($row))
                        continue;
                    elseif ($fields[0] == 'ZRH') {
                        $depth_unit = $fields[4];
                        $altitude_unit = $fields[5];
                        $temp_unit = $fields[6];
                        $tank_press_unit = $fields[7];
                        $tank_vol_unit = $fields[8];
                    } elseif ($fields[0] == 'ZDH') {
                        $step_count = 0;
                        $dives_count++;
                        if (strlen($fields[5]) > 14)
                            $fields[5] = substr($fields[5], 0, 14);
                        $allowed_format = ['YmdHi', 'YmdHis', 'YmdHisP', 'Y-m-d H:i:s', 'Y-m-d H:i', 'Y-m-d\TH:i:s', 'Y-m-d\TH:i'];
                        $start_time = false;
                        foreach ($allowed_format as $format) {
                            try {
                                $start_time = Carbon::createFromFormat($format, $fields[5]);
                                if ($start_time)
                                    break;
                            } catch (Exception $e) {
                                continue;
                            }
                        }
                        $dives[$dives_count]['date'] = $start_time;
                        $dives[$dives_count]['uploadTime'] = Carbon::now();
                        $dives[$dives_count]['uploaderId'] = auth()->id();;
                        $dives[$dives_count]['type'] = $this->type;
                        $dives[$dives_count]['userId'] = $this->user_id;
                    }
                } elseif (substr($row, 0, 4) == 'ZDP{') {
                    $line_count = 0;
                    $last_press = null;
                    $profile_arr = array();
                    $surface_step = null;
                    $max_depth = 0;
                    $min_temp = 9999;
                    $profile_check = true;
                }
            } else {
                if (substr($row, 0, 4) == 'ZDP}') {
                    $profile_check = false;
                } else {
                    $row = str_replace(' ', '', $row);
                    $row = str_replace(',', '.', $row);
                    $f = array();
                    $f = explode('|', $row);
                    if (isset($f[1])) {
                        if (substr_count($f[1], '.') > 1)
                            $f[1] = floatval($f[1]);
                        if ((float) $f[1] == 0 && $line_count > 0)
                            continue;
                        $dives[$dives_count]['profile'][$line_count]['timesec'] = round($f[1] * 60);
                        if ($line_count == 0 && (!$f[3] || $f[3] == ''))
                            $f[3] = '1.21';
                        if ($f[3]) {
                            $used_gas = $this->getGasSwitch($f[3]);
                            $dives[$dives_count]['profile'][$line_count]['gases'] = $used_gas;
                            $dives[$dives_count]['profile'][$line_count]['marker'] = self::getMarkerUrl(($used_gas));
                        }
                        if ($depth_unit == "FSWG" || $depth_unit == "FFWG") {
                            $f[2] = (float) $f[2] / 3.2808;
                        } elseif ($depth_unit == "MFWG") {
                            $f[2] = $f[2];
                        }
                        $dives[$dives_count]['profile'][$line_count]['depth'] = (float) $f[2];
                        $dives[$dives_count]['profile'][$line_count]['tank_pressure'] = null;
                        if (isset($f[10]) && $f[10]) {
                            $f[10] = round((int) $f[10]);
                            if ($tank_press_unit == "PSIA") {
                                $f[10] = round((int) $f[10] * 0.0689475729);
                            }
                            $dives[$dives_count]['profile'][$line_count]['tank_pressure'] = $f[10];
                        }
                        $dives[$dives_count]['profile'][$line_count]['temp'] = null;
                        if (isset($f[8]) && $f[8]) {
                            if ($temp_unit == "F")
                                $f[8] = round(((float) $f[8] - 32) / 1.8);
                            elseif ($temp_unit == "K")
                                $f[8] = round((float) $f[8] - 272.15);
                            $dives[$dives_count]['profile'][$line_count]['temp'] = $f[8];
                        }
                        $dives[$dives_count]['profile'][$line_count]['tank_volume'] = null;
                        if (isset($f[15]) && $f[15]) {
                            if ($tank_vol_unit == "CF") {
                                $f[15] = round((float) $f[15] / 0.035315);
                            }
                            $dives[$dives_count]['profile'][$line_count]['tank_volume'] = $f[15];
                        }
                        $line_count++;
                        $perc = ceil(($idx + 1) * 100 / $rows_count);
                    }
                }
            }
        }

        $message = $this->diveArrayToDb($dives);
        if (!$message['warnings'])
            $out['success'] = true;
        else
            $out['warning'] = $message['warnings'];
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
            $dives[$dives_count]['profile'][$line_count]['timesec'] = (int) $divePoint['time'] - (int) $dive['datetime'];
            $dives[$dives_count]['profile'][$line_count]['time'] = (int) $divePoint['time'];
            $dives[$dives_count]['profile'][$line_count]['depth'] = (float) $divePoint['depth'] * -1;

            if ($dives[$dives_count]['profile'][$line_count]['depth'] > $max_depth)
                $max_depth = $dives[$dives_count]['profile'][$line_count]['depth'];
            $dives[$dives_count]['profile'][$line_count]['tankPressure'] = null;
            if (isset($divePoint['tankPressure']))
                $dives[$dives_count]['profile'][$line_count]['tankPressure'] = round((float) $divePoint['tankPressure'] / 100000);
            $dives[$dives_count]['profile'][$line_count]['temp'] = null;
            if (isset($divePoint['temperature'])) {
                $dives[$dives_count]['profile'][$line_count]['temp'] = (float) $divePoint['temperature'];
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
            $line_count++;
        }

        $message = $this->diveArrayToDb($dives);
        if (!$message['warnings'])
            $out['success'] = true;
        else
            $out['warning'] = $message['warnings'];
        $out['createdDives'] = $message['createdDives'];
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
        //dd(Storage::url("gas_switch/"));
        if ($gases) {
            if ($gases['he'] == 0)
                return Storage::disk('local')->url("gas_switch/" . $gases['o2'] . ".png");
            else
                return Storage::disk('local')->url("gas_switch/trmx.png");
        }
        return null;
    }


    private function diveArrayToDb($dives)
    {
        ini_set('memory_limit', '-1');
        $mess = null;
        $createdDives = null;
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
                $c = 1;
                while ($time_shift == 0) {
                    $time_shift = (int)$dive['profile'][$c]['timesec'];
                    $c++;
                    if (!isset($dive['profile'][$c]['timesec']))
                        break;
                }

                array_unshift($dive['profile'], $first_point);
            }
            $p_count = count($dive['profile']);
            $last_idx = $p_count - 1;
            if ($dive['profile'][$last_idx]['depth'] > 0) {

                $time_interval = $dive['profile'][$last_idx]['timesec'] - $dive['profile'][$last_idx - 1]['timesec'];
                $curr_time = $dive['profile'][$last_idx]['timesec'];
                $curr_idx = $last_idx;
                $curr_time += $time_interval;
                $curr_idx++;
                $dive['profile'][$curr_idx]['depth'] = 0;
                $dive['profile'][$curr_idx]['timesec'] = $curr_time;
                $dive['profile'][$curr_idx]['tankPressure'] =  Arr::get($dive, 'profile.' . $last_idx . '.tankPressure', 0);
                $dive['profile'][$curr_idx]['temp'] = $dive['profile'][$last_idx]['temp'];
                $dive['profile'][$curr_idx]['tankVolume'] = Arr::get($dive, 'profile.' . $last_idx . '.tankVolume', 0);
                if (isset($dive['profile'][$last_idx]['gases']))
                    $dive['profile'][$curr_idx]['gases'] = $dive['profile'][$last_idx]['gases'];
                $dive['profile'][$curr_idx]['calculated'] = true;
            }

            $prev_temp = null;
            $prev_depth = null;
            $prev_time = -999999;
            ProgressEvent::dispatch("SAVING_DIVE", 0, $diveId);
            $lastGas = null;
            $pointsToBeRemoved = [];
            $lineCount = 0;
            $divePointCount = count($dive['profile']);
            $diveError = false;
            for ($i = 0; $i < $divePointCount; $i++) {
                if ($time_shift > 0 && $lineCount > 0) {
                    $dive['profile'][$lineCount]['timesec'] += $time_shift;
                }
                if ($dive['profile'][$lineCount]['timesec'] <= $prev_time) {
                    dd([$dive['profile'][$lineCount]['timesec'],$prev_time]);
                    array_splice($dive['profile'], $lineCount, 1);
                    $divePointCount = count($dive['profile']);
                    $diveError = true;
                    break;
                }
                $prev_time = $dive['profile'][$lineCount]['timesec'];

                $ts = $start_time_carbon->clone()->addSeconds((int) $dive['profile'][$lineCount]['timesec']);
                $dive['profile'][$lineCount]['compartmentLoad'] = [];
                $dive['profile'][$lineCount]['compartmentGfs'] = [];
                $dive['profile'][$lineCount]['timestamp'] = new \DateTime($ts->toDateTimeString());
                $dive['profile'][$lineCount]['time'] = $dive['profile'][$lineCount]['timesec'] / 60;
                if ($dive['type'] == 'reb') {
                    $gas['o2'] = DiveFunctions::getBestO2Fraction(1.2, ($dive['profile'][$lineCount]['depth'] / 10) + 1);
                    $gas['he'] = 0;
                    $gas['n2'] = 100 - $gas['o2'];

                    $dive['profile'][$lineCount]['gases'] = $gas;
                    if (isset($dive['profile'][$lineCount]['marker']))
                        unset($dive['profile'][$lineCount]['marker']);
                }
                if (isset($dive['profile'][$lineCount]['gases'])) {
                    if ($dive['profile'][$lineCount]['gases'] == $lastGas) {
                        unset($dive['profile'][$lineCount]['gases']);
                        unset($dive['profile'][$lineCount]['marker']);
                    } else
                        $lastGas = $dive['profile'][$lineCount]['gases'];
                }
                $vs = 0;
                if ($lineCount > 0) {

                    $d_depth = $dive['profile'][$lineCount]['depth'] - $prev_depth;
                    $d_time = $dive['profile'][$lineCount]['timesec'] - $prev_time;
                    if ($d_time > 0) {
                        $vs = round($d_depth / ($d_time / 60));
                    }
                }
                $dive['profile'][$lineCount]['vs'] = $vs * -1;
                if (!$dive['profile'][$lineCount]['temp'])
                    $dive['profile'][$lineCount]['temp'] = $prev_temp;
                if (!isset($dive['profile'][$lineCount]['calculated']))
                    $dive['profile'][$lineCount]['calculated'] = false;
                if ($dive['profile'][$lineCount]['depth'] > $max_depth)
                    $max_depth = $dive['profile'][$lineCount]['depth'];
                if ($dive['profile'][$lineCount]['temp'] === null && $prev_temp) {
                    $dive['profile'][$lineCount]['temp'] = $prev_temp;
                }
                if ($dive['profile'][$lineCount]['temp'] !== null) {
                    $temp = (float)$dive['profile'][$lineCount]['temp'];
                    if ($temp < $min_temp)
                        $min_temp = $temp;
                } else  $temp = null;
                if ((float) $dive['profile'][$lineCount]['depth'] <= 0.05 && !$surface_step)
                    $surface_step = $count;
                elseif ((float) $dive['profile'][$lineCount]['depth'] > 0.50)
                    $surface_step = null;
                $dive_time = $dive['profile'][$lineCount]['timesec'];
                $prev_temp = $temp;
                $prev_depth = $dive['profile'][$lineCount]['depth'];
                $count++;
                if ($count == 1 || $count % 30 == 0 || $count == $p_count) {
                    $dive['miniChart'][] = $dive['profile'][$lineCount]['depth'] * -1;
                }
                $perc = ceil($count * 100 / $p_count);
                if ($perc > 100)
                    $perc = 100;
                $lineCount++;
                //ProgressEvent::dispatch("SAVING_DIVE", $perc, $diveId);
            }
            if (!$diveError) {
                if ($dive['type'] == 'reb') {
                    $dive['profile'][0]['marker'] = Storage::disk('local')->url("gas_switch/reb.png");
                    $dive['rebData']['diluent'] = ['o2' => 21, 'n2' => 79, "he" => 0];
                    $dive['rebData']['ppo2s'][] = ['time' => 0, 'ppo2' => 1.2];
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
                $d = Dive::create($dive);

                //$d->profile()->createMany($profile);

                $gfCalculator = new DecoCalculator($d);
                ProgressEvent::dispatch("ANALYZING_DIVE", 0, $diveId);
                $gfCalculator->calculateGF();
                $createdDives[] =  $d;
            }
            else
                $mess['invalid_data'][] = $dive['date'];
            //GradientFactor::calculate(null, $event->divesInfos, false);
            //CalcDeepStop($dive);
        }
        return ['warnings' => $mess, 'createdDives' => $createdDives];
    }
}
