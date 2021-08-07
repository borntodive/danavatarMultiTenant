<?php

namespace App\Http\Livewire\MedicalRecord\Waterquality;

use App\StaticData\WaterQuality;
use App\Traits\MedicalRecord\EditMedicalRecord;
use Livewire\Component;

class Edit extends Component
{
    use EditMedicalRecord {
        mount as parentMount;
    }

    public $fields;



    protected $rules = [
        'state.anamnesis' => 'nullable',
    ];

    public function mount() {

        $this->parentMount();
        $this->fields=WaterQuality::$fields;

    }

}
