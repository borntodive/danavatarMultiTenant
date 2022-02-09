<?php

namespace App\Traits;

use App\Models\Tenant;
use App\Scopes\TenantScope;

trait BelongsToManyMedicalCenter
{
    protected static function bootBelongsToManyMedicalCenter()
    {
        static::addGlobalScope(new TenantScope);
    }

    public function centers()
    {
        return $this->belongsToMany(Tenant::class);
    }
}
