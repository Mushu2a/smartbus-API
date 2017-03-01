<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
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
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.

        $this->app['auth']->viaRequest('api', function ($request) {

            $email = $request->header('email');
            $username = $request->header('username');
            $password = $request->header('password');
            $api_token = $request->header('Api-Token');

            if ($api_token) {

                return User::where('api_token', $api_token)->first();

            } elseif ($email || $username && $password) {

                $user = User::where('email', $email)->orWhere('username', $username)->first();

                if ($user && app('hash')->check($password, $user->password)) {
                    return $user;
                }
            }

            return null;
        });
    }
}
