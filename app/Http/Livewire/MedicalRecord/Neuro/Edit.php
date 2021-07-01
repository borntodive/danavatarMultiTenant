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
    public $nervi;
    public $all;

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
        $this->nervi=Neuro::nervi();
        $this->all=[
            $this->disorders,
            $this->mobilita,
            $this->tono,
            $this->sensibilita,
            $this->riflessi,
            $this->coordinazione,
            $this->antigravitarie,
            $this->deambulazione,
            $this->nervi,
        ];
    }

    public function radioCheck($target,$option,$radio) {
        if (!$radio)
            return;
        $found=false;
        foreach ($this->all as $fields){
            foreach ($fields as $f) {
                if (isset($f['target'])) {
                    if ($f['target'] == $target) {
                        $val=data_get($this->state, $target.'.'  . $option . '.present', false);
                        if ($radio==999) {
                            foreach ($f['options'] as $idx => $o) {
                                if (strtolower($o) != $option) {
                                    if ($val) {
                                        data_set($this->state, $target . '.' . strtolower($o) . '.present', false);
                                        $found=true;
                                    }
                                }
                            }
                        }
                        else {
                            $radioIdx=intval($radio) - 1;
                            foreach ($f['options'] as $idx => $o) {
                                if ($val) {
                                    if (strtolower($o) == $option && $radioIdx == $idx) {
                                        foreach ($f['options'] as $idx => $op) {
                                            if (strtolower($op) != $option) {
                                                data_set($this->state, $target . '.' . strtolower($op) . '.present', false);
                                                $found=true;
                                            }
                                        }
                                        break;
                                    } else if (strtolower($o) == $option) {
                                        data_set($this->state, $target . '.' . strtolower($f['options'][$radioIdx]) . '.present', false);
                                        break;
                                        $found=true;
                                    }
                                }
                            }
                        }
                    }
                }
                if ($found)
                    break;
            }
            if ($found)
                break;
        }
    }

}
