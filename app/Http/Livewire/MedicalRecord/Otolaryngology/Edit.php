<?php

namespace App\Http\Livewire\MedicalRecord\Otolaryngology;

use App\StaticData\Otolaryngology;
use App\Traits\MedicalRecord\EditMedicalRecord;
use Livewire\Component;

class Edit extends Component
{
    use EditMedicalRecord {
        mount as parentMount;
    }

    protected $rules = [
        'state.anamnesis' => 'nullable',
    ];

    public $externalEarObjective;

    public $tympanicMembraneObjective;

    public $tympanicMembraneMobilityObjective;

    public function mount()
    {
        $this->parentMount();
        $this->externalEarObjective = Otolaryngology::$externalEarObjective;
        $this->tympanicMembraneObjective = Otolaryngology::$tympanicMembraneObjective;
        $this->tympanicMembraneMobilityObjective = Otolaryngology::$tympanicMembraneMobilityObjective;
        if (! data_get($this->medicalRecord->data, 'anamnesis.general.sinus', false)) {
            data_set($this->state, 'anamnesis.general.sinus', []);
        }
        if (! data_get($this->medicalRecord->data, 'anamnesis.general.faringe', false)) {
            data_set($this->state, 'anamnesis.general.faringe', []);
        }
        if (! data_get($this->medicalRecord->data, 'anamnesis.general.cavoOrale', false)) {
            data_set($this->state, 'anamnesis.general.cavoOrale', []);
        }
        if (! data_get($this->medicalRecord->data, 'objectives.general.externalEar.dx', false)) {
            data_set($this->state, 'objectives.general.externalEar.dx', []);
        }
        if (! data_get($this->medicalRecord->data, 'objectives.general.externalEar.sx', false)) {
            data_set($this->state, 'objectives.general.externalEar.sx', []);
        }
        if (! data_get($this->medicalRecord->data, 'objectives.general.nose.anomalies', false)) {
            data_set($this->state, 'objectives.general.nose.anomalies', []);
        }

        if (session()->get('tenant')->hasMedicalSpecilities('diving')) {
            if (! data_get($this->medicalRecord->data, 'diving.sinusEqaulization.location', false)) {
                data_set($this->state, 'diving.sinusEqaulization.location', []);
            }
        }
        if (! data_get($this->medicalRecord->data, 'instrumental.general.tac.rocche', false)) {
            data_set($this->state, 'instrumental.general.tac.rocche', false);
        }
        if (! data_get($this->medicalRecord->data, 'instrumental.general.tac.seni', false)) {
            data_set($this->state, 'instrumental.general.tac.seni', false);
        }
        if (! data_get($this->medicalRecord->data, 'instrumental.general.allergie.exam', false)) {
            data_set($this->state, 'instrumental.general.allergie.exam', false);
        }
        if (! data_get($this->medicalRecord->data, 'instrumental.general.allergie.positive_at', false)) {
            data_set($this->state, 'instrumental.general.allergie.positive_at', []);
        }
        if (! data_get($this->medicalRecord->data, 'instrumental.general.audiometrico.sx.neurosensoriale', false)) {
            data_set($this->state, 'instrumental.general.audiometrico.sx.neurosensoriale', []);
        }
        if (! data_get($this->medicalRecord->data, 'instrumental.general.audiometrico.dx.neurosensoriale', false)) {
            data_set($this->state, 'instrumental.general.audiometrico.dx.neurosensoriale', []);
        }
    }
}
