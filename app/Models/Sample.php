<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sample extends Model
{
    use HasFactory;
    protected $protected = [];

    protected $casts = [
        'time' => 'datetime',
    ];

    protected $appends = ['date','timeOnly'];

    public function getDateAttribute()
    {
        return $this->time->toDateString();
    }
    public function getTimeOnlyAttribute()
    {
        return $this->time->toTimeString();
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sensor()
    {
        return $this->belongsTo(Sensor::class);
    }

}
