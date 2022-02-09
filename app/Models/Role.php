<?php

namespace App\Models;

use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    public $guarded = [];

    private $dsgOnlyRoles = ['technician', 'operator'];

    private $commonRoles = ['user', 'admin', 'super_admin'];

    public function scopeWithoutSuperAdmin($query)
    {
        return $query->where('name', '!=', 'super_admin');
    }

    public function scopeDsg($query)
    {
        return $query->whereIn('name', array_merge($this->dsgOnlyRoles, $this->commonRoles));
    }

    public function scopeAvatar($query)
    {
        return $query->whereNotIn('name', $this->dsgOnlyRoles);
    }
}
