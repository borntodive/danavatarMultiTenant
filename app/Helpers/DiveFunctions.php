<?php

namespace App\Helpers;

use App\Events\ProgressEvent;
use App\Models\Dive;

class DiveFunctions
{
    public static function getBestO2Fraction($ppO2, $pAmb)
    {
        $o2 = round(($ppO2 / $pAmb) * 100);
        $o2 = $o2 > 100 ? 100 : $o2;
        $o2 = $o2 < 0 ? 0 : $o2;
        return $o2;
    }
    public static function getBestMix($ppO2, $pAmb,$diluent) {
        $o2=self::getBestO2Fraction($ppO2, $pAmb);
        $hen2=100 - $o2;
        $he=round(($hen2 * $diluent['he'])/ ($diluent['he'] +  $diluent['n2']));
        $n2=100 - $o2 - $he;
        return ['o2'=>$o2,'he'=>$he,'n2'=>$n2];
    }

    public static function calculateBestMixProfile(Dive $dive) {
        $diluent = $dive->rebData['diluent'];
        $profile = $dive->profile;
        $p_count = count($profile);
        $ppo2Count = 0;
        foreach ($profile as $idx => $sample) {
            $perc = ceil(($idx + 1) * 100 / $p_count);
            if ($perc > 100)
                $perc = 100;
            ProgressEvent::dispatch("SAVING_TANK", $perc);

            if (isset($dive->rebData['ppo2s'][$ppo2Count + 1]) && $sample['timesec'] == $dive->rebData['ppo2s'][$ppo2Count + 1]['time']) {
                $ppo2Count++;
            }
            $currentPPO2 = $dive->rebData['ppo2s'][$ppo2Count];
            $profile[$idx]['gases'] = DiveFunctions::getBestMix($currentPPO2['ppo2'], ($sample['depth'] / 10) + 1, $diluent);
            $profile[$idx]['marker'] = null;
        }
        $dive->profile = $profile;
        $dive->save();
        $decoCalc = new DecoCalculator($dive);
        $decoCalc->calculateGF();
    }
}
