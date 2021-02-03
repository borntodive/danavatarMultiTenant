<?php

namespace App\Providers;

use App\Actions\Jetstream\DeleteUser;
use App\Models\Tenant;
use App\Models\User;
use Hash;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Http\Requests\LoginRequest;
use Laravel\Jetstream\Jetstream;

class JetstreamServiceProvider extends ServiceProvider
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
        $this->configurePermissions();

        Jetstream::deleteUsersUsing(DeleteUser::class);
        /*Fortify::authenticateUsing(function (LoginRequest $request) {
            $user = User::where('email', $request->email)->first();

            if ($user &&
                Hash::check($request->password, $user->password)) {
                preg_match('/^([a-z0-9|-]+[a-z0-9]{1,}\.)*[a-z0-9|-]+[a-z0-9]{1,}\.[a-z]{2,}$/', $_SERVER['SERVER_NAME'], $matches);
                $subdomain=null;
                if (isset($matches[1]))
                    $subdomain=rtrim($matches[1], " \t.");
                if ($subdomain) {
                    $center = Tenant::where(['url' => $subdomain])->firstOrFail();
                    if ($user->centers->contains($center->id)) {
                        return $user;
                    }
                }

            }
        });*/
    }

    /**
     * Configure the permissions that are available within the application.
     *
     * @return void
     */
    protected function configurePermissions()
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::permissions([
            'create',
            'read',
            'update',
            'delete',
        ]);
    }
}
