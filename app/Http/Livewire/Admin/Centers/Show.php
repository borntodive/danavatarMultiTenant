<?php

namespace App\Http\Livewire\Admin\Centers;

use App\Models\Tenant;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class Show extends Component
{
    public Tenant $center;

    public $selectedSpeciality = [];

    public $showCreateUserModal = false;

    public function mount()
    {
        $this->selectedSpeciality = $this->center->allMedicalSpecilities()->get()->pluck('id');
    }

    public function toggleCenterSpecialty($id)
    {
        $idx = $this->selectedSpeciality->search($id);
        if ($idx === false) {
            $this->selectedSpeciality->push($id);
        } else {
            $this->selectedSpeciality->pull($idx);
        }
        $this->center->allMedicalSpecilities()->sync($this->selectedSpeciality);
    }

    public function viewCreateUserModal()
    {
        dd($this->showCreateUserModal);
        $this->showCreateUserModal = true;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('livewire.admin.centers.show');
    }
}
