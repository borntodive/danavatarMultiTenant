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

    public $divingState = [];

    public $medicalConditions = [];

    public $medications = [];

    protected $rules = [
        'state.height' => 'required|numeric',
        'state.weight' => 'required|numeric',
        //'state.anamnesisData'=>'required',
        'state.medications.*'=>'string|min:3',
        'divingState.*' => 'sometimes',
        'state.anamnesisData.other.moredata'=>'sometimes|required|string|min:3',
    ];

    //protected $validationAttributes = [];


    public function getValidationAttributes()
    {
        $rules=[
            'state.height' => 'Altezza',
            'state.weight' => 'Peso',
            'state.anamnesisData.other.moredata'=>'Altro',
        ];
        foreach ($this->medications as $field=>$name) {
            $rules['state.medications.'.$field]=$name;
        }
        return $rules;
    }

    public function mount()
    {
        $this->medicalConditions=AnamnesisData::medicalConditions();
        $this->medications=AnamnesisData::medications();
        //$anamnesis = auth()->user()->anamnesis()->orderBy('created_at', 'desc')->first();
        //$anamnesis=null;

        $this->state['prev_cardio']=false;
        $this->divingState['scuba']['recreative']=false;
        $this->divingState['scuba']['tecnical']=false;
        $this->divingState['apnea']['freedive']=false;
        $this->divingState['apnea']['phishing']=false;
        $this->divingState['swimming']['amateur']=false;
        $this->divingState['swimming']['agonistic']=false;
        $this->divingState['anamnesis']['scuba']['barotrauma']=false;
        $this->divingState['anamnesis']['scuba']['narcosi']=false;
        $this->divingState['anamnesis']['scuba']['dcs']=false;
        $this->divingState['anamnesis']['apnea']['taravana']=false;
        $this->divingState['anamnesis']['apnea']['edema']=false;
        $this->divingState['anamnesis']['apnea']['sincope']=false;
        $this->divingState['anamnesis']['apnea']['samba']=false;


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
            $this->dispatchBrowserEvent('scrollToTop');

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
        $data['general']=$this->state;
        $data['diving']=$this->divingState;
        $anamensis->data = $data;
        $anamensis->save();

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
