<?php

namespace App\Models;

use App\Traits\BelongsToMedicalCenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiToken extends Model
{
    use HasFactory, BelongsToMedicalCenter;

    protected $guarded=[];
}
