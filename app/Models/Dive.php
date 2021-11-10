<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dive extends Model
{
    use HasFactory;

    protected $casts = [
        'datetime' => 'datetime',
        'divepoints' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
