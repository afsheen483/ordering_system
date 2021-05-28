<?php

namespace App\Providers;
use App\Models\FrameBrand;
use DB;
use Illuminate\Support\ServiceProvider;

class FrameDropDown extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        view()->composer('*',function($view){
            $view->with('frame_brand_array',FrameBrand::select('frame_brands.*','manufacturer_name')->join('manufacturer','frame_brands.manufacturer_id','manufacturer.id')->where('brand_name','!=','Select')->get());
            });
            view()->composer('*',function($view){
                $view->with('category_array',DB::table('categories')->where('category_name','!=','Select')->get());
                });
                view()->composer('*',function($view){
                    $view->with('frame_model_array',DB::table('frame_models')->get());
                    });
                    view()->composer('*',function($view){
                        $view->with('adjustment_array',DB::table('adjustment')->get());
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
