<?php

namespace App\Providers;

use App;
use Blade;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::component('components.layout.breadcrumb');
        if (App::environment('production', 'staging')) {
            URL::forceScheme('https');
        }
        Cashier::calculateTaxes();
    }
}
