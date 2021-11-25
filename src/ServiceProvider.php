<?php

namespace Goedemiddag\Auth;

use Illuminate\Support\Facades\Auth;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{

    public function boot()
    {
        Auth::provider('gm:simple', function ($app, array $config) {
            return new SimpleUserProvider($config['email'], $config['password']);
        });
    }

}
