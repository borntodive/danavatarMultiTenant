<?php

namespace App\Models;

use App\Scopes\OnlyForDoctorScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class Tenant extends Authenticatable
{
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     *
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
        'full_url'
    ];

    public function hasMedicalSpecilities($spec)
    {

        return ($this->medicalSpecilities()->withoutGlobalScope(OnlyForDoctorScope::class)->get()->pluck('slug')->search($spec) !== false);
        //return $this->belongsToMany(MedicalSpecialty::class)->withTimestamps();
    }

    /**
     * The users that belong to the club.
     */
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    /**
     * The users that belong to the club.
     */
    public function medicalSpecilities()
    {
        return $this->belongsToMany(MedicalSpecialty::class)->withTimestamps();
    }

    /**
     * The users that belong to the club.
     */
    public function allMedicalSpecilities()
    {
        return $this->belongsToMany(MedicalSpecialty::class)->withoutGlobalScope(OnlyForDoctorScope::class);
    }

    /**
     * The ananmnesis that belong to the club.
     */
    public function anamnesis(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Anamnesis::class);
    }

    /**
     * The ananmnesis that belong to the club.
     */
    public function medicalRecord(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(MedicalRecord::class);
    }

    protected function profilePhotoDisk()
    {
        return 's3';
    }

    /**
     * Update the user's profile photo.
     *
     * @param  \Illuminate\Http\UploadedFile  $photo
     * @return void
     */
    public function updateProfilePhoto(UploadedFile $photo)
    {
        $path = Storage::store('tenant-photos',$photo,$this->profilePhotoDisk());
        tap($this->profile_photo_path, function ($previous) use ($path) {

            $this->forceFill([
                'profile_photo_path' => $path,
            ])->save();
            if ($previous) {
                Storage::disk($this->profilePhotoDisk())->delete($previous);
            }
        });
    }

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::whereRaw("LOWER(name) LIKE ? ", ['%'.trim(strtolower($query)).'%']);
    }

    /**
     * Get the URL to the user's profile photo.
     *
     * @return string
     */
    public function getFullUrlAttribute()
    {
        $protocol='';
        if (request()->secure())
        {
            $protocol='https://';
        }
        else
            $protocol='http://';
        return $protocol.$this->url.'.'.config('app.base_url');

    }

}
