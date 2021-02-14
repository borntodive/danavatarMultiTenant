<?php

namespace App\Models;

use App\Scopes\TenantScope;
use App\Enums\UserGender;
use App\Traits\BelongsToManyMedicalCenter;
use BenSampo\Enum\Traits\CastsEnums;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use CastsEnums;
    use LaratrustUserTrait;
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use BelongsToManyMedicalCenter;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'gender'=> UserGender::Class,
        'dob'=>'date',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
        'name',
    ];

    /**
     * Get the user's name.
     *
     * @return string
     */
    public function getNameAttribute()
    {
        return "{$this->firstname} {$this->lastname}";
    }


    /**
     * The specialties that belong to the user.
     */
    public function specialties()
    {
        return $this->belongsToMany(MedicalSpecialty::class)->withTimestamps();
    }

    /**
     * The anamnesis that belong to the user.
     */
    public function anamnesis()
    {
        return $this->hasMany(Anamnesis::class);
    }

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('firstname', 'like', '%'.$query.'%')
                ->orWhere('lastname', 'like', '%'.$query.'%')
                ->orWhere('email', 'like', '%'.$query.'%')
                ->orWhere('codice_fiscale', 'like', '%'.$query.'%');
    }


    public function scopeNotInCenter($query)
    {
        if (session()->has('tenant')) {
            $query->whereDoesntHave('centers', function ($center) {
                $center->where('tenant_id', session()->get('tenant')->id);
            });
        }
    }

    public function isInCurrentCenter(){
        if (session()->has('tenant')) {

            return $this->centers->contains(session()->get('tenant')->id);
        }
        return false;
    }

    protected function profilePhotoDisk()
    {
        return 's3-public';
    }

}
