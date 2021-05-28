<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\FrameModel;


class FrameProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        view()->composer('*',function($view){
            $view->with('frame_array',FrameModel::all());
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
