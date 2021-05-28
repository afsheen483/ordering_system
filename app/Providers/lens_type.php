<?php

namespace App\Providers;
use App\Models\LensModel;

use Illuminate\Support\ServiceProvider;

class lens_type extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        view()->composer('*',function($view){
            $view->with('lens_type_array',LensModel::all());
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
