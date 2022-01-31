<?php

namespace App\Models;

use App\Notifications\ResetPasswordNotification;
use App\Scopes\TenantScope;
use App\Enums\UserGender;
use App\Traits\BelongsToManyMedicalCenter;
use BenSampo\Enum\Traits\CastsEnums;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Lab404\Impersonate\Models\Impersonate;
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
    use Impersonate;

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
        'permissions'=>'array'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
        'name',
        'avatarUrl',
        'permissions'
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
     * Get the user's name.
     *
     * @return string
     */
    /* public function getPermissionsAttribute()
    {
        $permissions=[];
        foreach (Permission::get() as $permission) {
            if ($this->isAbleTo($permission->name, 'dsg'));
        }
        return $permissions;
    } */

    public function getAvatarUrlAttribute()
    {
        return $this->profile_photo_url;
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

    /**
     * The anamnesis that belong to the user.
     */
    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class);
    }

    public function medicalRecordsAsDoctor()
    {
        return $this->hasMany(MedicalRecord::class,'doctor_id');
    }

    public function samples()
    {
        return $this->hasMany(Sample::class);
    }

    public function dives()
    {
        return $this->hasMany(Dive::class);
    }

    public function dsgroles()
    {
        return $this->belongsToMany(Role::class)->as('roles')->wherePivot('team_id',4);
    }

    public function sensorsPerDay()
    {
        return $this->hasMany(SensorsPerDay::class);
    }
    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where(function ($q) use ($query) {
                $q->whereRaw("LOWER(firstname) LIKE ? ", ['%' . trim(strtolower($query)) . '%'])
                    ->orWhereRaw("LOWER(lastname) LIKE ? ", ['%' . trim(strtolower($query)) . '%'])
                    ->orWhereRaw("LOWER(email) LIKE ? ", ['%' . trim(strtolower($query)) . '%'])
                    ->orWhereRaw("LOWER(codice_fiscale) LIKE ? ", ['%' . trim(strtolower($query)) . '%']);
            });
    }

    /**
     * @return bool
     */
    public function canImpersonate()
    {
        return false;
        return $this->hasRole('super_admin');
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
        return 's3';
    }

    public function getPasswordResetUrl() {
        return route('invite.accept',['token'=>$this->token]);
    }

    public function sendPasswordResetNotification($token)
    {
        //$url = 'https://example.com/reset-password?token='.$token;

        $this->notify(new ResetPasswordNotification($token));
    }
}
