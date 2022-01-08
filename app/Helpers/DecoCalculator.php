<?php

namespace App\Helpers;

use App\Events\ProgressEvent;
use \App\Models\Dive;

class DecoCalculator
{
    private $half_times_N2 = array(4.0, 8.0, 12.5, 18.5, 27.0, 38.3, 54.3, 77.0, 109.0, 146.0, 187.0, 239.0, 305.0, 390.0, 498.0, 635.0);
    private $Acoef_N2 = array(1.2599, 1.0000, 0.8618, 0.7562, 0.6200, 0.5043, 0.4410, 0.4000, 0.3750, 0.3500, 0.3295, 0.3065, 0.2835, 0.2610, 0.2480, 0.2327,);
    private $Bcoef_N2 = array(0.5050, 0.6514, 0.7222, 0.7825, 0.8126, 0.8434, 0.8693, 0.891, 0.9092, 0.9222, 0.9319, 0.9403, 0.9477, 0.9544, 0.9602, 0.9653);

    private $half_times_He = array(1.51,    3.02,    4.72,    6.99,    10.21,    14.48,    20.53,    29.11,    41.20,    55.19,    70.69,    90.34,    115.29,    147.42,    188.24,    240.03);
    private $Acoef_He = array(1.7424, 1.3830, 1.1919, 1.0458, 0.9220, 0.8205, 0.7305, 0.6502, 0.5950, 0.5545, 0.5333, 0.5189, 0.5181, 0.5176, 0.5172, 0.5119);
    private $Bcoef_He = array(0.4245, 0.5447, 0.6527, 0.7223, 0.7582, 0.7957, 0.8279, 0.8553, 0.8757, 0.8903, 0.8997, 0.9073, 0.9122, 0.9171, 0.9217, 0.9267);

    private $wv_p = 0;
    private $pSurf = 1;
    private $metersToAtm = 10;

    private $compartmentLoad;
    private $compartmentGfs;

    private $dive;

    public function __construct(Dive $dive)
    {
        $this->dive = $dive;
    }


    public function calculateGF()
    {
        $prevDive = $this->dive->previousDive();
        if ($prevDive) {
            $this->compartmentLoad = $prevDive->lastProfilePoint()['compartmentLoad'];
            $surfaceInterval = $this->dive->date->diffInSeconds($prevDive->endDate);
            $this->surafaceIntervalGasDeloading($surfaceInterval);
        } else
            $this->resetCompartmentLoading();

        $this->calculateLoadings($this->dive);

        do {
            $nextDive = $this->dive->nextDive();
            if ($nextDive) {
                $surfaceInterval = $nextDive->date->diffInSeconds($this->dive->endDate);
                $this->surafaceIntervalGasDeloading($surfaceInterval);
                $this->dive = $nextDive;
                $this->calculateLoadings($nextDive);
            }
        } while ($nextDive);
        //echo 'done';
    }

    private function calculateLoadings(Dive $actualDive)
    {
        $profileSamples = $actualDive->profile;
        $lastSample = null;
        $maxGfComb = -999;
        $maxGfCombComp = 0;
        $maxGfCombComputer = -999;
        $maxGfCombCompComputer = 0;
        $actualN2Fraction = 0.79;
        $actualHeFraction = 0;
        $newProfile=[];
        $lastGas=null;
        $p_count=count($profileSamples);

        foreach ($profileSamples as $sampleIdx => $sample) {
            $newProfile[$sampleIdx]=$sample;
            if (isset($sample['gases']['n2'])) {
                if ($sample['gases']!=$lastGas) {
                    $lastGas=$sample['gases'];
                }
                else {
                    unset($newProfile[$sampleIdx]['gases']);
                }
                $actualN2Fraction = $sample['gases']['n2'] / 100;
                $actualHeFraction = $sample['gases']['he'] / 100;
            }
            if ($sampleIdx == 0) {
                $lastSample = $sample;
                continue;
            }
            $timeInterval = $sample['time'] - $lastSample['time'];
            $deltaDepth = (float) $sample['depth'] - (float) $lastSample['depth'];

            $verticalSpeedMps = $deltaDepth / $timeInterval;
            $verticalSpeedBar = $verticalSpeedMps / $this->metersToAtm;

            $previousPressure = $this->pSurf + ($lastSample['depth'] / $this->metersToAtm);
            $actualPressure = $this->pSurf + ($sample['depth'] / $this->metersToAtm);


            //echo 'time = ' . $sample->timesec . 'sec  - time interval = ' . $timeInterval . ' - depth = ' . $sample['depth'] . 'm - Delta = ' . $deltaDepth . 'm - speed = ' . $verticalSpeedMps . 'm/min N2 Fract = ' . $actualN2Fraction . ' - He Fract = ' . $actualHeFraction . '<br>';
            foreach ($this->compartmentLoad as $idx => $load) {
                $this->compartmentLoad[$idx]['n2'] = $this->eq_schreiner($previousPressure, $timeInterval, $actualN2Fraction, $verticalSpeedBar, $load['n2'], $this->half_times_N2[$idx]);
                $this->compartmentLoad[$idx]['he'] = $this->eq_schreiner($previousPressure, $timeInterval, $actualHeFraction, $verticalSpeedBar, $load['he'], $this->half_times_He[$idx]);
                $combLoad = $this->compartmentLoad[$idx]['n2'] + $this->compartmentLoad[$idx]['he'];

                $combA = ($this->Acoef_He[$idx] * $this->compartmentLoad[$idx]['he'] + $this->Acoef_N2[$idx] * $this->compartmentLoad[$idx]['n2']) / ($combLoad);
                $combB = ($this->Bcoef_He[$idx] * $this->compartmentLoad[$idx]['he'] + $this->Bcoef_N2[$idx] * $this->compartmentLoad[$idx]['n2']) / ($combLoad);
                $mValComb = ($actualPressure / $combB) + $combA;
                //return($mValComb);
                //$gf_comb = ($combLoad - ($PalvN2 + $PalvHe)) / ($m_val_comb - ($PalvN2 + $PalvHe));
                //$gf_combPMR=($combLoad - ($PalvN2 + $PalvHe)) / ($m_val_combPMR - ($PalvN2 + $PalvHe));

                $gfComb = ($combLoad) / ($mValComb);

                if ($gfComb > $maxGfComb) {
                    $maxGfComb = $gfComb;
                    $maxGfCombComp = $idx;
                }
                if (!isset($sample->calculated) || !$sample->calculated) {
                    if ($gfComb > $maxGfCombComputer) {
                        $maxGfCombComputer = $gfComb;
                        $maxGfCombCompComputer = $idx;
                    }
                }
                $this->compartmentGfs[$idx] = $gfComb;
                //echo  'comparment ' . $idx . ' (halftime = ' . $this->half_times_N2[$idx] . ') = ' . $this->compartmentLoad[$idx]['n2'] . ' BAR<br>';
                //echo 'comparment ' . $idx . ' (halftime = ' . $this->half_times_He[$idx] . ') = ' . $this->compartmentLoad[$idx]['he'] . ' BAR<br>';
                //echo 'CombA = ' . $combA . ' - CombB = ' . $combB . ' - CombLoad = ' . $combLoad . ' - CombM-Value = ' . $mValComb . ' - CombGF = ' . $gfComb . '<br><br>';


            }

            $newProfile[$sampleIdx]['compartmentLoad'] = $this->compartmentLoad;
            $newProfile[$sampleIdx]['compartmentGfs'] =  $this->compartmentGfs;
            //$sample->save();
            $lastSample = $sample;
            $perc = ceil(($sampleIdx + 1) * 100 / $p_count);
            if ($perc > 100)
                $perc = 100;
            ProgressEvent::dispatch("ANALYZING_DIVE", $perc);

        }
        $actualDive->gf = [
            'value' => $maxGfComb,
            'compartment' => $maxGfCombComp,
        ];
        $actualDive->gfComputer = [
            'value' => $maxGfCombComputer,
            'compartment' => $maxGfCombCompComputer,
        ];
        $actualDive->profile=$newProfile;
        $actualDive->save();
    }

    public function calculateCeiling($gfHi, $gfLow)
    {
        $count = 0;
        $lastDepth = null;
        $maxDepth = null;
        $maxCeiling = null;
        $ceilingCount = 0;
        $ceiling = null;
        $actualN2Fraction = 0.79;
        $actualHeFraction = 0;
        ProgressEvent::dispatch("CALC_CEIL",0);
        $totalSamples=count($this->dive->profile);
        foreach ($this->dive->profile as $ids => $sample) {
            $count++;
            $ndl=0;
            if ($count == 1)
                continue;
            if (!isset($sample['depth']))
                continue;

            $lastDepth = (float) $sample['depth'];
            if (!isset($sample['depth']))
                continue;
            if ($lastDepth > $maxDepth)
                $maxDepth = $lastDepth;
            if ($maxCeiling > 0) {
                $gfSlope = ($gfHi - $gfLow) / (0 - $maxCeiling);
                $gfCeil = ($gfSlope * $ceiling) + $gfHi;
            } else
                $gfCeil = $gfLow;

            $app['gfCeil'] = $gfCeil;

            $ceiling = null;
            if (isset($sample->gases->n2)) {
                $actualN2Fraction = $sample->gases->n2 / 100;
                $actualHeFraction = $sample->gases->he / 100;
            }
            foreach ($sample['compartmentLoad'] as $idx => $load) {
                $ceilPress = $this->eq_gf_limit($gfCeil, $load['n2'], $load['he'], $this->Acoef_N2[$idx], $this->Bcoef_N2[$idx], $this->Acoef_He[$idx], $this->Bcoef_He[$idx]);
                $ceilDepth = ($ceilPress - 1) * $this->metersToAtm;
                if ($ceilDepth > 0.4)
                    $ceilDepth = $this->roundUpToAny($ceilDepth);
                else
                    $ceilDepth = 0;
                if ($ceilDepth > $ceiling) {
                    $ceiling = $ceilDepth;
                }
            }
            $ceilingCount++;
            $app['decoTime'] = 999;
            $app['ndl']=0;
            if ($ceiling > 0) {
                $app['decoTime'] = 0;
                $this->compartmentLoad = $sample['compartmentLoad'] ;
                do {
                    $app['decoTime']++;
                    $ceil_app = null;
                    $ceiling_app=[];
                    foreach ($this->compartmentLoad as $idx => $load) {
                        $ceilDepthPress = 1 + ($ceiling / $this->metersToAtm);
                        $curr_load_N2 = $this->eq_schreiner($ceilDepthPress, $app['decoTime'], $actualN2Fraction, 0, $load['n2'], $this->half_times_N2[$idx], $this->wv_p);

                        $curr_load_He = $this->eq_schreiner($ceilDepthPress, $app['decoTime'], $actualHeFraction, 0, $load['he'], $this->half_times_He[$idx], $this->wv_p);

                        $ceil_press_app = $this->eq_gf_limit($gfCeil, $curr_load_N2, $curr_load_He, $this->Acoef_N2[$idx], $this->Bcoef_N2[$idx],$this->Acoef_He[$idx], $this->Bcoef_He[$idx]);


                        $ceil_depth_app = ($ceil_press_app - 1) * $this->metersToAtm;
                        if ($ceil_depth_app > 0.4)
                            $ceil_depth_app = $this->roundUpToAny($ceil_depth_app);
                        else
                            $ceil_depth_app = 0;
                        $ceiling_app[$idx] = $ceil_depth_app;
                    }
                    $next_ceil_lim = $ceiling - 3;
                    foreach ($ceiling_app as $c) {
                        if ($c >= $ceil_app)
                            $ceil_app = $c;
                    }
                } while ($ceil_app > $next_ceil_lim);
            }
            else {
                $app['ndl'] = 0;
                $this->compartmentLoad = $sample['compartmentLoad'] ;
                do {
                    $actualPressure = $this->pSurf + ($sample['depth'] / $this->metersToAtm);
                    $app['ndl']++;
                    $ceil_app = null;
                    $ceiling_app=[];
                    foreach ($this->compartmentLoad as $idx => $load) {
                        $curr_load_N2 = $this->eq_schreiner($actualPressure, $app['ndl'], $actualN2Fraction, 0, $load['n2'], $this->half_times_N2[$idx], $this->wv_p);

                        $curr_load_He = $this->eq_schreiner($actualPressure, $app['ndl'], $actualHeFraction, 0, $load['he'], $this->half_times_He[$idx], $this->wv_p);

                        $ceil_press_app = $this->eq_gf_limit($gfCeil, $curr_load_N2, $curr_load_He, $this->Acoef_N2[$idx], $this->Bcoef_N2[$idx],$this->Acoef_He[$idx], $this->Bcoef_He[$idx]);


                        $ceil_depth_app = ($ceil_press_app - 1) * $this->metersToAtm;
                        if ($ceil_depth_app > 0.4)
                            $ceil_depth_app = $this->roundUpToAny($ceil_depth_app);
                        else
                            $ceil_depth_app = 0;
                        $ceiling_app[$idx] = $ceil_depth_app;
                    }
                    foreach ($ceiling_app as $c) {
                        if ($c >= $ceil_app)
                            $ceil_app = $c;
                    }

                    //echo "idx: ".$ids." - ceil: ".$ceil_app.' - NDL:'.$app['ndl'].'</br>';
                    if ($app['ndl']>98 || $ceil_app>0)
                        break;
                } while (true);
            }
            if ($ceiling > $maxCeiling)
                $maxCeiling = $ceiling;
            //echo "idx: ".$ids.' - NDL:'.$app['ndl'].'</br>';
            $app['ceil'] = $ceiling * -1;
            $app['gfUsed'] = round($gfCeil, 3);
            $ceilings[] = $app;
            $perc=ceil($count * 100 / $totalSamples);
            ProgressEvent::dispatch("CALC_CEIL",$perc);
        }
        return $ceilings;
    }
    //interval in sec
    private function surafaceIntervalGasDeloading($interval = 0)
    {
        foreach ($this->compartmentLoad as $idx => $load) {
            $this->compartmentLoad[$idx]['n2'] = $this->eq_schreiner(1, $interval / 60, 0.79 * (1 - $this->wv_p), 0, $load['n2'], $this->half_times_N2[$idx]);
            $this->compartmentLoad[$idx]['he'] = $this->eq_schreiner(1, $interval / 60, 0 * (1 - $this->wv_p), 0, $load['he'], $this->half_times_He[$idx]);
        }
    }
    private function resetCompartmentLoading()
    {

        for ($i = 0; $i < 16; $i++) {
            $this->compartmentLoad[$i]['n2'] = 0.79 * (1 - $this->wv_p);
        }
        for ($i = 0; $i < 16; $i++) {
            $this->compartmentLoad[$i]['he'] = 0;
        }
    }

    private function roundUpToAny($n, $x = 3)
    {
        return (ceil(ceil($n) / $x) * $x);
        return (ceil($n) % $x === 0) ? round($n) : round(($n + $x / 2) / $x) * $x;
    }

    private function eq_schreiner($abs_p, $time, $gas, $rate, $pressure, $half_life, $wvp = 0.0626615132)
    {
        /*
          Calculate pressure in a tissue compartment using Schreiner equation.

          See :ref:`eq-schreiner` section for details.

          :param abs_p: Absolute pressure of current depth [bar] (:math:`P_abs`).
          :param time: Time of exposure [s], i.e. time of ascent (:math:`T_time`).
          :param gas: Inert gas fraction, i.e. for air it is 0.79 (:math:`F_gas`).
          :param rate: Pressure rate change [bar/min] (:math:`P_rate`).
          :param pressure: Current, initial pressure in tissue compartment [bar]
          (:math:`P`).
          :param half_life: Current tissue compartment half-life time constant value
          (:math:`T_hl`).
          :param wvp: Water vapour pressure (:math:`P_wvp`).
         */
        //$wvp=0;
        $p1alv = $gas * ($abs_p - $wvp);
        $t = $time;
        $k = log(2) / $half_life;
        $r = $p1alv * $rate;
        return $p1alv + $r * ($t - 1 / $k) - ($p1alv - $pressure - $r / $k) * exp(-$k * $t);
    }

    private function eq_gf_limit($gf, $p_n2, $p_he = 0, $a_n2, $b_n2, $a_he = 0, $b_he = 0)
    {
        /*
          Calculate ascent ceiling limit of a tissue compartment using Buhlmann
          equation extended with gradient factors by Eric Baker.

          The returned value is absolute pressure of depth of the ascent ceiling.

          :param gf: Gradient factor value.
          :param p_n2: Current tissue pressure for nitrogen.
          :param p_he: Current tissue pressure for helium.
          :param a_n2: Nitrox Buhlmann coefficient A.
          :param b_n2: Nitrox Buhlmann coefficient B.
          :param a_he: Helium Buhlmann coefficient A.
          :param b_he: Helium Buhlmann coefficient B.
         */

        $p = $p_n2 + $p_he;
        $a = ($a_n2 * $p_n2 + $a_he * $p_he) / $p;
        $b = ($b_n2 * $p_n2 + $b_he * $p_he) / $p;
        return ($p - $a * $gf) / ($gf / $b + 1.0 - $gf);
    }
}
