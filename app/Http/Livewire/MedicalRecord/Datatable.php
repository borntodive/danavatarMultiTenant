<?php

namespace App\Http\Livewire\MedicalRecord;

use App\Models\User;
use App\Traits\Datatables\WithSearch;
use App\Traits\Datatables\WithSort;
use App\Traits\WithSpecialtiesChoice;
use Livewire\Component;
use Livewire\WithPagination;

class Datatable extends Component
{
    use WithPagination, WithSearch, WithSort, WithSpecialtiesChoice;

    public $perPage = 10;


    public function mount() {
        $this->sortField = 'firstname';
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */

    public function render()
    {
        return view('livewire.medical-record.datatable',[
            'users' => User::search($this->search)
                ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                ->paginate($this->perPage),
        ]);
    }
}
