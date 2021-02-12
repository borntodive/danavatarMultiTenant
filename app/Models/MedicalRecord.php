<?php

namespace App\Models;

use App\Traits\BelongsToMedicalCenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    use HasFactory, BelongsToMedicalCenter;

    protected $guarded =[];

    /**
     * The user that belong to the anamnesis.
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The specialties that belong to the user.
     */
    public function specialty(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(MedicalSpecialty::class,'medical_specialty_id');
    }

}