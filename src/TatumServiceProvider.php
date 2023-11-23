<?php

namespace HopekellDev\Tatum;

use Illuminate\Support\ServiceProvider;

class TatumServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('tatum', function () {
            return new Tatum();
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/tatum.php' => config_path('tatum.php'),
        ], 'config');
    }
}
