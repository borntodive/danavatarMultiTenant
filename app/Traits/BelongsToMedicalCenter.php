<?php


namespace App\Traits;


use App\Scopes\TenantScope;

trait BelongsToMedicalCenter
{
    protected static function bootBelongsToMedicalCenter()
    {
        static::creating(function($model) {
            if(session()->has('tenant')) {
                $model->tenant_id = session()->get('tenant')->id;
            }
        });
    }

    public function centers()
    {
        return $this->belongsTo(Tenant::class);
    }
}
