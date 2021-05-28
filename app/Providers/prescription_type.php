<?php

namespace App\Providers;
use App\Models\PrescriptionModel;

use Illuminate\Support\ServiceProvider;

class prescription_type extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        view()->composer('*',function($view){
            $view->with('prescription_array',PrescriptionModel::all());
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
