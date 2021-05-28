<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\CoatingModel;

class coating extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        view()->composer('*',function($view){
            $view->with('coating_array',CoatingModel::all());
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
