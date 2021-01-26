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

    public $medications = [
        'antiAllergenic'=>'Anti Allergenici',
        'antiDepressants'=>'Anti Depressivi',
        'antiAsthmatics'=>'Anti Asmatici',
        'bloodPressure'=>'Pressione',
        'antiDiarrheal'=>'Anti Diarroici',
        'heart'=>'Cuore / Circolazione',
        'oralDiabetics'=>'Diabetici Orali',
        'antibiotics'=>'Antibiotici',
        'antiEpileptics'=>'Anti Epilettici',
        'contraceptives'=>'Contraccettivi',
        'decongestants'=>'Decongestionanti',
        'antiFlue'=>'Anti Influenzali',
        'insulin'=>'Insulina',
        'painKillers'=>'Anti Dolorifici',
    ];

    protected $rules = [
        'state.height' => 'required|numeric',
        'state.weight' => 'required|numeric',
        'state.anamnesisData'=>'required',
        'state.prev_cardio' => 'required',
    ];

    protected $validationAttributes = [
        'state.height' => 'Altezza',
        'state.weight' => 'Peso',
    ];


    public function mount()
    {
        $anamnesis = auth()->user()->anamnesis()->orderBy('created_at', 'desc')->first();
        //$anamnesis=null;

        if ($anamnesis)
            $this->state = $anamnesis->toArray()['data'];
        else {
            $this->state['prev_cardio']=false;
        }
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
        $anamensis->data = ($validatedData['state']);
        $anamensis->save();
        session()->flash('success', 'Anamnesi salvata con successo');
        return redirect()->route('dashboard');

        //dd($validatedData,$anamensis->data);
        //dd($values['anamnesisData']);
        //$anamensis->data->anamnesisData=new UserAnamnesisData($values['anamnesisData']);

    }
}
