<?php

namespace App\Models;

use App\Scopes\OnlyForDoctorScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
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
     * The ananmnesis that belong to the club.
     */
    public function anamnesis(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Anamnesis::class);
    }

    protected function profilePhotoDisk()
    {
        return 's3-public';
    }

    /**
     * Update the user's profile photo.
     *
     * @param  \Illuminate\Http\UploadedFile  $photo
     * @return void
     */
    public function updateProfilePhoto(UploadedFile $photo)
    {
        tap($this->profile_photo_path, function ($previous) use ($photo) {
            $this->forceFill([
                'profile_photo_path' => $photo->storePublicly(
                    'tenant-photos', ['disk' => $this->profilePhotoDisk()]
                ),
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

}
