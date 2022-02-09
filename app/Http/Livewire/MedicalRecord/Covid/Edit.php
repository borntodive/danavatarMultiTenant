<?php

namespace App\Http\Livewire\MedicalRecord\Covid;

use App\StaticData\Covid;
use App\Traits\MedicalRecord\EditMedicalRecord;
use Livewire\Component;

class Edit extends Component
{
    use EditMedicalRecord {
        mount as parentMount;
    }

    public $exams;

    public $times;

    public $selectedTime = 'pre';

    protected $rules = [
        'state.anamnesis' => 'nullable',
    ];

    public function mount()
    {
        $this->parentMount();
        $this->exams = Covid::$exams;
        $this->times = Covid::$times;
    }
}
