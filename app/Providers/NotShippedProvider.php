<?php

namespace App\Providers;
use Auth;
use Illuminate\Support\ServiceProvider;
use App\Models\VendorNumberModel;
class NotShippedProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
      
        // $status = new status();
        // $id = Auth::user()->id;
        // if (Auth::user()->hasrole('vendor')) {
        //     $status = VendorNumberModel::all();
        // }
        // else{
        //     $status = VendorNumberModel::all();
        
        // }
        // return view('admin.dashboard')->with('status',$status);
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
