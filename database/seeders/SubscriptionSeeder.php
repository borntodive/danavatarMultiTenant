<?php

namespace Database\Seeders;

<<<<<<< HEAD
=======
use App\Enums\PaymentMethodEnum;
use App\Models\AvatarSubscription;
use App\Models\Tenant;
use App\Models\User;
use App\Models\UserSubscription;
>>>>>>> laravel-upgrade
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
<<<<<<< HEAD
        //
=======
        AvatarSubscription::firstOrCreate(
            [
                'name' => 'Basic',
                'slug' => 'basic',
                'level' => 1,
            ]
        );
        AvatarSubscription::firstOrCreate(
            [
                'name' => 'Advanced',
                'slug' => 'advanced',
                'level' => 10,
            ]
        );


        $user = User::where('email', 'dsgOperator@example.com')->first();
        $basicSubscrtiption = AvatarSubscription::where("name", 'Basic')->first();
        $dsg =  Tenant::where('url', 'dsg')->first();
        $userSubscription = new UserSubscription();
        $userSubscription->user_id = $user->id;
        $userSubscription->avatar_subscription_id = $basicSubscrtiption->id;
        $userSubscription->expiring_date = now()->addYear();
        $userSubscription->payment_method = PaymentMethodEnum::COUPON;
        $userSubscription->tenant_id = $dsg->id;
        $userSubscription->save();
>>>>>>> laravel-upgrade
    }
}
