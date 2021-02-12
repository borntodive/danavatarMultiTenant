<?php

namespace App\Http\Livewire\Invite;

use App\Actions\Fortify\PasswordValidationRules;
use App\Enums\UserGender;
use App\Models\Invite;
use App\Models\User;
use App\Scopes\TenantScope;
use BenSampo\Enum\Rules\EnumValue;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Accept extends Component
{
    use PasswordValidationRules;


    public $user;
    public $invite;
    public $ipAddress;

    public $showSuccessModal=false;

    public $firstname;
    public $lastname;
    public $email;
    public $dob;
    public $password;
    public $password_confirmation;
    public $codice_fiscale;
    public $acceptPrivacy=false;

    public function getRules() {
        if (!$this->user) {
            return [
                'firstname' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users,email',
                'dob'=>'required|date',
                'password'=> $this->passwordRules(),
                'codice_fiscale'=>'required|codice_fiscale|unique:users,codice_fiscale',
                'acceptPrivacy'=>'required|accepted',
            ];
        }
        return [
            'acceptPrivacy'=>'required|accepted',
        ];

    }
    public function getValidationAttributes() {
        if (!$this->user) {
            return [
                'firstname' => 'Nome',
                'lastname' => 'Cognome',
                'email' => 'Email',
                'dob'=>'Data di Nascita',
                'password'=> 'Password',
                'codice_fiscale'=>'Codice Fiscale',
                'acceptPrivacy'=>'La Privacy',
            ];
        }
        return [
            'acceptPrivacy'=>'La Privacy',
        ];

    }

    public function updated($propertyName)
    {
        if ($propertyName=='password_confirmation')
            $propertyName='password';
        $this->resetErrorBag($propertyName);
        $this->validateOnly($propertyName);
    }

    public function mount(Request $request) {
        if (!$request->token)
            abort(404);
        $this->invite=Invite::where('token',$request->token)
            ->whereDate('expires_at','>=',now())
            ->whereNull('accepted_at')
            ->firstOrFail();
        $this->user=User::withoutGlobalScope(TenantScope::class)->where('codice_fiscale',$this->invite->codice_fiscale)->first();
        $this->firstname=$this->invite->firstname;
        $this->lastname=$this->invite->lastname;
        $this->email=$this->invite->email;
        $this->codice_fiscale=$this->invite->codice_fiscale;
        $this->dob=Carbon::create($this->invite->dob);
        $this->ipAddress=$request->ip();
    }

    public function acceptInvite()
    {
        $validatedData = $this->validate();
        $this->showSuccessModal=true;
        if (!$this->user) {
            $this->user=User::create(
                [
                    'firstname' => $this->firstname,
                    'lastname' => $this->lastname,
                    'email' => $this->email,
                    'dob'=>$this->dob,
                    'password'=> Hash::make($this->password),
                    'codice_fiscale'=>$this->codice_fiscale,
                ]
            );
        }
        $this->user->centers()->attach($this->invite->tenant_id);
        $this->invite->accepted_ip=$this->ipAddress;
        $this->invite->accepted_at=now();
        $this->invite->save();
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('livewire.invite.accept')
            ->layout('layouts.base');;
    }

    public function getIp(){
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                }
            }
        }
    }
}
