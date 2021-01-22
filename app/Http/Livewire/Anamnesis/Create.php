<?php

namespace App\Http\Livewire\Anamnesis;

use App\Dto\Anamnesis\Medications;
use App\Dto\Anamnesis\UserAnamnesis;
use App\Dto\Anamnesis\UserAnamnesisData;
use App\Models\Anamnesis;
use Illuminate\View\View;
use Livewire\Component;

class Create extends Component
{

    public $state = [];

    public $medicalConditions = [
        'nothingSignificant' => 'Niente di significante',
        'allergy' => 'Allergia',
        'asthma' => 'Asma',
        'backPain' => 'Dolore alla schiena',
        'backSurgery' => 'Chirurgia alla schiena',
        'smoker' => 'Fumatore',
        'diabetes' => 'Diabete',
        'ears' => 'Orecchi/problemi ai seni frontali',
        'earsSurgery' => 'Chirurgia orecchi/seni frontali',
        'flue' => 'Influenza/raffreddore',
        'heartProblems' => 'Problema cuore/pressione',
        'joinsPains' => 'Dolori giunture/muscoli',
        'nsd' => 'Disordine sistema nervoso',
        'peripheralVascular' => 'Malattia vascolare periferica',
        'pregnancy' => 'Gravidanza',
        'dcs' => 'Episodi precedenti di PDD',
        'pulmonaryProblems' => 'Problemi polmonari',
        'seaSickness' => 'Mal di mare frequenti',
        'hyperfolesterolemia' => 'Iperfolesterolemia',
        'familyDiseases' => 'Storia familiare di diabete o cardiopatie (congiunti I° grado)',
        'other' => 'Altro',
    ];

    protected $rules = [
        'state.height' => 'required|numeric',
        'state.weight' => 'required|numeric',
    ];


    public function mount()
    {
        $anamnesis = auth()->user()->anamnesis()->orderBy('created_at', 'desc')->first();
        //$anamnesis=null;
        if (!$anamnesis) {
            $anamnesis = new Anamnesis();
            $anamnesis->data = new UserAnamnesis([
                'anamnesisData' => new UserAnamnesisData(),
                'medications' => new Medications(),
            ]);
        }
        $this->state = $anamnesis->toArray()['data'];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render()
    {
        return view('livewire.anamnesis.create');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function createAnamnesis()
    {
        $validatedData = $this->validate();

        $anamensis = new Anamnesis();
        $anamensis->user_id = auth()->user()->id;
        $anamensis->data = ($validatedData);

        //dd($values['anamnesisData']);
        //$anamensis->data->anamnesisData=new UserAnamnesisData($values['anamnesisData']);
        $anamensis->saveOrFail();
    }
}
