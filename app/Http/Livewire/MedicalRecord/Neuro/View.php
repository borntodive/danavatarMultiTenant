<?php

namespace App\Http\Livewire\MedicalRecord\Neuro;

use App\StaticData\Neuro;
use App\Traits\MedicalRecord\ViewMedicalRecord;
use Livewire\Component;

class View extends Component
{

    use ViewMedicalRecord;
    public $disorders;
    public $mobilita;
    public $tono;
    public $sensibilita;
    public $riflessi;
    public $coordinazione;
    public $antigravitarie;
    public $deambulazione;

    public function mount() {
        $this->disorders=Neuro::$disorders;
        $this->mobilita=Neuro::$mobilita;
        $this->tono=Neuro::$tono;
        $this->sensibilita=Neuro::$sensibilita;
        $this->riflessi=Neuro::$riflessi;
        $this->coordinazione=Neuro::$coordinazione;
        $this->antigravitarie=Neuro::$antigravitarie;
        $this->deambulazione=Neuro::$deambulazione;
    }

}
