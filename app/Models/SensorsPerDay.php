<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SensorsPerDay extends Model
{
    use HasFactory;
    protected $table = 'sensors_per_day';

    protected $guarded =[];

    protected $casts = [
        'sensors' => 'array',
        'date' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
