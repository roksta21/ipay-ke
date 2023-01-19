<?php

namespace Roksta\IPay\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use Roksta\IPay\IPayMain;

class IPayServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        App::bind('ipay',function() {
            return new IPayMain;
        });

        $this->mergeConfigFrom(
            __DIR__.'/../config/ipay.php', 'ipay'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/ipay.php' => config_path('ipay.php'),
        ]);
    }
}
