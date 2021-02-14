<?php

namespace App\Http\Livewire\MedicalRecord;

use App\Models\MedicalRecord;
use App\Models\MedicalSpecialty;
use App\Models\User;
use Livewire\Component;

class Create extends Component
{

    public $state = [];
    public User $user;
    public MedicalSpecialty $specialty;

    protected $rules = [
        'state.height' => 'required|numeric',
        'state.weight' => 'required|numeric',
    ];

    public function createMedicalRecord()
    {
        $validatedData = $this->validate();
        $mr = new MedicalRecord();
        $mr->user_id = $this->user->id;
        $mr->medical_specialty_id=$this->specialty->id;
        $mr->data = $this->state;
        $mr->save();
        //session()->flash('success', 'Anamnesi salvata con successo');
        $this->emit('showFlashMessage', [
            'data'=>[
                'success'=>'Anamnesi salvata con successo',
            ]
        ]);
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        if(count($this->getErrorBag()->all()) > 0){
            $this->dispatchBrowserEvent('scrollToTop');

        }
        return view('livewire.medical-record.create');
    }
}
