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
    private $baseSport=[
        'name'=>null,
        'level'=>null,
        'time'=>null,
        'hrs'=>[],
    ];

    protected $rules = [
        'state.general.height' => 'required|numeric',
        'state.general.weight' => 'required|numeric',
    ];

    public function mount() {
        $this->state['general']['sports'][0]=$this->baseSport;
    }

    public function addSport() {
        $this->state['general']['sports'][]=$this->baseSport;
    }
    public function deleteSport($idx) {
        unset($this->state['general']['sports'][$idx]);
        $this->state['general']['sports']=array_values($this->state['general']['sports']);
    }
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
