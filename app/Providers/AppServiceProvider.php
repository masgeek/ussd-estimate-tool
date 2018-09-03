<?php

namespace App\Providers;

use AfricasTalking\AfricasTalking;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        if ($this->app->environment() !== 'production') {
            $this->app->register(IdeHelperServiceProvider::class);
        }

        App::bind('\AfricasTalking\AfricasTalking', function () {
            return new AfricasTalking('baringo', 'f4f533553defccd4dde39854f5621ecab7c32b1f92081bf9206753f93d581598');
        });


        //validation for student exists
        /* \Validator::extend('student_exists', function($attribute, $value, $parameters, $validator) {
             if(\Auth::user()!==null){
                 return Student::where('adm_no',$value)
                         ->where('school_id',\Auth::user()->staff->school_id)->count()==0;
             }
             return false;});*/

    }
}
