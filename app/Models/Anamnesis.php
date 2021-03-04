<?php

namespace App\Models;

use App\Traits\BelongsToMedicalCenter;
use Illuminate\Database\Eloquent\Model;

class Anamnesis extends Model
{
    use BelongsToMedicalCenter;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
    * The attributes that should be cast to native types.
    *
    * @var array
     */
    protected $casts = [
        'data' => 'array',
    ];


    /**
     * The user that belong to the anamnesis.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
