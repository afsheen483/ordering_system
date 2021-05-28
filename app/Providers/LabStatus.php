<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;

class LabStatus extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        view()->composer('*',function($view){
            $view->with('lab_status_array',DB::table('lab_status')->get());
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
