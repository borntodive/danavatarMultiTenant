<?php

namespace App\Http\Livewire\MedicalRecord\Osas;

use App\StaticData\Osas;
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
        $this->disorders=Osas::$disorders;
        $this->mobilita=Osas::$mobilita;
        $this->tono=Osas::$tono;
        $this->sensibilita=Osas::$sensibilita;
        $this->riflessi=Osas::$riflessi;
        $this->coordinazione=Osas::$coordinazione;
        $this->antigravitarie=Osas::$antigravitarie;
        $this->deambulazione=Osas::$deambulazione;
    }

}
