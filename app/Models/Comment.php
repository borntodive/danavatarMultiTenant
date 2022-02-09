<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'time' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function sensor()
    {
        return $this->belongsTo('App\Models\Sensor');
    }

    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }
}
