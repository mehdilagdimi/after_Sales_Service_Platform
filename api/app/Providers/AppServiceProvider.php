<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

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
        //Create admin blade helper
        Blade::if('admin', function () {            
            if (auth()->user() && auth()->user()->role == 'admin') {
                return 1;
            }
            return 0;
        });

        //Create client blade helper
        Blade::if('client', function () {            
            if (auth()->user() && auth()->user()->role == 'client') {
                return 1;
            }
            return 0;
        });
    }
}
