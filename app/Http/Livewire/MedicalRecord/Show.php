<?php

namespace App\Http\Livewire\MedicalRecord;

use App\Models\MedicalSpecialty;
use App\Models\User;
use App\Traits\WithSpecialtiesChoice;
use Livewire\Component;

class Show extends Component
{
    use WithSpecialtiesChoice;

    public User $user;

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
