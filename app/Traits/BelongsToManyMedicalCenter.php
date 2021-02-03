<?php


namespace App\Traits;


use App\Models\Tenant;
use App\Scopes\TenantScope;

trait BelongsToManyMedicalCenter
{
    protected static function bootBelongsToManyMedicalCenter()
    {
        static::addGlobalScope(new TenantScope);

        static::creating(function($model) {
            if(session()->has('tenant')) {
                $model->tenant_id = session()->get('tenant')->id;
            }
        });
    }

    public function centers()
    {
        return $this->belongsToMany(Tenant::class);
    }
}
