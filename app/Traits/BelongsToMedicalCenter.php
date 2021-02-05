<?php


namespace App\Traits;


use App\Models\Tenant;

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

    public function center(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Tenant::class,'tenant_id');
    }
}
