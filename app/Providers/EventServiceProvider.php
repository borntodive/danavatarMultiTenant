<?php

namespace App\Providers;

use App\Listeners\LoginSuccessful;
use App\Models\Invite;
use App\Models\Tenant;
use App\Models\User;
use App\Observers\InviteObserver;
use App\Observers\TenantObserver;
use App\Observers\UserObserver;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        Login::class => [
            LoginSuccessful::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Tenant::observe(TenantObserver::class);
        User::observe(UserObserver::class);
        Invite::observe(InviteObserver::class);
    }
}
