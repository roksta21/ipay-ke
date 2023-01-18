<?php

namespace Roksta\IPay\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use Roksta\IPay\IPay;

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
            return new IPay;
         });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
