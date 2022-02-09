<?php

namespace App\Http\Livewire\MedicalRecord\Show;

use App\Models\User;
use App\Traits\Datatables\WithSort;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class Card extends Component
{
    use WithPagination, WithSort;

    public $perPage = 10;

    public User $user;

    public $modelName = null;

    public $specialtyId = null;

    public function mount()
    {
        $this->modelName = '\\App\\Models\\'.$this->modelName;
        $this->sortField = 'created_at';
        $this->sortAsc = false;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $query = $this->modelName::where('user_id', $this->user->id)
            ->when($this->specialtyId, function (Builder $query) {
                $query->where('medical_specialty_id', $this->specialtyId);
            });
        if ($this->sortField == 'tenant') {
            $orderDirection = $this->sortAsc ? 'asc' : 'desc';
            $query = $query->with(['center' => function ($query) use ($orderDirection) {
                $query->orderBy('name', $orderDirection);
            }]);
        } elseif ($this->sortField == 'doctor') {
            $orderDirection = $this->sortAsc ? 'asc' : 'desc';
            $query = $query->with(['doctor' => function ($query) use ($orderDirection) {
                $query->orderBy('lastname', $orderDirection);
            }]);
        } else {
            $query = $query->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc');
        }

        return view('livewire.medical-record.show.card', [
            'records' => $query->paginate($this->perPage),
        ]);
    }
}
