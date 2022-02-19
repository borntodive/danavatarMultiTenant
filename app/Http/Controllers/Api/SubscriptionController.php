<?php

namespace App\Http\Controllers\Api;

use App\Models\AvatarSubscription;
use Illuminate\Http\Request;

class SubscriptionController extends \App\Http\Controllers\Controller
{
    public function getSetupIntent( Request $request ){
        $stripeCustomer = auth()->user()->createOrGetStripeCustomer();
        return auth()->user()->createSetupIntent();
    }

    public function index() {
        return AvatarSubscription::get();
    }
    public function getInvoices( Request $request ){
        return auth()->user()->invoices();
    }

    public function storePaymentMethod( Request $request ){

        auth()->user()->addPaymentMethod($request->payment_method);
        return auth()->user()->paymentMethods();
    }
    public function getPaymentMethod( Request $request ){

        return auth()->user()->paymentMethods();
    }

}
