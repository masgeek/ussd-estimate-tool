<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //to all views
        view()->composer('*', function (View $view) {
            //pass menus from the menus config file
            if(Auth::check()){
                $view->with('menus', config(Auth::user()->hasRole('admin')?'menus.admin':'menus.owner'));
            }
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
