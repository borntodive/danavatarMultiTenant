<?php

namespace App\Http\Livewire\MedicalRecord\Osas;

use App\StaticData\Osas;
use App\Traits\MedicalRecord\EditMedicalRecord;
use Illuminate\Support\Arr;
use Livewire\Component;

class Edit extends Component
{
    use EditMedicalRecord {
        mount as parentMount;
    }

    public $radios;

    public $checkboxs;

    public $numbers;

    public $sums;

    public $examsRadios;

    public $examsCheckboxs;

    public $instrumentCheckboxs;

    public $sum;

    protected $rules = [
        'state.anamnesis' => 'nullable',
    ];

    public function mount()
    {
        $this->parentMount();
        $this->radios = Osas::$anamnesis;
        $this->checkboxs = Osas::$checkboxs;
        $this->numbers = Osas::$numbers;
        $this->sums = Osas::$sums;
        $this->examsRadios = Osas::$radios;
        $this->examsCheckboxs = Osas::$examsCheckboxs;
        $this->instrumentCheckboxs = Osas::$instrumentCheckboxs;
        $this->sum = 0;
    }

    public function updateSum()
    {
        $all = data_get($this->state, 'exams.objectives.general.epworthper', []);
        $this->sum = 0;
        foreach ($all as $a) {
            $this->sum += $a;
        }
    }
}
