<?php

namespace App\Http\Livewire\Layout;

use Livewire\Component;

class FlashMessage extends Component
{

    protected $listeners = ['showFlashMessage' => 'updateMesssages'];

    public $messages=[];

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('livewire.layout.flash-message');
    }

    public function updateMesssages($data) {
        $this->messages=$data['data'];
    }

}
