<?php

namespace App\Http\Livewire\Admin\Centers;

use App\Models\Tenant;
use App\Models\User;
use App\Traits\Datatables\WithSearch;
use App\Traits\Datatables\WithSort;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, WithSearch, WithSort;

    public $perPage = 12;


    public function mount() {
        $this->sortField = 'name';
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('livewire.admin.centers.index',[
        'centers' => Tenant::search($this->search)
        ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
        ->paginate($this->perPage)
        ]);
    }
}
