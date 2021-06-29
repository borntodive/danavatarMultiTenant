<?php

namespace App\Http\Livewire\MedicalRecord\Neuro;

use App\StaticData\Dentist;
use App\Traits\MedicalRecord\ViewMedicalRecord;
use Livewire\Component;

class View extends Component
{

    use ViewMedicalRecord;
    public $equalizationLevel;
    public $equalizationTecnique;

    public function mount() {
        $this->equalizationLevel=Dentist::$equalizationLevel;
        $this->equalizationTecnique=Dentist::$equalizationTecnique;
    }

}
