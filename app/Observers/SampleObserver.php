<?php

namespace App\Observers;

use App\Models\Sample;
use App\Models\SensorsPerDay;
use Carbon\Carbon;

class SampleObserver
{
    /**
     * Handle the sample "created" event.
     *
     * @param Sample $sample
     */
    public function created(Sample $sample)
    {
        $currentDate=Carbon::createFromTimestamp($sample['date'])->previous('00:00');
        $currentSensorsPerDay=SensorsPerDay::firstOrNew (['date' => $currentDate->format('Y-m-d H:i:s.u'),'user_id'=>$sample->user_id]);
        $prevSensors=$currentSensorsPerDay->sensors;
        if (is_array($currentSensorsPerDay->sensors))
            $currentSensorsPerDay->sensors=array_unique(array_merge($currentSensorsPerDay->sensors,[$sample->sensor_id]));
        else
            $currentSensorsPerDay->sensors=[$sample->sensor_id];
        if ($prevSensors!=$currentSensorsPerDay->sensors)
            $currentSensorsPerDay->save();
        error_log($currentSensorsPerDay->sensors);
    }

    /**
     * Handle the sample "updated" event.
     *
     * @param Sample $sample
     */
    public function updated(Sample $sample)
    {
        //
    }

    /**
     * Handle the sample "deleted" event.
     *
     * @param Sample $sample
     */
    public function deleted(Sample $sample)
    {
        //
    }

    /**
     * Handle the sample "restored" event.
     *
     * @param Sample $sample
     */
    public function restored(Sample $sample)
    {
        //
    }

    /**
     * Handle the sample "force deleted" event.
     *
     * @param Sample $sample
     */
    public function forceDeleted(Sample $sample)
    {
        //
    }
}
