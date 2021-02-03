<?php

namespace App\Http\Livewire\MedicalRecord;

use App\Models\MedicalSpecialty;
use App\Models\User;
use Livewire\Component;

class Create extends Component
{

    public User $user;
    public MedicalSpecialty $specialty;
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('livewire.medical-record.create');
    }
}
