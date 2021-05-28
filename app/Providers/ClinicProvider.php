<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;
class ClinicProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        view()->composer('*',function($view){
            $view->with('clinic_array',DB::table('clinics')->get());
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
