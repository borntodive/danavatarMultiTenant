<?php

namespace App\Http\Livewire\Invite;

use Livewire\Component;

class Register extends Component
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('livewire.invite.register');
    }
}
