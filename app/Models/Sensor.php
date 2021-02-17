<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    protected $appends = ['displayName'];

    public function getDisplayNameAttribute()
    {

        return trim(preg_replace("([A-Z])", " $0", $this->name));
    }

    public function samples()
    {
        return $this->hasMany(Sample::class);
    }
}
