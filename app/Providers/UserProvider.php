<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;


class UserProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
       
        view()->composer('*',function($view){
            $view->with('user_array',User::role('vendor')->get());
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
