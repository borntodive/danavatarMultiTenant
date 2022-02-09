<?php

namespace App\Http\Livewire\MedicalRecord\Diving;

use App\StaticData\Diving;
use App\Traits\MedicalRecord\ViewMedicalRecord;
use Livewire\Component;

class View extends Component
{
    use ViewMedicalRecord;

    public $radios;

    public $sintomi;

    public $scuba;

    public $apnea;

    public $dcs;

    public $first_treatment;

    public $others_treatment;

    public function mount()
    {
        $this->radios = Diving::$radios;
        $this->sintomi = Diving::$sintomi;
        $this->scuba = Diving::$scuba;
        $this->apnea = Diving::$apnea;
        $this->dcs = Diving::$dcs;
        $this->first_treatment = Diving::$first_treatment;
        $this->others_treatment = Diving::$others_treatment;
        if (! data_get($this->medicalRecord->data, 'anamnesis.diving.dcs', false)) {
            data_set($this->medicalRecord->data, 'anamnesis.diving.dcs', [0=>['date'=>null]]);
        }
    }
}
