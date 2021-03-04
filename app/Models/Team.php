<?php

namespace App\Models;

use Laratrust\Models\LaratrustTeam;

class Team extends LaratrustTeam
{
    public $guarded = [];

    public function scopeCurrentTeam($query)
    {
        if (session()->has('tenant'))
            return $query->where('name', session()->get('tenant')->slug);
        return $query;
    }
}
