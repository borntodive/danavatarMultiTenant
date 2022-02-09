<?php

namespace App\Http\Livewire\MedicalRecord\Nutritionist;

use App\StaticData\Nutritionist;
use App\Traits\MedicalRecord\EditMedicalRecord;
use Livewire\Component;

class Edit extends Component
{
    use EditMedicalRecord {
        mount as parentMount;
    }

    public $doSports;

    private $baseSport = [
        'name'=>null,
        'level'=>null,
        'time'=>null,
        'hrs'=>[],
    ];

    public $medications;

    public $medicalConditions;

    protected $rules = [
        'state.anamnesis.general.height' => 'required|numeric',
        'state.anamnesis.general.weight' => 'required|numeric',
    ];

    public function mount()
    {
        $this->parentMount();
        $this->medicalConditions = Nutritionist::$medicalConditions;
        $this->medications = Nutritionist::$medications;
        if (data_get($this->medicalRecord->data, 'anamnesis.general.sports', false)) {
            $this->doSports = true;
        } else {
            $this->doSports = false;
        }
    }

    public function updatedDoSports($value)
    {
        if ($this->doSports) {
            $this->state['anamnesis']['general']['sports'][] = $this->baseSport;
        } else {
            $this->state['anamnesis']['general']['sports'] = [];
        }
    }

    public function addSport()
    {
        $this->state['anamnesis']['general']['sports'][] = $this->baseSport;
    }

    public function deleteSport($idx)
    {
        unset($this->state['anamnesis']['general']['sports'][$idx]);
        $this->state['anamnesis']['general']['sports'] = array_values($this->state['general']['sports']);
    }
}
