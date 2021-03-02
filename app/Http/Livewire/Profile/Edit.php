<?php

namespace App\Http\Livewire\Profile;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public $photo;
    public $state;
    public $user;
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */

    public function mount() {
        $this->state=Auth::user()->withoutRelations()->toArray();
        $this->user=Auth::user();
        $this->state['dob']=$this->user['dob']->format('d-m-Y');
    }


    public function updateProfileInformation(UpdatesUserProfileInformation $updater)
    {
        $this->resetErrorBag();

        $updater->update(
            Auth::user(),
            $this->photo
                ? array_merge($this->state, ['photo' => $this->photo])
                : $this->state
        );
        session()->flash('success', 'Profilo salvato con successo');

        return redirect()->route('dashboard');
    }

    public function deleteProfilePhoto()
    {
        Auth::user()->deleteProfilePhoto();
    }

    public function render()
    {
        if(count($this->getErrorBag()->all()) > 0){
            $this->dispatchBrowserEvent('scrollToTop');

        }
        return view('livewire.profile.edit');
    }
}
