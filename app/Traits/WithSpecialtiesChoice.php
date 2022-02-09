<?php

namespace App\Traits;

use App\Models\User;

trait WithSpecialtiesChoice
{
    public $isSpecialitiesModalVisible = false;

    public $selectedUser = null;

    public function updatedIsSpecialitiesModalVisible()
    {
        if (! $this->isSpecialitiesModalVisible) {
            $this->selectedUser = null;
        }
    }

    public function showEdit(User $user)
    {
        $this->selectedUser = $user;
        if (auth()->user()->specialties()->count() > 1) {
            $this->isSpecialitiesModalVisible = true;
        } elseif (auth()->user()->specialties()->count() == 1) {
            $this->redirectToMedicalRecordCreation(auth()->user()->specialties()->first());
        }
    }

    public function redirectToMedicalRecordCreation($specialty)
    {
        $user = $this->selectedUser;

        return redirect()->route('medical_record.create', compact('user', 'specialty'));
    }
}
