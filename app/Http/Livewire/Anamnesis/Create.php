<?php

namespace App\Http\Livewire\Anamnesis;

use App\Models\Anamnesis;
use App\Models\Tenant;
use Illuminate\View\View;
use Livewire\Component;

use \App\StaticData\Anamnesis as AnamnesisData;

class Create extends Component
{

    public $state = [];

    public $medicalConditions = [];

    public $medications = [];

    protected $rules = [
        'state.height' => 'required|numeric',
        'state.weight' => 'required|numeric',
        //'state.anamnesisData'=>'required',
        'state.medications.*'=>'string|min:3',
        'state.anamnesisData.other.moredata'=>'sometimes|required|string|min:3',
    ];

    protected $validationAttributes = [
        'state.height' => 'Altezza',
        'state.weight' => 'Peso',
        'state.anamnesisData.other.moredata'=>'Altro',
    ];


    public function mount()
    {
        $this->medicalConditions=AnamnesisData::medicalConditions();
        $this->medications=AnamnesisData::medications();
        $anamnesis = auth()->user()->anamnesis()->orderBy('created_at', 'desc')->first();
        //$anamnesis=null;

        if ($anamnesis)
            $this->state = $anamnesis->toArray()['data'];
        else {
            $this->state['prev_cardio']=false;
        }

        foreach ($this->medications as $field=>$name) {
            $this->validationAttributes['state.medications.'.$field]=$name;
        }
        //dd($this->validationAttributes);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render()
    {
        if(count($this->getErrorBag()->all()) > 0){
            $this->dispatchBrowserEvent('danavatar:scroll-to', [
                'query' => "#{$this->getErrorBag()->keys()[0]}",
            ]);

        }
        return view('livewire.anamnesis.create');
    }

    public function updated($propertyName)
    {
        $this->resetErrorBag($propertyName);
        $this->validateOnly($propertyName);
    }


    public function createAnamnesis()
    {
        $validatedData = $this->validate();
        $anamensis = new Anamnesis();
        $anamensis->user_id = auth()->user()->id;
        $anamensis->data = ($validatedData['state']);
        $anamensis->save();
        //session()->flash('success', 'Anamnesi salvata con successo');
        $this->emit('showFlashMessage', [
            'data'=>[
                'success'=>'Anamnesi salvata con successo',
            ]
        ]);
        $this->dispatchBrowserEvent('scrollToTop');
        //$this->redirect('#');
        //return redirect()->route('dashboard');

        //dd($validatedData,$anamensis->data);
        //dd($values['anamnesisData']);
        //$anamensis->data->anamnesisData=new UserAnamnesisData($values['anamnesisData']);

    }
}
