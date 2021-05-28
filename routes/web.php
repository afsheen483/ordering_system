<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('auth.login');
// });

Route::get('/', function () {
    if (Auth::check()) {
        return view('admin.dashboard');
    }
    return view('newlogin');
})->name('login');
// Route::get('/admin', function () {
//     return view('admin.dashboard');
// });
Route::get('/roles', function () {
    return view('roles.role');
})->middleware('auth');
// Route::get('/vendors', function () {
//     return view('vendors.vendors_dashboard');
// });
Route::get('/coating', function () {
    return view('Coating.coating');
})->middleware('auth');
Route::get('/frame', function () {
    return view('Frames.index');
})->middleware('auth');
Route::get("/lens_edit/{id}", function () {
    return view('LensType.edit');
})->middleware('auth');
Route::get("/complete_orders", function () {
    return view('vendors.complete_orders');
});


Auth::routes();

Route::get('/lens_edit/{id}', 'LensController\Lens@edit')->middleware('auth');
Route::get('/coating_edit/{id}', 'CoatingController@edit')->middleware('auth');
Route::get('/frame_edit/{id}', 'FrameController@edit')->middleware('auth');
Route::get('/roles_edit/{id}', 'RoleController@edit')->middleware('auth');
Route::get('/orders_edit/{patient_id}', 'OrderController@edit')->middleware('auth');
Route::get('/orders_show/{patient_id}', 'OrderController@show')->middleware('auth');
Route::get('/orders_print/{patient_id}', 'OrderController@OrderPrint')->middleware('auth');
Route::get('/permission_edit/{id}', 'PermissionController@edit')->middleware('auth');
Route::get('/roles_edit/{id}', 'RoleController@edit')->middleware('auth');
Route::get('/users_edit/{id}', 'UserController@edit')->middleware('auth');
Route::delete('/orders_delete/{id}', 'OrderController@destroy')->middleware('auth');
Route::get('/prescription_edit/{id}', 'PrescriptionController@edit')->middleware('auth');
//Route::get('/toggle', 'Filters\ToggleButtonController@index');
Route::put('/lens_update/{id}', 'LensController\Lens@update')->middleware('auth');
Route::put('/frame_update/{id}', 'FrameController@update')->middleware('auth');
Route::put('/orders_update/{id}/{order_status}', 'OrderController@update')->middleware('auth');
Route::put('/frame_update/{id}/{frame_status}', 'OrderController@frameStatus')->middleware('auth');
Route::put('/role_update/{id}', 'RoleController@update')->middleware('auth');
Route::put('/coating_update/{id}', 'CoatingController@update')->middleware('auth');
Route::put('/prescription_update/{id}', 'PrescriptionController@update')->middleware('auth');
Route::put('/shippment_orders_update/{id}', 'ShippmentOrdersController@update')->middleware('auth');
Route::get('/orders-list/{filter}','OrderController@index')->middleware('auth');
Route::get('/detail/{filter}','OrderController@detail')->middleware('auth');
Route::get('/orders-list/{priority}','OrderController@priorityOrders')->middleware('auth');
Route::get('/order-filter','OrderController@orderFilter')->middleware('auth');
Route::get('/tracking_details','VendorsNumbersController@trackingDetails')->middleware('auth');
Route::get('/total-price/{patient_id}','VendorsNumbersController@totalPrice')->middleware('auth');
Route::get('/getTracking_Number/{patient_id}','VendorsNumbersController@GetTrackingNumbers')->middleware('auth');



Route::resource('prescription','PrescriptionController')->middleware('auth');
Route::resource('lens','LensController\Lens')->middleware('auth');
Route::resource('orders','OrderController')->middleware('auth');

Route::resource('next_periority_orders','VendorsController')->middleware('auth');
//Route::resource('complete_orders','CompleteOrders');
// Route::get('shipped_orders','Filters\CompleteOrdersController@index');
// Route::get('receive_orders','Filters\ReceivedController@index');
// Route::get('unreceive_orders','Filters\UnReceivedController@index');
// Route::get('missing_orders','Filters\MissingOrdersController@index');
Route::resource('coating','CoatingController')->middleware('auth');
Route::resource('frame','FrameController')->middleware('auth');
Route::get('frame_delete/{id}','FrameController@destroy')->middleware('auth');
Route::delete('coatings/{id}','CoatingController@destroy')->middleware('auth');
Route::resource('/orders_head','OrderHeadController')->middleware('auth');
Route::put('/order_price/{id}','VendorsNumbersController@update')->middleware('auth');
Route::resource('/vendor_number','VendorsNumbersController')->middleware('auth');
Route::put('/vendor_number_update/{id}','VendorsNumbersController@updatePaidStatus')->middleware('auth');
Route::resource('shippment_orders','ShippmentOrdersController')->middleware('auth');
Route::resource('users', 'UserController')->middleware('auth');

Route::resource('roles', 'RoleController')->middleware('auth');

Route::resource('permissions', 'PermissionController')->middleware('auth');

//Route::resource('posts', 'PostController');
Route::get('dashboard', 'AdminController@index')->middleware('auth');

// Route::group(['middleware' => ['role:staff']], function () {
//     Route::resource('prescription','PrescriptionController');
//     Route::resource('lens','LensController\Lens');
    
//     Route::resource('orders','OrderController');
//     Route::resource('shippment_orders','ShippmentOrdersController');
//     Route::resource('next_periority_orders','VendorsController');
//     Route::resource('complete_orders','CompleteOrders');
//     Route::get('shipped_orders','Filters\CompleteOrdersController@index');
//     Route::get('missing_orders','Filters\MissingOrdersController@index');
//     Route::resource('coating','CoatingController');
//     Route::resource('/orders_head','OrderHeadController');
//     Route::resource('/vendor_number','VendorsNumbersController');


// });
Route::get('/clear', function() {

   Artisan::call('cache:clear');
   Artisan::call('config:clear');
   Artisan::call('config:cache');
   Artisan::call('view:clear');

   return "Cleared!";

});

Route::get('/login', function () {
    if (Auth::check()) {
        return view('admin.dashboard');
    }
    return view('newlogin');
})->name('login');

Route::resource('frame_order', 'FrameOrderController')->middleware('auth');
Route::get('frameorder_edit/{id}', 'FrameOrderController@create')->middleware('auth');
Route::put('frameorder_update/{id}', 'FrameOrderController@update')->middleware('auth');
Route::get('frame_order_show/{id}', 'FrameOrderController@show')->middleware('auth');
Route::put('status_id/{delete_id}', 'FrameOrderController@destroy')->middleware('auth');
Route::get('stockItem/{id}', 'StockItem@index')->middleware('auth');

Route::resource('inventory_adjustment', 'InventoryAdjustmentController')->middleware('auth');
Route::put('inventory_adjustment_update/{id}', 'InventoryAdjustmentController@update')->middleware('auth');
Route::get('inventory_adjustment_show/{id}', 'InventoryAdjustmentController@show')->middleware('auth');

Route::resource('clinic', 'ClinicController')->middleware('auth');
Route::put('clinic_update/{id}', 'ClinicController@update')->middleware('auth');
Route::delete('/clinic_delete/{id}', 'ClinicController@destroy')->middleware('auth');


Route::get('get_models/{id}','GetFrameModelController@index')->middleware('auth');
Route::get('get_status','GetFrameModelController@status')->middleware('auth');
Route::put('orders_update/{id}','GetFrameModelController@update')->middleware('auth');


Route::get('inventory_reports/{filters}','InventoryReport@index')->middleware('auth');
Route::get('inventory_reports_create','InventoryReport@create')->middleware('auth');


Route::get('get_lab_status','GetFrameModelController@LabStatus')->middleware('auth');
Route::put('lab_status_update/{id}','GetFrameModelController@LabStatusUpdate')->middleware('auth');


Route::get('print_lable', 'OrderController@print');
Route::get('print_orders', 'OrderController@printMultipleOrders');
Route::get('cycle_amount_inventory', 'CycleAmountInventory@index');

Route::post('cyl_sph_filter', 'OrderController@CYLSPHFilter');

Route::put('update_tray_number/{id}', 'VendorsNumbersController@InsertTrayNumber');
Route::put('update_lab_status/{order_id}', 'OrderHeadController@update');
Route::put('lab_status_change', 'OrderHeadController@ChangeLabStatus');

