<?php

namespace App\Models;

use App\Scopes\OnlyForDoctorScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Jetstream\HasProfilePhoto;

class Tenant extends Model
{
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function hasMedicalSpecilities($spec)
    {

        return ($this->medicalSpecilities()->withoutGlobalScope(OnlyForDoctorScope::class)->get()->pluck('slug')->search($spec) !== false);
        //return $this->belongsToMany(MedicalSpecialty::class)->withTimestamps();
    }

    /**
     * The users that belong to the club.
     */
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    /**
     * The users that belong to the club.
     */
    public function medicalSpecilities()
    {
        return $this->belongsToMany(MedicalSpecialty::class)->withTimestamps();
    }
}