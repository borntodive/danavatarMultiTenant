<?php

namespace App\Http\Livewire\MedicalRecord\Osas;

use App\StaticData\Osas;
use App\Traits\MedicalRecord\ViewMedicalRecord;
use Livewire\Component;

class View extends Component
{
    use ViewMedicalRecord;

    public $radios;

    public $checkboxs;

    public $numbers;

    public $sums;

    public $examsRadios;

    public $examsCheckboxs;

    public $instrumentCheckboxs;

    public $sum;

    public function mount()
    {
        $this->radios = Osas::$anamnesis;
        $this->checkboxs = Osas::$checkboxs;
        $this->numbers = Osas::$numbers;
        $this->sums = Osas::$sums;
        $this->examsRadios = Osas::$radios;
        $this->examsCheckboxs = Osas::$examsCheckboxs;
        $this->instrumentCheckboxs = Osas::$instrumentCheckboxs;

        $this->updateSum();
    }

    public function updateSum()
    {
        $all = data_get($this->medicalRecord->data, 'exams.objectives.general.epworthper', []);
        $this->sum = 0;
        foreach ($all as $a) {
            $this->sum += $a;
        }
    }
}
