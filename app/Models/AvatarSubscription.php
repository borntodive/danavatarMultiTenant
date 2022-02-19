<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use BeyondCode\Vouchers\Traits\HasVouchers;
class AvatarSubscription extends Model
{
    use HasFactory;
    use HasVouchers;
}
