<?php

namespace App\Http\Livewire\Patient;

use App\Models\Invite;
use App\Models\User;
use App\Scopes\TenantScope;
use Livewire\Component;

class Index extends Component
{

    public $searchedCF='MUVRZU74I67I601Z';
    public $foundUser = null;
    public $newUserData;
    public $searched=false;

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
    ];


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
        $this->searched=true;
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
