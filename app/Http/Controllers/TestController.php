<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orders;
use Auth;
use DB;

class TestController extends Controller
{
    // public function index()
    // {
    // 	$orders = new Orders();
    //     $id = Auth::user()->id;
      
    //     if(Auth::user()->hasRole('vendor') && $filter == 'notshipped'){
    //         // $orders= [];
    //         // $tableONe = Orders::where('shippment_status','Next shippment')->where('vendor_id','=',$id)->exists();
    //         // if($tableONe == true)
    //         // {
    //         // $tableONe = Orders::where('shippment_status','Next shippment')->where('vendor_id','=',$id)->get();
    //         // array_push($orders,$tableONe);
    //         // $tableTwo = VendorNumberModel::simplePaginate(20);
    //         // array_push($orders,$tableTwo);
    //         // }
    //         // $orders = Orders::select('orders.*','order_head.*','patients.*','prescription_type.*','frame_models.*')->join('order_head', 'order_head.id', '=','orders.order_head_id')->join('patients','patients.id','order_head.patient_id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->join('frame_models','frame_models.id','order_head.frame_model_id')->where('order_head.tracking_numbers',' ')->where('order_head.order_status','Pending')->where('order_head.vendor_id','=',$id)->get();
    //         $orders = DB::table('order_head')->join('patients','patients.id','order_head.patient_id')->leftjoin('lab_status','order_head.lab_status_id','lab_status.id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->leftJoin('tracking_head','order_head.tracking_numbers','tracking_head.tracking_number')->join('frame_models','frame_models.id','order_head.frame_model_id')->where('order_head.order_status','Not Shipped')->where('order_head.vendor_id','=',$id)->select('order_head.*','patients.patient_name','patients.date_of_service','patients.tray_number','prescription_type.type','frame_models.model_name','tracking_head.freight_cost','tracking_head.tracking_number','lab_status.status_type')->orderBy('order_head.id', 'desc')->get();

    //         //$orders = Orders::select('orders.*','shipping_details.*')->join('shipping_details', 'shipping_details.patient_id', '=','orders.patient_id')->where('orders.shippment_status','=','Next shippment')->where('vendor_id','=',$id)->simplePaginate(2);
           
    //     }
    //     else{
    //         if ($filter == 'notshipped') {
    //             // $orders= [];
    //             // $tableONe = Orders::where('shippment_status','Next shippment')->get();
    //             // array_push($orders,$tableONe);
    //             // $tableTwo = VendorNumberModel::all();
    //             // array_push($orders,$tableTwo);
    //             // $orders = Orders::select('orders.*','order_head.*','patients.*','prescription_type.*','frame_models.*')->join('order_head', 'order_head.id', '=','orders.order_head_id')->join('patients','patients.id','order_head.patient_id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->join('frame_models','frame_models.id','order_head.frame_model_id')->where('order_head.tracking_numbers',' ')->get();
    //             // $orders = Orders::select('orders.*','order_head.*','patients.*','prescription_type.*','frame_models.*')->join('order_head', 'order_head.id', '=','orders.order_head_id')->join('patients','patients.id','order_head.patient_id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->join('frame_models','frame_models.id','order_head.frame_model_id')->where('order_head.tracking_numbers','')->where('order_head.order_status','Pending')->get();
    //             $orders = DB::table('order_head')->join('patients','patients.id','order_head.patient_id')->leftjoin('lab_status','order_head.lab_status_id','lab_status.id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->leftJoin('tracking_head','order_head.tracking_numbers','tracking_head.tracking_number')->join('frame_models','frame_models.id','order_head.frame_model_id')->where('order_head.order_status','Not Shipped')->select('order_head.*','patients.patient_name','patients.date_of_service','patients.tray_number','prescription_type.type','frame_models.model_name','tracking_head.freight_cost','tracking_head.tracking_number','lab_status.status_type')->orderBy('order_head.id', 'desc')->get();

    //             //$orders = Orders::select('orders.*','shipping_details.*')->join('shipping_details', 'shipping_details.patient_id', '=','orders.patient_id')->where('orders.shippment_status','Next shippment')->simplePaginate(2);
                
    //            }
        
    //     }
       
        
    // if(Auth::user()->hasRole('vendor') && $filter == 'shipped'){
    //         // $orders= [];
    //         // $tableONe = Orders::where('shippment_status','Shipped')->where('vendor_id','=',$id)->exists();
    //         // if($tableONe == true)
    //         // {
    //         // $tableONe = Orders::where('shippment_status','Shipped')->where('vendor_id','=',$id)->get();
    //         // array_push($orders,$tableONe);
    //         // $tableTwo = VendorNumberModel::simplePaginate(20);
    //         // array_push($orders,$tableTwo);
    //         //dd($orders);
    //         $orders = DB::table('order_head')->join('patients','patients.id','order_head.patient_id')->leftjoin('lab_status','order_head.lab_status_id','lab_status.id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->leftJoin('tracking_head','order_head.tracking_numbers','tracking_head.tracking_number')->join('frame_models','frame_models.id','order_head.frame_model_id')->where('order_head.order_status','Shipped')->where('order_head.vendor_id','=',$id)->select('order_head.*','patients.patient_name','patients.tray_number','patients.date_of_service','prescription_type.type','frame_models.model_name','tracking_head.freight_cost','tracking_head.tracking_number','lab_status.status_type')->orderBy('order_head.id', 'desc')->get();

    //         }
           
    //         //$orders = Orders::select('orders.*','shipping_details.*')->join('shipping_details', 'shipping_details.patient_id', '=','orders.patient_id')->where('orders.shippment_status','Shipped')->where('orders.vendor_id','=',$id)->simplePaginate(2);
    
    // else{
    //     if($filter == 'shipped'){
    //         // $orders= [];
    //         // $tableONe = Orders::where('shippment_status','Shipped')->get();
    //         // array_push($orders,$tableONe);
    //         // $tableTwo = VendorNumberModel::all();
    //         // array_push($orders,$tableTwo);
    //         //$orders = Orders::select('orders.*','shipping_details.*')->join('shipping_details', 'shipping_details.patient_id','=','orders.patient_id')->where('orders.shippment_status','Shipped')->simplePaginate(2);
    //        // $orders = Orders::select('orders.*','order_head.*','patients.*','prescription_type.*','frame_models.*')->join('order_head', 'order_head.id', '=','orders.order_head_id')->join('patients','patients.id','order_head.patient_id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->join('frame_models','frame_models.id','order_head.frame_model_id')->where('order_head.tracking_numbers','')->where('order_head.order_status ','Pending')->get();
    //        $orders = DB::table('order_head')->join('patients','patients.id','order_head.patient_id')->leftjoin('lab_status','order_head.lab_status_id','lab_status.id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->leftJoin('tracking_head','order_head.tracking_numbers','tracking_head.tracking_number')->join('frame_models','frame_models.id','order_head.frame_model_id')->where('order_head.order_status','Shipped')->select('order_head.*','patients.patient_name','patients.date_of_service','patients.tray_number','prescription_type.type','frame_models.model_name','tracking_head.freight_cost','tracking_head.tracking_number','lab_status.status_type')->orderBy('order_head.id', 'desc')->get();

    //     }
       
    // }
    // if(Auth::user()->hasRole('vendor') && $filter == 'received'){
    //         // $orders= [];
    //         // $tableONe = Orders::where('order_status','Received')->where('vendor_id','=',$id)->exists();
    //         // if($tableONe == true)
    //         // {
    //         // $tableONe = Orders::where('order_status','Received')->where('vendor_id','=',$id)->get();
    //         // array_push($orders,$tableONe);
    //         // $tableTwo = VendorNumberModel::all();
    //         // array_push($orders,$tableTwo);
    //         // }
    //     //$orders = Orders::select('orders.*','shipping_details.*')->join('shipping_details', 'shipping_details.patient_id','=','orders.patient_id')->where('orders.order_status','Received')->where('orders.vendor_id','=',$id)->simplePaginate(2);
    //     // $orders = Orders::select('orders.*','order_head.*','patients.*','prescription_type.*','frame_models.*')->join('order_head', 'order_head.id', '=','orders.order_head_id')->join('patients','patients.id','order_head.patient_id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->join('frame_models','frame_models.id','order_head.frame_model_id')->where('order_head.order_status','Received')->where('order_head.vendor_id','=',$id)->get();
    //     $orders = DB::table('order_head')->join('patients','patients.id','order_head.patient_id')->leftjoin('lab_status','order_head.lab_status_id','lab_status.id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->leftJoin('tracking_head','order_head.tracking_numbers','tracking_head.tracking_number')->join('frame_models','frame_models.id','order_head.frame_model_id')->where('order_head.order_status','Received')->where('order_head.vendor_id','=',$id)->select('order_head.*','patients.patient_name','patients.tray_number','patients.date_of_service','prescription_type.type','frame_models.model_name','tracking_head.freight_cost','tracking_head.tracking_number','lab_status.status_type')->orderBy('order_head.id', 'desc')->get();

    // }
    // else{
    //     if($filter == 'received'){
    //         // $orders= [];
    //         // $tableONe = Orders::where('order_status','Received')->get();
    //         // array_push($orders,$tableONe);
    //         // $tableTwo = VendorNumberModel::all();
    //         // array_push($orders,$tableTwo);
    //         //$orders = Orders::select('orders.*','shipping_details.*')->join('shipping_details', 'shipping_details.patient_id', '=','orders.patient_id')->where('orders.order_status','Received')->simplePaginate(2);
    //         // $orders = Orders::select('orders.*','order_head.*','patients.*','prescription_type.*','frame_models.*')->join('order_head', 'order_head.id', '=','orders.order_head_id')->join('patients','patients.id','order_head.patient_id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->join('frame_models','frame_models.id','order_head.frame_model_id')->where('order_head.order_status','Received')->get();
    //         $orders = DB::table('order_head')->join('patients','patients.id','order_head.patient_id')->leftjoin('lab_status','order_head.lab_status_id','lab_status.id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->leftJoin('tracking_head','order_head.tracking_numbers','tracking_head.tracking_number')->join('frame_models','frame_models.id','order_head.frame_model_id')->where('order_head.order_status','Received')->select('order_head.*','patients.patient_name','patients.date_of_service','patients.tray_number','prescription_type.type','frame_models.model_name','tracking_head.freight_cost','tracking_head.tracking_number','lab_status.status_type')->orderBy('order_head.id', 'desc')->get();

            
    //     }
    // }
    // if(Auth::user()->hasRole('vendor') && $filter == 'missing'){
    //         // $orders= [];
    //         // $tableONe = Orders::where('order_status','Missing')->where('vendor_id','=',$id)->exists();
    //         // if($tableONe == true)
    //         // {
    //         // $tableONe = Orders::where('order_status','Missing')->where('vendor_id','=',$id)->get();
    //         // array_push($orders,$tableONe);
    //         // $tableTwo = VendorNumberModel::all();
    //         // array_push($orders,$tableTwo);
    //         // }
    //         // $orders = Orders::select('orders.*','order_head.*','patients.*','prescription_type.*','frame_models.*')->join('order_head', 'order_head.id', '=','orders.order_head_id')->join('patients','patients.id','order_head.patient_id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->join('frame_models','frame_models.id','order_head.frame_model_id')->where('order_head.order_status','Missing')->where('order_head.vendor_id','=',$id)->get();
    //         $orders = DB::table('order_head')->join('patients','patients.id','order_head.patient_id')->leftjoin('lab_status','order_head.lab_status_id','lab_status.id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->leftJoin('tracking_head','order_head.tracking_numbers','tracking_head.tracking_number')->join('frame_models','frame_models.id','order_head.frame_model_id')->where('order_head.order_status','Missing')->where('order_head.vendor_id','=',$id)->select('order_head.*','patients.patient_name','patients.tray_number','patients.date_of_service','prescription_type.type','frame_models.model_name','tracking_head.freight_cost','tracking_head.tracking_number','lab_status.status_type')->orderBy('order_head.id', 'desc')->get();

    //     //$orders = Orders::select('orders.*','shipping_details.*')->join('shipping_details', 'shipping_details.patient_id', '=','orders.patient_id')->where('orders.order_status','Missing')->where('orders.vendor_id','=',$id)->simplePaginate(2);
        
    // }
    // else{
    //     if($filter == 'missing'){
    //         // $orders= [];
    //         // $tableONe = Orders::where('order_status','Missing')->get();
    //         // array_push($orders,$tableONe);
    //         // $tableTwo = VendorNumberModel::all();
    //         // array_push($orders,$tableTwo);
    //         //$orders = Orders::select('orders.*','shipping_details.*')->join('shipping_details', 'shipping_details.patient_id','orders.patient_id')->where('orders.order_status','Missing')->simplePaginate(2);
    //         //dd($orders);
    //         // $orders = Orders::select('orders.*','order_head.*','patients.*','prescription_type.*','frame_models.*')->join('order_head', 'order_head.id', '=','orders.order_head_id')->join('patients','patients.id','order_head.patient_id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->join('frame_models','frame_models.id','order_head.frame_model_id')->where('order_head.order_status','Missing')->get();
    //         $orders = DB::table('order_head')->join('patients','patients.id','order_head.patient_id')->leftjoin('lab_status','order_head.lab_status_id','lab_status.id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->leftJoin('tracking_head','order_head.tracking_numbers','tracking_head.tracking_number')->join('frame_models','frame_models.id','order_head.frame_model_id')->where('order_head.order_status','Missing')->select('order_head.*','patients.patient_name','patients.date_of_service','patients.tray_number','prescription_type.type','frame_models.model_name','tracking_head.freight_cost','tracking_head.tracking_number','lab_status.status_type')->orderBy('order_head.id', 'desc')->get();

    //     }
    
    // }
    //     if(Auth::user()->hasRole('vendor') && $filter == 'all')
    //     {
            
    //         // $orders= [];
    //         // $tableONe = Orders::where('vendor_id','=',$id)->exists();
    //         // // dd($tableONe);
    //         // if($tableONe == true)
    //         // {
    //         //    //dd($tableONe);
    //         //    $tableONe = Orders::where('vendor_id','=',$id)->get();
    //         //     array_push($orders,$tableONe);
    //         //     $tableTwo = VendorNumberModel::all();
    //         //     array_push($orders,$tableTwo);
                
    //         //     $table3 = OrderHeadModel::all();
    //         //     array_push($orders,$table3);

    //         // }
    //         //$orders = Orders::select('orders.*','order_head.*','patients.*','prescription_type.*','frame_models.*')->join('order_head', 'order_head.id', '=','orders.order_head_id')->join('patients','patients.id','order_head.patient_id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->join('frame_models','frame_models.id','order_head.frame_model_id')->where('order_head.vendor_id','=',$id)->get();
    //         $orders = DB::table('order_head')->join('patients','patients.id','order_head.patient_id')->leftjoin('lab_status','order_head.lab_status_id','lab_status.id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->leftJoin('tracking_head','order_head.tracking_numbers','tracking_head.tracking_number')->join('frame_models','frame_models.id','order_head.frame_model_id')->where('order_head.vendor_id','=',$id)->select('order_head.*','patients.patient_name','patients.date_of_service','patients.tray_number','prescription_type.type','frame_models.model_name','tracking_head.freight_cost','tracking_head.tracking_number','lab_status.status_type')->orderBy('order_head.id', 'desc')->get();
    //        // dd($orders);

         


    //     //$orders = Orders::select('orders.*','shipping_details.*')->join('shipping_details', 'shipping_details.patient_id', '=','orders.patient_id');
    //     }
    //     else{
    //         if( $filter == 'all'){
    //             // $orders = [];
    //             // $tableONe = Orders::all();
    //             // array_push($orders,$tableONe);
    //             // $tableTwo = VendorNumberModel::all();
    //             // array_push($orders,$tableTwo);
                
    //             // $table3 = OrderHeadModel::all();
    //             // array_push($orders,$table3);
                
    //             //dd($res);
    //         // $orders = Orders::select('orders.*','order_head.*','patients.*','prescription_type.*','frame_models.*')->join('order_head', 'order_head.id', '=','orders.order_head_id')->join('patients','patients.id','order_head.patient_id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->join('frame_models','frame_models.id','order_head.frame_model_id')->get();
    //         $orders = DB::table('order_head')->leftjoin('patients','patients.id','order_head.patient_id')->leftjoin('prescription_type','prescription_type.id','order_head.prescription_id')->leftJoin('tracking_head','order_head.tracking_numbers','tracking_head.tracking_number')->leftjoin('lab_status','order_head.lab_status_id','lab_status.id')->leftjoin('frame_models','frame_models.id','order_head.frame_model_id')->select('order_head.*','patients.patient_name','patients.date_of_service','patients.tray_number','prescription_type.type','frame_models.model_name','tracking_head.freight_cost','tracking_head.tracking_number','lab_status.status_type')->orderBy('order_head.id', 'desc')->get();
    //         //dd($orders);
    //         }
    //     }
        
    //     if(Auth::user()->hasRole('vendor') && $filter == 'priority'){
    //         // $orders= [];
    //         // $tableONe = Orders::where('vendor_id','=',$id)->exists();
    //         // if($tableONe == true)
    //         // {
    //         // $tableONe = Orders::where('vendor_id','=',$id)->get();
    //         // array_push($orders,$tableONe);
    //         // $tableTwo = VendorNumberModel::all();
    //         // array_push($orders,$tableTwo);
    //         $orders = DB::table('order_head')->leftjoin('patients','patients.id','order_head.patient_id')->leftjoin('prescription_type','prescription_type.id','order_head.prescription_id')->leftJoin('tracking_head','order_head.tracking_numbers','tracking_head.tracking_number')->leftjoin('lab_status','order_head.lab_status_id','lab_status.id')->leftjoin('frame_models','frame_models.id','order_head.frame_model_id')->where('order_head.vendor_id','=',$id)->select('order_head.*','patients.patient_name','patients.tray_number','patients.date_of_service','prescription_type.type','frame_models.model_name','tracking_head.freight_cost','tracking_head.tracking_number','lab_status.status_type')->orderBy('order_head.id', 'desc')->get();
    //         return view('vendors.next_periority_orders',compact('orders'));

    //         }
            
    //         //$orders = Orders::select('orders.*','shipping_details.*')->join('shipping_details', 'shipping_details.patient_id', '=','orders.patient_id')->where('orders.vendor_id','=',$id)->simplePaginate(20);
    //     else{
    //         if ($filter == 'priority') {
    //             // $orders= [];
    //             // $tableONe = Orders::all();
    //             // array_push($orders,$tableONe);
    //             // $tableTwo = VendorNumberModel::all();
    //             // array_push($orders,$tableTwo);
    //             //$orders = Orders::select('orders.*','shipping_details.*')->join('shipping_details', 'shipping_details.patient_id','orders.patient_id')->simplePaginate(2);
    //             $orders = DB::table('order_head')->join('patients','patients.id','order_head.patient_id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->leftJoin('tracking_head','order_head.tracking_numbers','tracking_head.tracking_number')->join('lab_status','order_head.lab_status_id','lab_status.id')->join('frame_models','frame_models.id','order_head.frame_model_id')->select('order_head.*','patients.patient_name','patients.date_of_service','patients.tray_number','prescription_type.type','frame_models.model_name','tracking_head.freight_cost','tracking_head.tracking_number','lab_status.status_type')->orderBy('order_head.id', 'desc')->get();

    //             return view('vendors.next_periority_orders',compact('orders'));

    //            }
               
    //     }
    //     if ($filter == 'unpaid') {
    //         $orders = DB::table('order_head')->join('patients','patients.id','order_head.patient_id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->leftJoin('tracking_head','order_head.tracking_numbers','tracking_head.tracking_number')->join('lab_status','order_head.lab_status_id','lab_status.id')->join('frame_models','frame_models.id','order_head.frame_model_id')->where('order_head.paid',' ')->where('order_head.paid','=','0')->select('order_head.*','patients.patient_name','patients.date_of_service','patients.tray_number','prescription_type.type','frame_models.model_name','tracking_head.freight_cost','tracking_head.tracking_number','lab_status.status_type')->orderBy('order_head.id', 'desc')->get();

    //     }else{
    //         if (Auth::user()->hasRole('vendor') && $filter == 'unpaid') {
    //             $orders = DB::table('order_head')->join('patients','patients.id','order_head.patient_id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->leftJoin('tracking_head','order_head.tracking_numbers','tracking_head.tracking_number')->join('lab_status','order_head.lab_status_id','lab_status.id')->join('frame_models','frame_models.id','order_head.frame_model_id')->where('order_head.vendor_id','=',$id)->where('order_head.paid',' ')->where('order_head.paid','=','0')->select('order_head.*','patients.patient_name','patients.tray_number','patients.date_of_service','prescription_type.type','frame_models.model_name','tracking_head.freight_cost','tracking_head.tracking_number','lab_status.status_type')->orderBy('order_head.id', 'desc')->get();
                
    //         }
        
    //     }
    // }
    public function index(Request $request)
    {
    	 $orders = DB::table('order_head')->leftjoin('patients','patients.id','order_head.patient_id')->leftjoin('prescription_type','prescription_type.id','order_head.prescription_id')->leftJoin('tracking_head','order_head.tracking_numbers','tracking_head.tracking_number')->leftjoin('lab_status','order_head.lab_status_id','lab_status.id')->leftjoin('frame_models','frame_models.id','order_head.frame_model_id')->select('order_head.*','patients.patient_name','patients.date_of_service','patients.tray_number','prescription_type.type','frame_models.model_name','tracking_head.freight_cost','tracking_head.tracking_number','lab_status.status_type')->orderBy('order_head.id', 'desc')->get();
    	 return view('Orders.test');
    }
}
