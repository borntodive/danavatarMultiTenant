<?php

namespace App\Enums;

enum PaymentMethodEnum:String {
    case STRIPE = 'stripe';
    case COUPON = 'coupon';
    case DANMEMBER = 'dan_member';
}
