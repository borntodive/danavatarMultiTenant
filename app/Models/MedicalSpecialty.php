<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalSpecialty extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The users that belong to the club.
     */
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

}
