<?php

namespace App\Http\Livewire\MedicalRecord\Diving;

use App\StaticData\Diving;
use App\Traits\MedicalRecord\EditMedicalRecord;
use Livewire\Component;
use phpDocumentor\Reflection\Types\This;

class Edit extends Component
{
    use EditMedicalRecord {
        mount as parentMount;
    }

    public $radios;
    public $sintomi;
    public $scuba;
    public $apnea;
    public $dcs;

    protected $rules = [
        'state.anamnesis' => 'nullable',
    ];

    public function mount() {

        $this->parentMount();
        $this->radios=Diving::$radios;
        $this->sintomi=Diving::$sintomi;
        $this->scuba=Diving::$scuba;
        $this->apnea=Diving::$apnea;
        $this->dcs=Diving::$dcs;


    }

}


