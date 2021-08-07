<?php

namespace App\Http\Livewire\MedicalRecord\Waterquality;

use App\StaticData\WaterQuality;
use App\Traits\MedicalRecord\ViewMedicalRecord;
use Livewire\Component;

class View extends Component
{

    use ViewMedicalRecord;
    public $fields;

    public function mount() {
        $this->fields=WaterQuality::$fields;
    }

}
