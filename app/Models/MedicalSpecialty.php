<?php

namespace App\Models;

use App\Scopes\OnlyForDoctorScope;
use App\Scopes\TenantScope;
use App\Traits\BelongsToManyMedicalCenter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalSpecialty extends Model
{
    use hasFactory, belongsToManyMedicalCenter;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function avatar()
    {
        return "https://ui-avatars.com/api/?name=$this->name&color=7F9CF5&background=EBF4FF";
    }

    /**
     * The users that belong to the club.
     */
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new TenantScope);
        static::addGlobalScope(new OnlyForDoctorScope);
        static::addGlobalScope('orderByName', function (Builder $builder) {
            $builder->orderBy('name');
        });
    }
}
