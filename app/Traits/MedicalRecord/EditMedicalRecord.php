<?php


namespace App\Traits\MedicalRecord;


use App\Models\MedicalRecord;
use App\Models\MedicalSpecialty;
use App\Models\User;

trait EditMedicalRecord
{
    public $state = [];
    public User $user;
    public MedicalSpecialty $specialty;
    public MedicalRecord $medicalRecord;

    public function mount()
    {
        if ($this->medicalRecord)
            $this->state = $this->medicalRecord->data;
        parent::mount();
    }

    public function createMedicalRecord()
    {
        $validatedData = $this->validate();
        $this->medicalRecord->user_id = $this->user->id;
        $this->medicalRecord->doctor_id = auth()->user()->id;
        $this->medicalRecord->medical_specialty_id=$this->specialty->id;
        $this->medicalRecord->data = $this->state;
        $this->medicalRecord->save();
        session()->flash('success', 'Cartella clinica salvata con successo');
        return redirect(route('medical-record.view',['user'=>$this->user->id,'medicalRecord'=>$this->medicalRecord->id]));
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
        return view('livewire.medical-record.'.$this->specialty->slug.'.edit');
    }
}
