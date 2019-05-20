<?php

namespace arnehendriksen\LaravelIpRestrictions;

use Illuminate\Support\ServiceProvider;

class IpRestrictionsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/ip-restrictions.php' => config_path('ip-restrictions.php'),
        ], 'ip-restrictions');
    }

    public function register()
    {
        //
    }
}