<?php

namespace App\Http\Livewire\MedicalRecord\Otolaryngology;

use App\Traits\MedicalRecord\EditMedicalRecord;
use Livewire\Component;

class Edit extends Component
{
    use EditMedicalRecord {
        mount as parentMount;
    }
    public function mount() {

        $this->parentMount();
        if (!data_get($this->medicalRecord->data,'anamnesis.general.sinus',false)){
            data_set($this->state,'anamnesis.general.sinus',[]);
        }
        if (!data_get($this->medicalRecord->data,'anamnesis.general.faringe',false)){
            data_set($this->state,'anamnesis.general.faringe',[]);
        }
        if (!data_get($this->medicalRecord->data,'anamnesis.general.cavoOrale',false)){
            data_set($this->state,'anamnesis.general.cavoOrale',[]);
        }
        if (session()->get('tenant')->hasMedicalSpecilities('diving')){
            if (!data_get($this->medicalRecord->data,'diving.sinusEqaulization.location',false)) {
                data_set($this->state, 'diving.sinusEqaulization.location', []);
            }
        }
    }
}
