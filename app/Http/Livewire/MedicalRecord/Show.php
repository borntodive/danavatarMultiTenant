<?php

namespace App\Http\Livewire\MedicalRecord;

use App\Models\MedicalSpecialty;
use App\Traits\WithSpecialtiesChoice;
use Livewire\Component;
use App\Models\User;

class Show extends Component
{
    use WithSpecialtiesChoice;

    public User $user;
    public MedicalSpecialty $specialty;
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('livewire.medical-record.show');
    }
}
