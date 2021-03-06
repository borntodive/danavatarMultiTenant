<?php

namespace App\Http\Livewire\MedicalRecord\Nutritionist;

use App\Traits\MedicalRecord\ViewMedicalRecord;
use Livewire\Component;

class View extends Component
{

    use ViewMedicalRecord;
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('livewire.medical-record.nutritionist.view');
    }
}
