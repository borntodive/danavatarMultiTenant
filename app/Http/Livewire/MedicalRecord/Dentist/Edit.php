<?php

namespace App\Http\Livewire\MedicalRecord\Dentist;

use App\StaticData\Dentist;
use App\StaticData\Nutritionist;
use App\Traits\MedicalRecord\EditMedicalRecord;
use Illuminate\Support\Arr;
use Livewire\Component;

class Edit extends Component
{
    use EditMedicalRecord {
        mount as parentMount;
    }

    public $equalizationLevel;
    public $equalizationTecnique;

    protected $rules = [
        'state.anamnesis' => 'nullable',
    ];

    public function mount() {

        $this->parentMount();
        $this->equalizationLevel=Dentist::$equalizationLevel;
        $this->equalizationTecnique=Dentist::$equalizationTecnique;
        if (! Arr::has($this->state, 'exams.instrumental.orthopantomography'))
            data_set($this->state, 'exams.instrumental.orthopantomography', false);
        if (! Arr::has($this->state, 'exams.instrumental.rx'))
            data_set($this->state, 'exams.instrumental.rx', false);

    }

}
