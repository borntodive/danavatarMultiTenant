<?php

namespace App\Http\Livewire\MedicalRecord\Cardio;

use App\StaticData\Cardio;
use App\Traits\MedicalRecord\ViewMedicalRecord;
use Livewire\Component;

class View extends Component
{
    use ViewMedicalRecord;

    public $terapie;

    public $patologie;

    public $ecg;

    public function mount()
    {
        $this->terapie = Cardio::$terapie;
        $this->patologie = Cardio::$patologie;
        $this->ecg = Cardio::$ecg;
    }
}
