<?php

namespace App\Http\Livewire\MedicalRecord\Nutritionist;

use App\StaticData\Nutritionist;
use App\Traits\MedicalRecord\ViewMedicalRecord;
use Livewire\Component;

class View extends Component
{

    use ViewMedicalRecord;

    public $medications;
    public $medicalConditions;
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string

     */

    public function mount() {
        $this->medicalConditions=Nutritionist::$medicalConditions;
        $this->medications=Nutritionist::$medications;
    }
    public function render()
    {
        return view('livewire.medical-record.nutritionist.view');
    }
}
