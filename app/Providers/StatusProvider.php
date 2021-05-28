<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\StatusModel;
use DB;
class StatusProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        view()->composer('*',function($view){
            $view->with('status_array',StatusModel::all());
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
