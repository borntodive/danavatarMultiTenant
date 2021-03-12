<?php

namespace App\Http\Livewire\MedicalRecord\Nutritionist;

use App\StaticData\Nutritionist;
use App\Traits\MedicalRecord\ViewMedicalRecord;
use Livewire\Component;

class View extends Component
{

    use ViewMedicalRecord;

    public $medications;
    public $medicalConditions;

    public function mount() {
        $this->medicalConditions=Nutritionist::$medicalConditions;
        $this->medications=Nutritionist::$medications;
    }

}
