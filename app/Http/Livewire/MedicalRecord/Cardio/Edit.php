<?php

namespace App\Http\Livewire\MedicalRecord\Cardio;

use App\StaticData\Cardio;
use App\Traits\MedicalRecord\EditMedicalRecord;
use Livewire\Component;

class Edit extends Component
{
    use EditMedicalRecord {
        mount as parentMount;
    }

    public $terapie;

    public $patologie;

    public $ecg;

    protected $rules = [
        'state.anamnesis' => 'nullable',
    ];

    public function mount()
    {
        $this->parentMount();
        $this->terapie = Cardio::$terapie;
        $this->patologie = Cardio::$patologie;
        $this->ecg = Cardio::$ecg;
    }
}
