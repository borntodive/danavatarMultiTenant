<?php

namespace App\Models;

use App\Enums\PaymentMethodEnum;
use App\Traits\BelongsToMedicalCenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSubscription extends Model
{
    use HasFactory;
    use BelongsToMedicalCenter;

    protected $casts = [
        'expiring_date' => 'datetime',
        //'payment_method' => PaymentMethodEnum::class
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'subscription_slug',
        'subscription_name',
    ];

    /**
     * Get the user's name.
     *
     * @return string
     */
    public function getSubscriptionNameAttribute()
    {

        return $this->subscription->name;
    }

    /**
     * Get the user's name.
     *
     * @return string
     */
    public function getSubscriptionSlugAttribute()
    {
        return $this->subscription->slug;
    }

    public function subscription()
    {
        return $this->belongsTo(AvatarSubscription::class,'avatar_subscription_id');
    }


}
