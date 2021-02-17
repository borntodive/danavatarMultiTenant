<?php

namespace App\Http\Livewire\Weareble;

use App\Models\User;
use Livewire\Component;

class Samples extends Component
{

    public User $user;
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('livewire.weareble.samples');
    }
}
