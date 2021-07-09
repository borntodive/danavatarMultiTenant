<?php

namespace App\Http\Livewire\MedicalRecord\Diving;

use App\StaticData\Diving;
use App\Traits\MedicalRecord\EditMedicalRecord;
use Livewire\Component;

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
    public $first_treatment;
    public $others_treatment;

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
        $this->first_treatment=Diving::$first_treatment;
        $this->others_treatment=Diving::$others_treatment;
        if (!data_get($this->state,'anamnesis.diving.dcs',false)){
            data_set($this->state,'anamnesis.diving.dcs',[0=>['date'=>null]]);
        }

    }

    public function addTreatment() {
        $this->state['anamnesis']['diving']['dcs'][]=['date'=>null];
        //dd(data_get($this->state,'anamnesis.diving.dcs',["none"]));
    }

}


