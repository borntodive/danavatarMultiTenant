<?php

namespace App\Http\Livewire\MedicalRecord\Neuro;

use App\StaticData\Neuro;
use App\Traits\MedicalRecord\EditMedicalRecord;
use Illuminate\Support\Arr;
use Livewire\Component;

class Edit extends Component
{
    use EditMedicalRecord {
        mount as parentMount;
    }

    public $disorders;
    public $mobilita;
    public $tono;
    public $sensibilita;
    public $riflessi;
    public $coordinazione;
    public $antigravitarie;
    public $deambulazione;

    protected $rules = [
        'state.anamnesis' => 'nullable',
    ];

    public function mount() {

        $this->parentMount();
        $this->disorders=Neuro::$disorders;
        $this->mobilita=Neuro::$mobilita;
        $this->tono=Neuro::$tono;
        $this->sensibilita=Neuro::$sensibilita;
        $this->riflessi=Neuro::$riflessi;
        $this->coordinazione=Neuro::$coordinazione;
        $this->antigravitarie=Neuro::$antigravitarie;
        $this->deambulazione=Neuro::$deambulazione;
        if (! Arr::has($this->state, 'exams.instrumental.orthopantomography'))
            data_set($this->state, 'exams.instrumental.orthopantomography', false);
        if (! Arr::has($this->state, 'exams.instrumental.rx'))
            data_set($this->state, 'exams.instrumental.rx', false);

    }

}
