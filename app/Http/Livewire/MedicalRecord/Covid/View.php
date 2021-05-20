<?php

namespace App\Http\Livewire\MedicalRecord\Covid;

use App\StaticData\Covid;
use App\Traits\MedicalRecord\ViewMedicalRecord;
use Livewire\Component;

class View extends Component
{

    use ViewMedicalRecord;
    public $exams;

    public function mount() {
        $this->exams=Covid::$exams;
    }

}
