<?php

namespace App\Http\Livewire\Admin\Centers;

use App\Models\Tenant;
use App\Traits\ValidationRules;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;
    use ValidationRules;

    public $photo;

    public Tenant $center;

    protected function rules()
    {
        return $this->getTenantRules($this->center);
    }

    public function deleteProfilePhoto()
    {
        $this->center->deleteProfilePhoto();
    }

    public function updated($propertyName)
    {
        $this->resetErrorBag($propertyName);
        $this->validateOnly($propertyName);
    }

    public function updateTenantInformation()
    {
        $this->resetErrorBag();
        $validatedData = $this->validate();
        $this->center->save();
        if ($this->photo) {
            $this->center->updateProfilePhoto($this->photo);
        }

        session()->flash('success', 'Profilo salvato con successo');

        return redirect()->route('admin.centers');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('livewire.admin.centers.update');
    }
}
