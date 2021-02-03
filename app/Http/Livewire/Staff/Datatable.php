<?php

namespace App\Http\Livewire\Staff;

use App\Models\MedicalSpecialty;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Team;
use App\Models\User;
use App\Traits\Datatables\WithSearch;
use App\Traits\Datatables\WithSort;
use Illuminate\Database\Query\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class Datatable extends Component
{
    use WithPagination, WithSort, WithSearch;

    public $perPage = 10;

    public $roleFilter=null;
    public $roles =  null;
    public $isSideVisible = false;
    public $userToBeUpdated=null;
    public $selectedSpeciality = [];

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */

    public function mount() {
        $this->sortField = 'firstname';
        $this->roles=Role::withoutSuperAdmin()->get();

    }

    public function filterRole($roleId) {
        $this->roleFilter=$roleId;
    }

    public function clearRole() {
        $this->roleFilter=null;
    }

    public function updateRole($userId, $roleId) {
        $team=Team::currentTeam()->firstOrFail();
        $user=User::findOrFail($userId);
        $role=Role::findOrFail(intval($roleId));
        $user->syncRoles([intval($roleId)], $team);
        $this->emit('showFlashMessage', [
            'data'=>[
                'success'=>'Ruolo aggiornato con successo',
            ]
        ]);
        if ($role->name=='user') {
            $user->specialties()->detach();
        } elseif ($role->name=='admin') {
            $user->specialties()->detach();
            $user->specialties()->attach(MedicalSpecialty::get());
        }
        $this->dispatchBrowserEvent('scrollToTop');
    }

    public function showSideEdit(User $user) {
        $this->isSideVisible=true;
        $this->userToBeUpdated = $user;
        $this->selectedSpeciality = $user->specialties()->get()->pluck('id');
    }
    public function updatedIsSideVisible() {
        if (!$this->isSideVisible) {
            $this->userToBeUpdated = null;
            $this->selectedSpeciality=[];
        }
    }

    public function toggleSpecialty($id) {
        $idx=$this->selectedSpeciality->search($id);
        if ($idx === false) {
            $this->selectedSpeciality->push($id);
        }
        else {
            $this->selectedSpeciality->pull($idx);
        }
        $this->userToBeUpdated->specialties()->sync($this->selectedSpeciality);

    }
    public function render()
    {
        return view('livewire.staff.datatable',[
        'users' => User::search($this->search)
        ->when($this->roleFilter, function ($query) {
            $query->whereHas('roles', function ($query) {
                $query->where('id', $this->roleFilter);
            });
        })
        ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
        ->paginate($this->perPage),
        ]);
    }
}
