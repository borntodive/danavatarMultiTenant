<?php

namespace App\Models;

use App\Traits\BelongsToMedicalCenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSubscription extends Model
{
    use HasFactory;
    use BelongsToMedicalCenter;

    protected $casts = [
        'expiring_date' => 'datetime',
        'payment_method' => UserRoleEnum::class
    ];


}
