<?php

namespace App\Http\Livewire\MedicalRecord\Otolaryngology;

use App\StaticData\Otolaryngology;
use App\Traits\MedicalRecord\EditMedicalRecord;
use Livewire\Component;

class Edit extends Component
{
    use EditMedicalRecord {
        mount as parentMount;
    }

    public $externalEarObjective,$tympanicMembraneObjective,$tympanicMembraneMobilityObjective;

    public function mount() {

        $this->parentMount();
        $this->externalEarObjective=Otolaryngology::$externalEarObjective;
        $this->tympanicMembraneObjective=Otolaryngology::$tympanicMembraneObjective;
        $this->tympanicMembraneMobilityObjective=Otolaryngology::$tympanicMembraneMobilityObjective;
        if (!data_get($this->medicalRecord->data,'anamnesis.general.sinus',false)){
            data_set($this->state,'anamnesis.general.sinus',[]);
        }
        if (!data_get($this->medicalRecord->data,'anamnesis.general.faringe',false)){
            data_set($this->state,'anamnesis.general.faringe',[]);
        }
        if (!data_get($this->medicalRecord->data,'anamnesis.general.cavoOrale',false)){
            data_set($this->state,'anamnesis.general.cavoOrale',[]);
        }
        if (!data_get($this->medicalRecord->data,'objectives.externalEar.dx',false)){
            data_set($this->state,'objectives.externalEar.dx',[]);
        }
        if (!data_get($this->medicalRecord->data,'objectives.externalEar.sx',false)){
            data_set($this->state,'objectives.externalEar.sx',[]);
        }
        if (!data_get($this->medicalRecord->data,'objectives.general.nose.anomalies',false)){
            data_set($this->state,'objectives.general.nose.anomalies',[]);
        }
        if (session()->get('tenant')->hasMedicalSpecilities('diving')){
            if (!data_get($this->medicalRecord->data,'diving.sinusEqaulization.location',false)) {
                data_set($this->state, 'diving.sinusEqaulization.location', []);
            }
        }
    }
}
