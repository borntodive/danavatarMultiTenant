<?php


namespace App\Traits\MedicalRecord;


use App\Models\MedicalRecord;
use App\Models\MedicalSpecialty;
use App\Models\User;

trait ViewMedicalRecord
{
    public User $user;
    public MedicalSpecialty $specialty;
    public MedicalRecord $medicalRecord;


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {

        return view('livewire.medical-record.'.$this->specialty->slug.'.view');
    }
}
