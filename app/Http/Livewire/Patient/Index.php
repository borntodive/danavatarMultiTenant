<?php

namespace App\Http\Livewire\Patient;

use App\Models\Invite;
use App\Models\User;
use App\Scopes\TenantScope;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Livewire\Component;
use robertogallea\LaravelCodiceFiscale\CityCodeDecoders\InternationalCitiesStaticList;
use robertogallea\LaravelCodiceFiscale\CodiceFiscale;

class Index extends Component
{

    public $searchedCF='';
    public $foundUser = null;
    public $newUserData;
    public $calcCF;
    public $searched=false;
    public $showCFCalculation=false;

    public $cities;
    public $foundCities=[];
    public $selectedCity=[];
    public $searchedCity;

    protected $rules = [
        'searchedCF'=>'required',
        ];

    protected $validationAttributes = [
        'searchedCF'=>'Codice Fiscale',
        'newUserData.firstname' => 'Nome',
        'newUserData.lastname' => 'Cognome',
        'newUserData.email' => 'Email',
        'newUserData.dob'=>'Data di Nascita',
        'newUserData.codice_fiscale'=>'Codice Fiscale',
        'calcCF.firstname' => 'Nome',
        'calcCF.lastname' => 'Cognome',
        'calcCF.gender' => 'Sesso',
        'calcCF.birth_place' => 'Comune di Nascita',
        'calcCF.dob'=>'Data di Nascita',
    ];

    public function mount() {
        $this->cities=InternationalCitiesStaticList::getList();
    }
    public function updated($propertyName)
    {
        $this->resetErrorBag($propertyName);
        $this->validateOnly($propertyName);
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */

    public function searchCF() {
        $validatedData = $this->validate();
        $this->foundUser=User::withoutGlobalScope(TenantScope::class)->notInCenter()->where('codice_fiscale',$this->searchedCF)->first();
        if (!$this->foundUser)
            $this->newUserData['codice_fiscale']=$this->searchedCF;
        $this->searched=true;
    }

    public function updatedSearchedCity($newValue)
    {
        $this->calcCF['birth_place']=null;
        $searchedCity=$this->searchedCity;
        if (strlen($searchedCity) < 2) {
            $this->foundCities = [];

            return;
        }

        $this->foundCities= Arr::where($this->cities, function ($value, $key) use ($searchedCity) {
            return Str::startsWith($value, Str::upper($searchedCity));
        });
    }

    public function selectCity($code) {
        $this->calcCF['birth_place']=$code;
        $this->searchedCity=Str::title($this->cities[$code]);
        $this->foundCities=[];
    }

    public function createCF() {
        $this->validate([
            'calcCF.firstname' => 'required|string|max:255',
            'calcCF.lastname' => 'required|string|max:255',
            'calcCF.gender' => 'required',
            'calcCF.birth_place' => 'required',
            'calcCF.dob'=>'required|date',
        ]);
        $cf_string = CodiceFiscale::generate($this->calcCF['firstname'],
            $this->calcCF['lastname'],
            $this->calcCF['dob'],
            $this->calcCF['birth_place'],
            $this->calcCF['gender'],
            new InternationalCitiesStaticList);
        $this->searchedCF=$cf_string;
        $this->showCFCalculation=false;

    }

    public function updatedSearchedCF($newValue)
    {
        $this->newUserData['codice_fiscale']=$this->searchedCF;
    }

    public function inviteUser() {
        $this->sendInvite($this->foundUser);
    }

    public function createUser() {
        $validatedData = $this->validate([
            'newUserData.firstname' => 'required|string|max:255',
            'newUserData.lastname' => 'required|string|max:255',
            'newUserData.email' => 'required|email|max:255|unique:users,email',
            'newUserData.dob'=>'required|date',
            'newUserData.codice_fiscale'=>'required|codice_fiscale|unique:users,codice_fiscale',
        ]);
        $this->sendInvite(collect($this->newUserData));
    }

    public function openCFCalculation(){
        $this->showCFCalculation=true;

    }
    private function sendInvite($user) {
        $invite = Invite::create(
            [
                "firstname"=>$user['firstname'],
                "lastname"=>$user['lastname'],
                "dob"=>$user['dob'],
                "email"=>$user['email'],
                "codice_fiscale"=>$user['codice_fiscale'],
            ]
        );
        $this->foundUser=null;
        $this->searched=false;
        $this->searchedCF=null;
        $this->emit('showFlashMessage', [
            'data'=>[
                'success'=>'Invito inviato con successo',
            ]
        ]);
        $this->dispatchBrowserEvent('scrollToTop');
    }

    public function render()
    {
        return view('livewire.patient.index');
    }
}
