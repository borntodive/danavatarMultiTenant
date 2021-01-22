<?php

namespace App\Http\Livewire\Anamnesis\Create;

use Livewire\Component;

class General extends Component
{

    public $state = [];

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('livewire.anamnesis.create.general');
    }
}
