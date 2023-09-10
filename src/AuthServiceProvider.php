<?php

namespace Amirsh\Auth;

use Amirsh\Auth\Services\AuthService\AuthInterface;
use Amirsh\Auth\Services\AuthService\AuthService;
use Illuminate\Support\ServiceProvider;


class AuthServiceProvider extends ServiceProvider
{


    public function register()
    {
        $this->app->bind(AuthInterface::class, AuthService::class);

    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        $this->publishes([
            __DIR__.'/../public' => public_path('auth'),
        ], 'public');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'auth');




    }


}