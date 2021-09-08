

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\OrderLogsModels;

use Illuminate\Support\Collection;

use App\Models\User;
use App\Models\OrderHeadModel;
use App\Models\VendorNumberModel;
use App\Models\PrescriptionModel;
use DB;
use Auth;
use Carbon\Carbon;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($filter)
    {
         
      
        $orders = new Orders();
        $id = Auth::user()->id;
      
        if(Auth::user()->hasRole('vendor') && $filter == 'notshipped'){
            // $orders= [];
            // $tableONe = Orders::where('shippment_status','Next shippment')->where('vendor_id','=',$id)->exists();
            // if($tableONe == true)
            // {
            // $tableONe = Orders::where('shippment_status','Next shippment')->where('vendor_id','=',$id)->get();
            // array_push($orders,$tableONe);
            // $tableTwo = VendorNumberModel::simplePaginate(20);
            // array_push($orders,$tableTwo);
            // }
            // $orders = Orders::select('orders.*','order_head.*','patients.*','prescription_type.*','frame_models.*')->join('order_head', 'order_head.id', '=','orders.order_head_id')->join('patients','patients.id','order_head.patient_id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->join('frame_models','frame_models.id','order_head.frame_model_id')->where('order_head.tracking_numbers',' ')->where('order_head.order_status','Pending')->where('order_head.vendor_id','=',$id)->get();
            $orders = DB::table('order_head')->join('patients','patients.id','order_head.patient_id')->leftjoin('lab_status','order_head.lab_status_id','lab_status.id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->leftJoin('tracking_head','order_head.tracking_numbers','tracking_head.tracking_number')->join('frame_models','frame_models.id','order_head.frame_model_id')->where('order_head.order_status','Not Shipped')->where('order_head.vendor_id','=',$id)->select('order_head.*','patients.patient_name','patients.date_of_service','patients.tray_number','prescription_type.type','frame_models.model_name','tracking_head.freight_cost','tracking_head.tracking_number','lab_status.status_type')->orderBy('order_head.id', 'desc')->get();

            //$orders = Orders::select('orders.*','shipping_details.*')->join('shipping_details', 'shipping_details.patient_id', '=','orders.patient_id')->where('orders.shippment_status','=','Next shippment')->where('vendor_id','=',$id)->simplePaginate(2);
           
        }
        else{
            if ($filter == 'notshipped') {
                // $orders= [];
                // $tableONe = Orders::where('shippment_status','Next shippment')->get();
                // array_push($orders,$tableONe);
                // $tableTwo = VendorNumberModel::all();
                // array_push($orders,$tableTwo);
                // $orders = Orders::select('orders.*','order_head.*','patients.*','prescription_type.*','frame_models.*')->join('order_head', 'order_head.id', '=','orders.order_head_id')->join('patients','patients.id','order_head.patient_id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->join('frame_models','frame_models.id','order_head.frame_model_id')->where('order_head.tracking_numbers',' ')->get();
                // $orders = Orders::select('orders.*','order_head.*','patients.*','prescription_type.*','frame_models.*')->join('order_head', 'order_head.id', '=','orders.order_head_id')->join('patients','patients.id','order_head.patient_id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->join('frame_models','frame_models.id','order_head.frame_model_id')->where('order_head.tracking_numbers','')->where('order_head.order_status','Pending')->get();
                $orders = DB::table('order_head')->join('patients','patients.id','order_head.patient_id')->leftjoin('lab_status','order_head.lab_status_id','lab_status.id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->leftJoin('tracking_head','order_head.tracking_numbers','tracking_head.tracking_number')->join('frame_models','frame_models.id','order_head.frame_model_id')->where('order_head.order_status','Not Shipped')->select('order_head.*','patients.patient_name','patients.date_of_service','patients.tray_number','prescription_type.type','frame_models.model_name','tracking_head.freight_cost','tracking_head.tracking_number','lab_status.status_type')->orderBy('order_head.id', 'desc')->get();

                //$orders = Orders::select('orders.*','shipping_details.*')->join('shipping_details', 'shipping_details.patient_id', '=','orders.patient_id')->where('orders.shippment_status','Next shippment')->simplePaginate(2);
                
               }
        
        }
       
        
    if(Auth::user()->hasRole('vendor') && $filter == 'shipped'){
            // $orders= [];
            // $tableONe = Orders::where('shippment_status','Shipped')->where('vendor_id','=',$id)->exists();
            // if($tableONe == true)
            // {
            // $tableONe = Orders::where('shippment_status','Shipped')->where('vendor_id','=',$id)->get();
            // array_push($orders,$tableONe);
            // $tableTwo = VendorNumberModel::simplePaginate(20);
            // array_push($orders,$tableTwo);
            //dd($orders);
            $orders = DB::table('order_head')->join('patients','patients.id','order_head.patient_id')->leftjoin('lab_status','order_head.lab_status_id','lab_status.id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->leftJoin('tracking_head','order_head.tracking_numbers','tracking_head.tracking_number')->join('frame_models','frame_models.id','order_head.frame_model_id')->where('order_head.order_status','Shipped')->where('order_head.vendor_id','=',$id)->select('order_head.*','patients.patient_name','patients.tray_number','patients.date_of_service','prescription_type.type','frame_models.model_name','tracking_head.freight_cost','tracking_head.tracking_number','lab_status.status_type')->orderBy('order_head.id', 'desc')->get();

            }
           
            //$orders = Orders::select('orders.*','shipping_details.*')->join('shipping_details', 'shipping_details.patient_id', '=','orders.patient_id')->where('orders.shippment_status','Shipped')->where('orders.vendor_id','=',$id)->simplePaginate(2);
    
    else{
        if($filter == 'shipped'){
            // $orders= [];
            // $tableONe = Orders::where('shippment_status','Shipped')->get();
            // array_push($orders,$tableONe);
            // $tableTwo = VendorNumberModel::all();
            // array_push($orders,$tableTwo);
            //$orders = Orders::select('orders.*','shipping_details.*')->join('shipping_details', 'shipping_details.patient_id','=','orders.patient_id')->where('orders.shippment_status','Shipped')->simplePaginate(2);
           // $orders = Orders::select('orders.*','order_head.*','patients.*','prescription_type.*','frame_models.*')->join('order_head', 'order_head.id', '=','orders.order_head_id')->join('patients','patients.id','order_head.patient_id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->join('frame_models','frame_models.id','order_head.frame_model_id')->where('order_head.tracking_numbers','')->where('order_head.order_status ','Pending')->get();
           $orders = DB::table('order_head')->join('patients','patients.id','order_head.patient_id')->leftjoin('lab_status','order_head.lab_status_id','lab_status.id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->leftJoin('tracking_head','order_head.tracking_numbers','tracking_head.tracking_number')->join('frame_models','frame_models.id','order_head.frame_model_id')->where('order_head.order_status','Shipped')->select('order_head.*','patients.patient_name','patients.date_of_service','patients.tray_number','prescription_type.type','frame_models.model_name','tracking_head.freight_cost','tracking_head.tracking_number','lab_status.status_type')->orderBy('order_head.id', 'desc')->get();

        }
       
    }
    if(Auth::user()->hasRole('vendor') && $filter == 'received'){
            // $orders= [];
            // $tableONe = Orders::where('order_status','Received')->where('vendor_id','=',$id)->exists();
            // if($tableONe == true)
            // {
            // $tableONe = Orders::where('order_status','Received')->where('vendor_id','=',$id)->get();
            // array_push($orders,$tableONe);
            // $tableTwo = VendorNumberModel::all();
            // array_push($orders,$tableTwo);
            // }
        //$orders = Orders::select('orders.*','shipping_details.*')->join('shipping_details', 'shipping_details.patient_id','=','orders.patient_id')->where('orders.order_status','Received')->where('orders.vendor_id','=',$id)->simplePaginate(2);
        // $orders = Orders::select('orders.*','order_head.*','patients.*','prescription_type.*','frame_models.*')->join('order_head', 'order_head.id', '=','orders.order_head_id')->join('patients','patients.id','order_head.patient_id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->join('frame_models','frame_models.id','order_head.frame_model_id')->where('order_head.order_status','Received')->where('order_head.vendor_id','=',$id)->get();
        $orders = DB::table('order_head')->join('patients','patients.id','order_head.patient_id')->leftjoin('lab_status','order_head.lab_status_id','lab_status.id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->leftJoin('tracking_head','order_head.tracking_numbers','tracking_head.tracking_number')->join('frame_models','frame_models.id','order_head.frame_model_id')->where('order_head.order_status','Received')->where('order_head.vendor_id','=',$id)->select('order_head.*','patients.patient_name','patients.tray_number','patients.date_of_service','prescription_type.type','frame_models.model_name','tracking_head.freight_cost','tracking_head.tracking_number','lab_status.status_type')->orderBy('order_head.id', 'desc')->get();

    }
    else{
        if($filter == 'received'){
            // $orders= [];
            // $tableONe = Orders::where('order_status','Received')->get();
            // array_push($orders,$tableONe);
            // $tableTwo = VendorNumberModel::all();
            // array_push($orders,$tableTwo);
            //$orders = Orders::select('orders.*','shipping_details.*')->join('shipping_details', 'shipping_details.patient_id', '=','orders.patient_id')->where('orders.order_status','Received')->simplePaginate(2);
            // $orders = Orders::select('orders.*','order_head.*','patients.*','prescription_type.*','frame_models.*')->join('order_head', 'order_head.id', '=','orders.order_head_id')->join('patients','patients.id','order_head.patient_id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->join('frame_models','frame_models.id','order_head.frame_model_id')->where('order_head.order_status','Received')->get();
            $orders = DB::table('order_head')->join('patients','patients.id','order_head.patient_id')->leftjoin('lab_status','order_head.lab_status_id','lab_status.id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->leftJoin('tracking_head','order_head.tracking_numbers','tracking_head.tracking_number')->join('frame_models','frame_models.id','order_head.frame_model_id')->where('order_head.order_status','Received')->select('order_head.*','patients.patient_name','patients.date_of_service','patients.tray_number','prescription_type.type','frame_models.model_name','tracking_head.freight_cost','tracking_head.tracking_number','lab_status.status_type')->orderBy('order_head.id', 'desc')->get();

            
        }
    }
    if(Auth::user()->hasRole('vendor') && $filter == 'missing'){
            // $orders= [];
            // $tableONe = Orders::where('order_status','Missing')->where('vendor_id','=',$id)->exists();
            // if($tableONe == true)
            // {
            // $tableONe = Orders::where('order_status','Missing')->where('vendor_id','=',$id)->get();
            // array_push($orders,$tableONe);
            // $tableTwo = VendorNumberModel::all();
            // array_push($orders,$tableTwo);
            // }
            // $orders = Orders::select('orders.*','order_head.*','patients.*','prescription_type.*','frame_models.*')->join('order_head', 'order_head.id', '=','orders.order_head_id')->join('patients','patients.id','order_head.patient_id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->join('frame_models','frame_models.id','order_head.frame_model_id')->where('order_head.order_status','Missing')->where('order_head.vendor_id','=',$id)->get();
            $orders = DB::table('order_head')->join('patients','patients.id','order_head.patient_id')->leftjoin('lab_status','order_head.lab_status_id','lab_status.id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->leftJoin('tracking_head','order_head.tracking_numbers','tracking_head.tracking_number')->join('frame_models','frame_models.id','order_head.frame_model_id')->where('order_head.order_status','Missing')->where('order_head.vendor_id','=',$id)->select('order_head.*','patients.patient_name','patients.tray_number','patients.date_of_service','prescription_type.type','frame_models.model_name','tracking_head.freight_cost','tracking_head.tracking_number','lab_status.status_type')->orderBy('order_head.id', 'desc')->get();

        //$orders = Orders::select('orders.*','shipping_details.*')->join('shipping_details', 'shipping_details.patient_id', '=','orders.patient_id')->where('orders.order_status','Missing')->where('orders.vendor_id','=',$id)->simplePaginate(2);
        
    }
    else{
        if($filter == 'missing'){
            // $orders= [];
            // $tableONe = Orders::where('order_status','Missing')->get();
            // array_push($orders,$tableONe);
            // $tableTwo = VendorNumberModel::all();
            // array_push($orders,$tableTwo);
            //$orders = Orders::select('orders.*','shipping_details.*')->join('shipping_details', 'shipping_details.patient_id','orders.patient_id')->where('orders.order_status','Missing')->simplePaginate(2);
            //dd($orders);
            // $orders = Orders::select('orders.*','order_head.*','patients.*','prescription_type.*','frame_models.*')->join('order_head', 'order_head.id', '=','orders.order_head_id')->join('patients','patients.id','order_head.patient_id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->join('frame_models','frame_models.id','order_head.frame_model_id')->where('order_head.order_status','Missing')->get();
            $orders = DB::table('order_head')->join('patients','patients.id','order_head.patient_id')->leftjoin('lab_status','order_head.lab_status_id','lab_status.id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->leftJoin('tracking_head','order_head.tracking_numbers','tracking_head.tracking_number')->join('frame_models','frame_models.id','order_head.frame_model_id')->where('order_head.order_status','Missing')->select('order_head.*','patients.patient_name','patients.date_of_service','patients.tray_number','prescription_type.type','frame_models.model_name','tracking_head.freight_cost','tracking_head.tracking_number','lab_status.status_type')->orderBy('order_head.id', 'desc')->get();

        }
    
    }
        if(Auth::user()->hasRole('vendor') && $filter == 'all')
        {
            
            // $orders= [];
            // $tableONe = Orders::where('vendor_id','=',$id)->exists();
            // // dd($tableONe);
            // if($tableONe == true)
            // {
            //    //dd($tableONe);
            //    $tableONe = Orders::where('vendor_id','=',$id)->get();
            //     array_push($orders,$tableONe);
            //     $tableTwo = VendorNumberModel::all();
            //     array_push($orders,$tableTwo);
                
            //     $table3 = OrderHeadModel::all();
            //     array_push($orders,$table3);

            // }
            //$orders = Orders::select('orders.*','order_head.*','patients.*','prescription_type.*','frame_models.*')->join('order_head', 'order_head.id', '=','orders.order_head_id')->join('patients','patients.id','order_head.patient_id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->join('frame_models','frame_models.id','order_head.frame_model_id')->where('order_head.vendor_id','=',$id)->get();
            $orders = DB::table('order_head')->join('patients','patients.id','order_head.patient_id')->leftjoin('lab_status','order_head.lab_status_id','lab_status.id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->leftJoin('tracking_head','order_head.tracking_numbers','tracking_head.tracking_number')->join('frame_models','frame_models.id','order_head.frame_model_id')->where('order_head.vendor_id','=',$id)->select('order_head.*','patients.patient_name','patients.date_of_service','patients.tray_number','prescription_type.type','frame_models.model_name','tracking_head.freight_cost','tracking_head.tracking_number','lab_status.status_type')->orderBy('order_head.id', 'desc')->get();
           // dd($orders);

         


        //$orders = Orders::select('orders.*','shipping_details.*')->join('shipping_details', 'shipping_details.patient_id', '=','orders.patient_id');
        }
        else{
            if( $filter == 'all'){
                // $orders = [];
                // $tableONe = Orders::all();
                // array_push($orders,$tableONe);
                // $tableTwo = VendorNumberModel::all();
                // array_push($orders,$tableTwo);
                
                // $table3 = OrderHeadModel::all();
                // array_push($orders,$table3);
                
                //dd($res);
            // $orders = Orders::select('orders.*','order_head.*','patients.*','prescription_type.*','frame_models.*')->join('order_head', 'order_head.id', '=','orders.order_head_id')->join('patients','patients.id','order_head.patient_id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->join('frame_models','frame_models.id','order_head.frame_model_id')->get();
            $orders = DB::table('order_head')->leftjoin('patients','patients.id','order_head.patient_id')->leftjoin('prescription_type','prescription_type.id','order_head.prescription_id')->leftJoin('tracking_head','order_head.tracking_numbers','tracking_head.tracking_number')->leftjoin('lab_status','order_head.lab_status_id','lab_status.id')->leftjoin('frame_models','frame_models.id','order_head.frame_model_id')->select('order_head.*','patients.patient_name','patients.date_of_service','patients.tray_number','prescription_type.type','frame_models.model_name','tracking_head.freight_cost','tracking_head.tracking_number','lab_status.status_type')->orderBy('order_head.id', 'desc')->get();
            //dd($orders);
            }
        }
        
        if(Auth::user()->hasRole('vendor') && $filter == 'priority'){
            // $orders= [];
            // $tableONe = Orders::where('vendor_id','=',$id)->exists();
            // if($tableONe == true)
            // {
            // $tableONe = Orders::where('vendor_id','=',$id)->get();
            // array_push($orders,$tableONe);
            // $tableTwo = VendorNumberModel::all();
            // array_push($orders,$tableTwo);
            $orders = DB::table('order_head')->leftjoin('patients','patients.id','order_head.patient_id')->leftjoin('prescription_type','prescription_type.id','order_head.prescription_id')->leftJoin('tracking_head','order_head.tracking_numbers','tracking_head.tracking_number')->leftjoin('lab_status','order_head.lab_status_id','lab_status.id')->leftjoin('frame_models','frame_models.id','order_head.frame_model_id')->where('order_head.vendor_id','=',$id)->select('order_head.*','patients.patient_name','patients.tray_number','patients.date_of_service','prescription_type.type','frame_models.model_name','tracking_head.freight_cost','tracking_head.tracking_number','lab_status.status_type')->orderBy('order_head.id', 'desc')->get();
            return view('vendors.next_periority_orders',compact('orders'));

            }
            
            //$orders = Orders::select('orders.*','shipping_details.*')->join('shipping_details', 'shipping_details.patient_id', '=','orders.patient_id')->where('orders.vendor_id','=',$id)->simplePaginate(20);
        else{
            if ($filter == 'priority') {
                // $orders= [];
                // $tableONe = Orders::all();
                // array_push($orders,$tableONe);
                // $tableTwo = VendorNumberModel::all();
                // array_push($orders,$tableTwo);
                //$orders = Orders::select('orders.*','shipping_details.*')->join('shipping_details', 'shipping_details.patient_id','orders.patient_id')->simplePaginate(2);
                $orders = DB::table('order_head')->join('patients','patients.id','order_head.patient_id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->leftJoin('tracking_head','order_head.tracking_numbers','tracking_head.tracking_number')->join('lab_status','order_head.lab_status_id','lab_status.id')->join('frame_models','frame_models.id','order_head.frame_model_id')->select('order_head.*','patients.patient_name','patients.date_of_service','patients.tray_number','prescription_type.type','frame_models.model_name','tracking_head.freight_cost','tracking_head.tracking_number','lab_status.status_type')->orderBy('order_head.id', 'desc')->get();

                return view('vendors.next_periority_orders',compact('orders'));

               }
               
        }
        if ($filter == 'unpaid') {
            $orders = DB::table('order_head')->join('patients','patients.id','order_head.patient_id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->leftJoin('tracking_head','order_head.tracking_numbers','tracking_head.tracking_number')->join('lab_status','order_head.lab_status_id','lab_status.id')->join('frame_models','frame_models.id','order_head.frame_model_id')->where('order_head.paid',' ')->where('order_head.paid','=','0')->select('order_head.*','patients.patient_name','patients.date_of_service','patients.tray_number','prescription_type.type','frame_models.model_name','tracking_head.freight_cost','tracking_head.tracking_number','lab_status.status_type')->orderBy('order_head.id', 'desc')->get();

        }else{
            if (Auth::user()->hasRole('vendor') && $filter == 'unpaid') {
                $orders = DB::table('order_head')->join('patients','patients.id','order_head.patient_id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->leftJoin('tracking_head','order_head.tracking_numbers','tracking_head.tracking_number')->join('lab_status','order_head.lab_status_id','lab_status.id')->join('frame_models','frame_models.id','order_head.frame_model_id')->where('order_head.vendor_id','=',$id)->where('order_head.paid',' ')->where('order_head.paid','=','0')->select('order_head.*','patients.patient_name','patients.tray_number','patients.date_of_service','prescription_type.type','frame_models.model_name','tracking_head.freight_cost','tracking_head.tracking_number','lab_status.status_type')->orderBy('order_head.id', 'desc')->get();
                
            }
        
        }
       
      
        return view('Orders.orderentry')->with('orders',$orders);
      
    }
    
    public function orderFilter(Request $request)
    {
        // $orders= [];
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $orders = DB::table('order_head')->join('patients','patients.id','order_head.patient_id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->leftJoin('tracking_head','order_head.tracking_numbers','tracking_head.tracking_number')->join('lab_status','order_head.lab_status_id','lab_status.id')->join('frame_models','frame_models.id','order_head.frame_model_id')->whereBetween('patients.date_of_service', [$start_date, $end_date])->select('order_head.*','patients.patient_name','patients.date_of_service','patients.tray_number','prescription_type.type','frame_models.model_name','tracking_head.freight_cost','tracking_head.tracking_number','lab_status.status_type')->orderBy('order_head.id', 'desc')->get();
        // dd($orders);          
  
          return view('Orders.orderentry',compact('orders'));
        // //dd($end_date);
        // $tableONe = OrderHeadModel::whereBetween(DB::raw('DATE(date_of_service)'), [$start_date, $end_date])->pluck('id')->toArray();
        // $collection = collect([$tableONe]);
        // dd($tableONe);
        //$id_list = [5,9,13]; 
        //dd($id_list);
        //dd($id_str);

        // $date_id_1 = $tableONe->id;
        // $date_id_2 = $tableONe[0]->id;
        // //dd($date_id_2);
        //array_push($orders,$tableONe);
        // $tableTwo ='';
        // if (is_array($tableONe)) {
        //     foreach($collection as $id){
        //     //$id_str = implode(',', $tableONe);

        //     //echo $id_str;
        //         $tableTwo = Orders::whereIn('date_id',$id)->get();
               

        //         //print_r($tableTwo);
        //         //dd($tableTwo);
        //         array_push($orders,$tableTwo);
   
            

              
          
           

       
         //$orders =  Orders::select('orders.*','orders_head.*')->join('orders_head', 'orders_head.id', '=','orders.patient_id')->whereBetween('orders_head.date_of_service', [$start_date, $end_date])->get();
        //$orders = Orders::all();
        //dd($orders);

        
        
    }
    public function priorityOrders($priority)
    {
        
        //dd($id);
        if(Auth::user()->hasRole('vendor') && $filter == 'priority'){
            $orders = Orders::select('orders.*','order_head.*')->join('order_head', 'order_head.id', '=','orders.order_head_id')->where('order_head.vendor_id','=',$id)->orderBy('order_head.id', 'desc')->get();
           echo 'in';
        }
        else{
            if ($filter == 'priority') {
                $orders = Orders::select('orders.*','order_head.*')->join('order_head', 'order_head.id','orders.order_head_id')->orderBy('order_head.id', 'desc')->get();
                echo 'in';
               }
               
        }
        return view('vendors.next_periority_orders',compact('orders'));
        
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Orders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $errMsg = '';
       try {
        $user_id = Auth::user()->id;
        $date = date("Y-m-d h:i:s");
        
        $order_head_id = OrderHeadModel::create([
        'date_of_service' => $request->date_of_service,
        'patient_name' => $request->patient_name,
        'tray_number'=>$request->tray_number,
        ])->id;
        //$vendor_name = $request->vendor_name;
        $insert_query = VendorNumberModel::create([
        'order_status'=> 'Not Shipped',
        'clinic_id' => $request->clinic_id,
        'vendor_id' => $request->vendor_name,
        'lab_status_id'=>'1',
        'patient_id' => $order_head_id,
        'lens_order_number'=>$request->order_number,
        'frame_order_number' => $request->frame_order_number,
        'staff_notes'=> $request->staff_notes,
        'frame_model_id'=>$request->frame_model_id,
        'frame_status'=> 'Not Shipped',
        'prescription_id' => $request->prescription_id,
      
        ])->id;
      
        Orders::create([
            'eye' => 'R',
            'sph' => $request->r_sph,
            'cyl' => $request->r_cyl,
            'axis' => $request->r_axis,
            'add' => $request->r_add,
            'pd' => $request->r_pd,
            'ph' => $request->r_ph,
            'a' => $request->r_a,
            'b' => $request->r_b,
            'dbl' => $request->r_dbl,
            'ed' => $request->r_ed,   
            'coating_1_id' => $request->r_coating_1_id,
            'coating_2_id' => $request->r_coating_2_id,
            'coating_3_id' => $request->r_coating_3_id,
            'coating_4_id' => $request->r_coating_4_id,
            'lens_type_id' => $request->r_lens_type_id,
            'order_head_id'=> $insert_query,
        ]);
        Orders::create([
            'eye' => 'L',
            'sph' => $request->l_sph,
            'cyl' => $request->l_cyl,
            'axis' => $request->l_axis,
            'add' => $request->l_add,
            'pd' => $request->l_pd,
            'ph' => $request->l_ph,
            'a' => $request->l_a,
            'b' => $request->l_b,
            'dbl' => $request->l_dbl,
            'ed' => $request->l_ed,
            'coating_1_id' => $request->l_coating_1_id,
            'coating_2_id' => $request->l_coating_2_id,
            'coating_3_id' => $request->l_coating_3_id,
            'coating_4_id' => $request->l_coating_4_id,
            'lens_type_id' => $request->l_lens_type_id,
            'order_head_id'=> $insert_query,
        ]);
        OrderLogsModels::create([
            'action'=>'insert',
            'order_head_id'=> $insert_query,
            'created_at' => $date,
            'created_by'=>$user_id,
        ]);
        
        
        return redirect('/orders-list/all');
          
       } catch (\Throwable $th) {
        //return route()->redirect()->with($errMsg' => "An Error occured while adding data");
        dd($th);
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($patient_id)
    {
        //dd($patient_id);
        //$edit_order = Orders::find($patient_id);
        
        //$id=$edit_order->order_head_id;
        //dd($id);
        
        $order_logs = OrderLogsModels::select('order_logs.*','users.name')->join('users','users.id','order_logs.created_by')->where('order_logs.order_head_id','=',$patient_id)->get();
        
        $order_data = Orders::select('orders.*','lens_type.lenses','frame_models.model_name','frame_brands.brand_name')->join('order_head','order_head.id','orders.order_head_id')->join('lens_type','lens_type.id','orders.lens_type_id')->join('frame_models','frame_models.id','order_head.frame_model_id')->join('frame_brands','frame_models.brand_id','frame_brands.id')->where('order_head_id','=',$patient_id)->get();
        $id = $order_data[0]->order_head_id;
        //dd($id);
        $edit_order_head = VendorNumberModel::where('id','=',$id)->get();  
        //dd($edit_order_head);
        $p_id = $edit_order_head[0]->patient_id;
        $vendor_id = $edit_order_head[0]->vendor_id;
        //dd($vendor_id);
        $vendor_name = User::where('id','=',$vendor_id)->get();
        
        $prescription_id = $edit_order_head[0]->prescription_id;
        //dd($prescription_id);
        $get_prescription = PrescriptionModel::where('id','=',$prescription_id)->get();
        
        $patient_data = OrderHeadModel::where('id','=',$p_id)->get();
          
        return view('Orders.show')->with('order_data',$order_data)->with('order_logs',$order_logs)->with('edit_order_head',$edit_order_head)->with('patient_data',$patient_data)->with('get_prescription',$get_prescription)->with('vendor_name',$vendor_name);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($patient_id) 
    { 
        //dd($patient_id);
        //$edit_order = Orders::find($patient_id);
        
        //$id=$edit_order->order_head_id;
        $order_data = Orders::where('order_head_id','=',$patient_id)->get();
        //dd($order_data);
        $id = $order_data[0]->order_head_id;
       // dd($id);
        //$edit_order_head = VendorNumberModel::where('id','=',$id)->get();
        $edit_order_head = VendorNumberModel::select('order_head.*','frame_models.brand_id','frame_brands.brand_name','manufacturer.manufacturer_name')->join('frame_models','order_head.frame_model_id','frame_models.id')->join('frame_brands','frame_models.brand_id','frame_brands.id')->join('manufacturer','manufacturer.id','frame_brands.manufacturer_id')->where('order_head.id','=',$id)->get();

        //dd($edit_order_head);
        $p_id = $edit_order_head[0]->patient_id;
        $prescription_id = $edit_order_head[0]->prescription_id;
        //dd($prescription_id);
        $get_prescription = PrescriptionModel::where('id','=',$prescription_id)->get();
        
        $patient_data = OrderHeadModel::where('id','=',$p_id)->get();
            //dd($patient_data);
       //dd($p_id);
        return view('Orders.edit')->with('order_data',$order_data)->with('edit_order_head',$edit_order_head)->with('patient_data',$patient_data)->with('get_prescription',$get_prescription);
    }
    
    public function frame_modelstatus($id,$frame_status)
    {
        try {
                   
            print_r($frame_status);
        print_r($id);
            $order_query = DB::table('order_head')->where('id','=',$id)->update(['frame_status' => $frame_status]);
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
        } 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id,$order_status)
    {       
                try {
                   
                    //$id = $order->patient_id;
                    //dd($id);
                //print_r($order_status);
                //$frame_status = $request->frame_status;
                        $order_query=DB::table('order_head')->where('id','=',$id)->update(['order_status' => $order_status]);
                        $order_query=VendorNumberModel::where('id','=',$id)->where('order_status','Received')->orWhere('frame_status','Received')->update(['lab_status_id' => '2']);
                        $order=VendorNumberModel::where('id','=',$id)->where('order_status','Received')->where('frame_status','Received')->update(['lab_status_id' => '3']);
                } catch (\Throwable $th) {
                    //throw $th;
                    dd($th);
                } 

              
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order_log = DB::table('order_logs')->where('order_head_id','=',$id)->delete();
       
            DB::table('orders')->where('order_head_id','=',$id)->delete();
            DB::table('order_head')->where('id','=',$id)->delete();

            return 1;
        
       
       
        //$order->delete();
        return redirect()->route('orders.index')->with('error','Data has deleted successfully!');
    }
    
    public function detail($filter)
    {
        $orders = new Orders();
        $id = Auth::user()->id;
      
        if(Auth::user()->hasRole('vendor') && $filter == 'notshipped'){
            // $orders= [];
            // $tableONe = Orders::where('shippment_status','Next shippment')->where('vendor_id','=',$id)->exists();
            // if($tableONe == true)
            // {
            // $tableONe = Orders::where('shippment_status','Next shippment')->where('vendor_id','=',$id)->get();
            // array_push($orders,$tableONe);
            // $tableTwo = VendorNumberModel::simplePaginate(20);
            // array_push($orders,$tableTwo);
            // }
            // $orders = Orders::select('orders.*','order_head.*','patients.*','prescription_type.*','frame_models.*')->join('order_head', 'order_head.id', '=','orders.order_head_id')->join('patients','patients.id','order_head.patient_id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->join('frame_models','frame_models.id','order_head.frame_model_id')->where('order_head.tracking_numbers',' ')->where('order_head.order_status','Pending')->where('order_head.vendor_id','=',$id)->get();
            $orders = Orders::select('orders.*','order_head.tracking_numbers','order_head.order_status','patients.patient_name','patients.date_of_service','patients.tray_number','prescription_type.type','frame_models.model_name','lens_type.lenses')->join('order_head','orders.order_head_id','order_head.id')->join('lens_type','lens_type.id','orders.lens_type_id')->join('patients','patients.id','order_head.patient_id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->join('frame_models','frame_models.id','order_head.frame_model_id')->where('order_head.order_status','Not Shipped')->where('order_head.vendor_id','=',$id)->orderBy('orders.id', 'desc')->get();

            //$orders = Orders::select('orders.*','shipping_details.*')->join('shipping_details', 'shipping_details.patient_id', '=','orders.patient_id')->where('orders.shippment_status','=','Next shippment')->where('vendor_id','=',$id)->simplePaginate(2);
           
        }
        else{
            if ($filter == 'notshipped') {
                // $orders= [];
                // $tableONe = Orders::where('shippment_status','Next shippment')->get();
                // array_push($orders,$tableONe);
                // $tableTwo = VendorNumberModel::all();
                // array_push($orders,$tableTwo);
                // $orders = Orders::select('orders.*','order_head.*','patients.*','prescription_type.*','frame_models.*')->join('order_head', 'order_head.id', '=','orders.order_head_id')->join('patients','patients.id','order_head.patient_id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->join('frame_models','frame_models.id','order_head.frame_model_id')->where('order_head.tracking_numbers',' ')->get();
                // $orders = Orders::select('orders.*','order_head.*','patients.*','prescription_type.*','frame_models.*')->join('order_head', 'order_head.id', '=','orders.order_head_id')->join('patients','patients.id','order_head.patient_id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->join('frame_models','frame_models.id','order_head.frame_model_id')->where('order_head.tracking_numbers','')->where('order_head.order_status','Pending')->get();
                $orders = Orders::select('orders.*','order_head.tracking_numbers','order_head.order_status','patients.patient_name','patients.date_of_service','patients.tray_number','prescription_type.type','frame_models.model_name','lens_type.lenses')->join('order_head','orders.order_head_id','order_head.id')->join('lens_type','lens_type.id','orders.lens_type_id')->join('patients','patients.id','order_head.patient_id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->join('frame_models','frame_models.id','order_head.frame_model_id')->where('order_head.order_status','Not Shipped')->orderBy('orders.id', 'desc')->get();
                   // dd($orders);
                //$orders = Orders::select('orders.*','shipping_details.*')->join('shipping_details', 'shipping_details.patient_id', '=','orders.patient_id')->where('orders.shippment_status','Next shippment')->simplePaginate(2);
                
               }
        
        }
       
        
    if(Auth::user()->hasRole('vendor') && $filter == 'shipped'){
            // $orders= [];
            // $tableONe = Orders::where('shippment_status','Shipped')->where('vendor_id','=',$id)->exists();
            // if($tableONe == true)
            // {
            // $tableONe = Orders::where('shippment_status','Shipped')->where('vendor_id','=',$id)->get();
            // array_push($orders,$tableONe);
            // $tableTwo = VendorNumberModel::simplePaginate(20);
            // array_push($orders,$tableTwo);
            //dd($orders);
            $orders = Orders::select('orders.*','order_head.tracking_numbers','order_head.order_status','patients.patient_name','patients.date_of_service','patients.tray_number','prescription_type.type','frame_models.model_name','lens_type.lenses')->join('order_head','orders.order_head_id','order_head.id')->join('lens_type','lens_type.id','orders.lens_type_id')->join('patients','patients.id','order_head.patient_id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->join('frame_models','frame_models.id','order_head.frame_model_id')->where('order_head.order_status','Shipped')->where('order_head.vendor_id','=',$id)->orderBy('orders.id', 'desc')->get();

            }
           
            //$orders = Orders::select('orders.*','shipping_details.*')->join('shipping_details', 'shipping_details.patient_id', '=','orders.patient_id')->where('orders.shippment_status','Shipped')->where('orders.vendor_id','=',$id)->simplePaginate(2);
    
    else{
        if($filter == 'shipped'){
            // $orders= [];
            // $tableONe = Orders::where('shippment_status','Shipped')->get();
            // array_push($orders,$tableONe);
            // $tableTwo = VendorNumberModel::all();
            // array_push($orders,$tableTwo);
            //$orders = Orders::select('orders.*','shipping_details.*')->join('shipping_details', 'shipping_details.patient_id','=','orders.patient_id')->where('orders.shippment_status','Shipped')->simplePaginate(2);
           // $orders = Orders::select('orders.*','order_head.*','patients.*','prescription_type.*','frame_models.*')->join('order_head', 'order_head.id', '=','orders.order_head_id')->join('patients','patients.id','order_head.patient_id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->join('frame_models','frame_models.id','order_head.frame_model_id')->where('order_head.tracking_numbers','')->where('order_head.order_status ','Pending')->get();
           $orders = Orders::select('orders.*','order_head.tracking_numbers','order_head.order_status','order_head.order_status','patients.patient_name','patients.tray_number','patients.date_of_service','prescription_type.type','frame_models.model_name','lens_type.lenses')->join('order_head','orders.order_head_id','order_head.id')->join('lens_type','lens_type.id','orders.lens_type_id')->join('patients','patients.id','order_head.patient_id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->join('frame_models','frame_models.id','order_head.frame_model_id')->where('order_head.order_status','Shipped')->orderBy('orders.id', 'desc')->get();

        }
       
    }
    if(Auth::user()->hasRole('vendor') && $filter == 'received'){
            // $orders= [];
            // $tableONe = Orders::where('order_status','Received')->where('vendor_id','=',$id)->exists();
            // if($tableONe == true)
            // {
            // $tableONe = Orders::where('order_status','Received')->where('vendor_id','=',$id)->get();
            // array_push($orders,$tableONe);
            // $tableTwo = VendorNumberModel::all();
            // array_push($orders,$tableTwo);
            // }
        //$orders = Orders::select('orders.*','shipping_details.*')->join('shipping_details', 'shipping_details.patient_id','=','orders.patient_id')->where('orders.order_status','Received')->where('orders.vendor_id','=',$id)->simplePaginate(2);
        // $orders = Orders::select('orders.*','order_head.*','patients.*','prescription_type.*','frame_models.*')->join('order_head', 'order_head.id', '=','orders.order_head_id')->join('patients','patients.id','order_head.patient_id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->join('frame_models','frame_models.id','order_head.frame_model_id')->where('order_head.order_status','Received')->where('order_head.vendor_id','=',$id)->get();
        $orders = Orders::select('orders.*','order_head.tracking_numbers','order_head.order_status','patients.patient_name','patients.date_of_service','patients.tray_number','prescription_type.type','frame_models.model_name','lens_type.lenses')->join('order_head','orders.order_head_id','order_head.id')->join('lens_type','lens_type.id','orders.lens_type_id')->join('patients','patients.id','order_head.patient_id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->join('frame_models','frame_models.id','order_head.frame_model_id')->where('order_head.order_status','Received')->where('order_head.vendor_id','=',$id)->orderBy('orders.id', 'desc')->get();

    }
    else{
        if($filter == 'received'){
            // $orders= [];
            // $tableONe = Orders::where('order_status','Received')->get();
            // array_push($orders,$tableONe);
            // $tableTwo = VendorNumberModel::all();
            // array_push($orders,$tableTwo);
            //$orders = Orders::select('orders.*','shipping_details.*')->join('shipping_details', 'shipping_details.patient_id', '=','orders.patient_id')->where('orders.order_status','Received')->simplePaginate(2);
            // $orders = Orders::select('orders.*','order_head.*','patients.*','prescription_type.*','frame_models.*')->join('order_head', 'order_head.id', '=','orders.order_head_id')->join('patients','patients.id','order_head.patient_id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->join('frame_models','frame_models.id','order_head.frame_model_id')->where('order_head.order_status','Received')->get();
            $orders = Orders::select('orders.*','order_head.tracking_numbers','order_head.order_status','patients.patient_name','patients.date_of_service','patients.tray_number','prescription_type.type','frame_models.model_name','lens_type.lenses')->join('order_head','orders.order_head_id','order_head.id')->join('lens_type','lens_type.id','orders.lens_type_id')->join('patients','patients.id','order_head.patient_id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->join('frame_models','frame_models.id','order_head.frame_model_id')->where('order_head.order_status','Received')->orderBy('orders.id', 'desc')->get();

            
        }
    }
    if(Auth::user()->hasRole('vendor') && $filter == 'missing'){
            // $orders= [];
            // $tableONe = Orders::where('order_status','Missing')->where('vendor_id','=',$id)->exists();
            // if($tableONe == true)
            // {
            // $tableONe = Orders::where('order_status','Missing')->where('vendor_id','=',$id)->get();
            // array_push($orders,$tableONe);
            // $tableTwo = VendorNumberModel::all();
            // array_push($orders,$tableTwo);
            // }
            // $orders = Orders::select('orders.*','order_head.*','patients.*','prescription_type.*','frame_models.*')->join('order_head', 'order_head.id', '=','orders.order_head_id')->join('patients','patients.id','order_head.patient_id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->join('frame_models','frame_models.id','order_head.frame_model_id')->where('order_head.order_status','Missing')->where('order_head.vendor_id','=',$id)->get();
            $orders = Orders::select('orders.*','order_head.tracking_numbers','order_head.order_status','patients.patient_name','patients.date_of_service','patients.tray_number','prescription_type.type','frame_models.model_name','lens_type.lenses')->join('order_head','orders.order_head_id','order_head.id')->join('lens_type','lens_type.id','orders.lens_type_id')->join('patients','patients.id','order_head.patient_id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->join('frame_models','frame_models.id','order_head.frame_model_id')->where('order_head.order_status','Missing')->where('order_head.vendor_id','=',$id)->orderBy('orders.id', 'desc')->get();

        //$orders = Orders::select('orders.*','shipping_details.*')->join('shipping_details', 'shipping_details.patient_id', '=','orders.patient_id')->where('orders.order_status','Missing')->where('orders.vendor_id','=',$id)->simplePaginate(2);
        
    }
    else{
        if($filter == 'missing'){
            // $orders= [];
            // $tableONe = Orders::where('order_status','Missing')->get();
            // array_push($orders,$tableONe);
            // $tableTwo = VendorNumberModel::all();
            // array_push($orders,$tableTwo);
            //$orders = Orders::select('orders.*','shipping_details.*')->join('shipping_details', 'shipping_details.patient_id','orders.patient_id')->where('orders.order_status','Missing')->simplePaginate(2);
            //dd($orders);
            // $orders = Orders::select('orders.*','order_head.*','patients.*','prescription_type.*','frame_models.*')->join('order_head', 'order_head.id', '=','orders.order_head_id')->join('patients','patients.id','order_head.patient_id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->join('frame_models','frame_models.id','order_head.frame_model_id')->where('order_head.order_status','Missing')->get();
            $orders = Orders::select('orders.*','order_head.tracking_numbers','order_head.order_status','patients.patient_name','patients.date_of_service','patients.tray_number','prescription_type.type','frame_models.model_name','lens_type.lenses')->join('order_head','orders.order_head_id','order_head.id')->join('lens_type','lens_type.id','orders.lens_type_id')->join('patients','patients.id','order_head.patient_id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->join('frame_models','frame_models.id','order_head.frame_model_id')->where('order_head.order_status','Missing')->orderBy('orders.id', 'desc')->get();

        }
    
    }
        if(Auth::user()->hasRole('vendor') && $filter == 'all')
        {
            
            // $orders= [];
            // $tableONe = Orders::where('vendor_id','=',$id)->exists();
            // // dd($tableONe);
            // if($tableONe == true)
            // {
            //    //dd($tableONe);
            //    $tableONe = Orders::where('vendor_id','=',$id)->get();
            //     array_push($orders,$tableONe);
            //     $tableTwo = VendorNumberModel::all();
            //     array_push($orders,$tableTwo);
                
            //     $table3 = OrderHeadModel::all();
            //     array_push($orders,$table3);

            // }
            //$orders = Orders::select('orders.*','order_head.*','patients.*','prescription_type.*','frame_models.*')->join('order_head', 'order_head.id', '=','orders.order_head_id')->join('patients','patients.id','order_head.patient_id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->join('frame_models','frame_models.id','order_head.frame_model_id')->where('order_head.vendor_id','=',$id)->get();
            $orders = Orders::select('orders.*','order_head.tracking_numbers','order_head.order_status','patients.patient_name','patients.date_of_service','patients.tray_number','prescription_type.type','frame_models.model_name','lens_type.lenses')->join('order_head','orders.order_head_id','order_head.id')->join('lens_type','lens_type.id','orders.lens_type_id')->join('patients','patients.id','order_head.patient_id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->join('frame_models','frame_models.id','order_head.frame_model_id')->where('order_head.vendor_id','=',$id)->orderBy('orders.id', 'desc')->get();

         


        //$orders = Orders::select('orders.*','shipping_details.*')->join('shipping_details', 'shipping_details.patient_id', '=','orders.patient_id');
        }
        else{
            if( $filter == 'all'){
                // $orders = [];
                // $tableONe = Orders::all();
                // array_push($orders,$tableONe);
                // $tableTwo = VendorNumberModel::all();
                // array_push($orders,$tableTwo);
                
                // $table3 = OrderHeadModel::all();
                // array_push($orders,$table3);
                
                //dd($res);
            // $orders = Orders::select('orders.*','order_head.*','patients.*','prescription_type.*','frame_models.*')->join('order_head', 'order_head.id', '=','orders.order_head_id')->join('patients','patients.id','order_head.patient_id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->join('frame_models','frame_models.id','order_head.frame_model_id')->get();
            $orders = Orders::select('orders.*','order_head.tracking_numbers','order_head.order_status','patients.patient_name','patients.date_of_service','patients.tray_number','prescription_type.type','frame_models.model_name','lens_type.lenses')->join('order_head','orders.order_head_id','order_head.id')->join('lens_type','lens_type.id','orders.lens_type_id')->join('patients','patients.id','order_head.patient_id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->join('frame_models','frame_models.id','order_head.frame_model_id')->orderBy('orders.id', 'desc')->get();
            //dd($orders);
            }
        }
        
        if(Auth::user()->hasRole('vendor') && $filter == 'priority'){
            // $orders= [];
            // $tableONe = Orders::where('vendor_id','=',$id)->exists();
            // if($tableONe == true)
            // {
            // $tableONe = Orders::where('vendor_id','=',$id)->get();
            // array_push($orders,$tableONe);
            // $tableTwo = VendorNumberModel::all();
            // array_push($orders,$tableTwo);
            // $orders = DB::table('order_head')->join('patients','patients.id','order_head.patient_id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->join('frame_models','frame_models.id','order_head.frame_model_id')->where('order_head.vendor_id','=',$id)->select('order_head.*','patients.patient_name','patients.date_of_service','prescription_type.type','frame_models.model_name')->get();
            $orders = Orders::select('orders.*','order_head.tracking_numbers','order_head.order_status','patients.patient_name','patients.date_of_service','patients.tray_number','prescription_type.type','frame_models.model_name','lens_type.lenses')->join('order_head','orders.order_head_id','order_head.id')->join('lens_type','lens_type.id','orders.lens_type_id')->join('patients','patients.id','order_head.patient_id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->join('frame_models','frame_models.id','order_head.frame_model_id')->where('order_head.vendor_id','=',$id)->orderBy('orders.id', 'desc')->get();

            return view('vendors.detail_periority',compact('orders'));

            }
            
            //$orders = Orders::select('orders.*','shipping_details.*')->join('shipping_details', 'shipping_details.patient_id', '=','orders.patient_id')->where('orders.vendor_id','=',$id)->simplePaginate(20);
        else{
            if ($filter == 'priority') {
                // $orders= [];
                // $tableONe = Orders::all();
                // array_push($orders,$tableONe);
                // $tableTwo = VendorNumberModel::all();
                // array_push($orders,$tableTwo);
                //$orders = Orders::select('orders.*','shipping_details.*')->join('shipping_details', 'shipping_details.patient_id','orders.patient_id')->simplePaginate(2);
                $orders = Orders::select('orders.*','order_head.tracking_numbers','order_head.order_status','patients.patient_name','patients.date_of_service','patients.tray_number','prescription_type.type','frame_models.model_name','lens_type.lenses')->join('order_head','orders.order_head_id','order_head.id')->join('lens_type','lens_type.id','orders.lens_type_id')->join('patients','patients.id','order_head.patient_id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->join('frame_models','frame_models.id','order_head.frame_model_id')->orderBy('orders.id', 'desc')->get();

                return view('vendors.detail_periority',compact('orders'));

               }
               
        }
        if ($filter == 'unpaid') {
            $orders = Orders::select('orders.*','order_head.tracking_numbers','order_head.order_status','patients.patient_name','patients.date_of_service','patients.tray_number','prescription_type.type','frame_models.model_name','lens_type.lenses')->join('order_head','orders.order_head_id','order_head.id')->join('lens_type','lens_type.id','orders.lens_type_id')->join('patients','patients.id','order_head.patient_id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->join('frame_models','frame_models.id','order_head.frame_model_id')->where('order_head.paid','')->orderBy('orders.id', 'desc')->get();

        }else{
            if (Auth::user()->hasRole('vendor') && $filter == 'unpaid') {
                $orders = Orders::select('orders.*','order_head.tracking_numbers','order_head.order_status','patients.patient_name','patients.date_of_service','patients.tray_number','prescription_type.type','frame_models.model_name','lens_type.lenses')->join('order_head','orders.order_head_id','order_head.id')->join('lens_type','lens_type.id','orders.lens_type_id')->join('patients','patients.id','order_head.patient_id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->join('frame_models','frame_models.id','order_head.frame_model_id')->where('order_head.paid','')->where('order_head.vendor_id','=',$id)->orderBy('orders.id', 'desc')->get();
                
            }
        
        }
       
      
        return view('Orders.details')->with('orders',$orders);
      
    }
    
    public function print(Request $request)
    {
        $print_id = $request->print_id;
        //$patient_data = array();
            
        //dd($print_id);
       $p_id = explode(',', $print_id);
     // dd($p_id);
        $data_id = array_shift($p_id);
        //dd($data_id);
            if ($data_id == 'on') {
                if(is_array($p_id)){
                    $patient_data = VendorNumberModel::select('order_head.*','patients.patient_name','patients.date_of_service','patients.tray_number','frame_models.model_name','frame_brands.brand_name')->join('patients','patients.id','order_head.patient_id')->join('frame_models','order_head.frame_model_id','frame_models.id')->join('frame_brands','frame_brands.id','frame_models.brand_id')->whereIn('order_head.id',$p_id)->get();

                //     foreach($p_id as $id){
                //        // echo($id);
                //        // echo("<br>");
                //         //dd($patient_data);
                      
                 
                // }
                //dd($patient_data);
                   return view('Orders.print_lable',compact('patient_data'));     
                }
            } else{
                $print_id = $request->input('print_id');
            $p_id = explode(',', $print_id);
        if(is_array($p_id)){
         //dd(($p_id));
         $patient_data = VendorNumberModel::select('order_head.*','patients.patient_name','patients.date_of_service','patients.tray_number','frame_models.model_name','frame_brands.brand_name')->join('patients','patients.id','order_head.patient_id')->join('frame_models','order_head.frame_model_id','frame_models.id')->join('frame_brands','frame_brands.id','frame_models.brand_id')->whereIn('order_head.id',$p_id)->get();

            // foreach($p_id as $id){
            //     $patient_data += VendorNumberModel::select('order_head.*','patients.patient_name','patients.tray_number','frame_models.model_name')->join('patients','patients.id','order_head.patient_id')->join('frame_models','order_head.frame_model_id','frame_models.id')->whereIn('order_head.id','=',[$p_id])->get();
            //     //dd($patient_data);
            //     //return 1;
            // }
        }
        //dd($patient_data);
        return view('Orders.print_lable',compact('patient_data'));     

            }
    }
    public function CYLSPHFilter(Request $request)
    {
        $orders = new Orders();
        $lens_type_id = $request->lenses;
        $coating = $request->coating;
        $from_sph = $request->from_sph;
        $to_sph = $request->to_sph;
        $and_or = $request->and_or;
        $from_cyl = $request->from_cyl;
        $to_cyl = $request->to_cyl;
       


        if ( $lens_type_id  && $coating) {
            $orders = Orders::select('orders.*','order_head.tracking_numbers','order_head.order_status','patients.patient_name','patients.tray_number','patients.date_of_service','prescription_type.type','lens_type.lenses')->join('order_head','orders.order_head_id','order_head.id')->join('lens_type','lens_type.id','orders.lens_type_id')->join('patients','patients.id','order_head.patient_id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->join('frame_models','frame_models.id','order_head.frame_model_id')->where('orders.lens_type_id', $lens_type_id)->orWhereIn('orders.coating_1_id', $coating)->orWhereIn('orders.coating_2_id', $coating)->orWhereIn('orders.coating_3_id', $coating)->orWhereIn('orders.coating_4_id', $coating)->orderBy('orders.id', 'desc')->get();
           //dd($orders);
           }

       

        if ($lens_type_id != '') {
            $orders = Orders::select('orders.*','order_head.tracking_numbers','order_head.order_status','patients.patient_name','patients.tray_number','patients.date_of_service','prescription_type.type','lens_type.lenses')->join('order_head','orders.order_head_id','order_head.id')->join('lens_type','lens_type.id','orders.lens_type_id')->join('patients','patients.id','order_head.patient_id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->join('frame_models','frame_models.id','order_head.frame_model_id')->where('orders.lens_type_id', $lens_type_id)->orWhereIn('orders.coating_1_id', $coating)->orWhereIn('orders.coating_2_id', $coating)->orWhereIn('orders.coating_3_id', $coating)->orWhereIn('orders.coating_4_id', $coating)->orderBy('orders.id', 'desc')->get();
            //dd($orders);
            // return view('Orders.details',compact('orders'));

        }
      
        if ($and_or == 'OR' && $lens_type_id != '' && $coating != '' ) {
            $orders = Orders::select('orders.*','order_head.tracking_numbers','order_head.order_status','patients.patient_name','patients.tray_number','patients.date_of_service','prescription_type.type','lens_type.lenses')->join('order_head','orders.order_head_id','order_head.id')->join('lens_type','lens_type.id','orders.lens_type_id')->join('patients','patients.id','order_head.patient_id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->join('frame_models','frame_models.id','order_head.frame_model_id')->where(DB::raw("orders.sph BETWEEN '".$from_sph."' AND '".$to_sph."'"),true)->orWhere(DB::raw("orders.cyl BETWEEN '".$from_cyl."' AND '".$to_cyl."'"),true)->where('orders.lens_type_id', $lens_type_id)->orWhereIn('orders.coating_1_id', $coating)->orWhereIn('orders.coating_2_id', $coating)->orWhereIn('orders.coating_3_id', $coating)->orWhereIn('orders.coating_4_id', $coating)->orderBy('orders.id', 'desc')->get();
             //dd($orders);
            // return view('Orders.details',compact('orders'));
        }
       if($and_or == 'AND' && $lens_type_id != '' && $coating != '') {
        // $orders = Orders::select('orders.*','order_head.tracking_numbers','order_head.order_status','patients.patient_name','patients.tray_number','patients.date_of_service','prescription_type.type','lens_type.lenses')->join('order_head','orders.order_head_id','order_head.id')->join('lens_type','lens_type.id','orders.lens_type_id')->join('patients','patients.id','order_head.patient_id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->join('frame_models','frame_models.id','order_head.frame_model_id')->whereBetween('orders.sph', [$from_sph, $to_sph])->whereBetween('orders.cyl', [$from_cyl, $to_cyl])->orderBy('orders.id', 'desc')->get();
       
        $orders = Orders::select('orders.*','order_head.tracking_numbers','order_head.order_status','patients.patient_name','patients.tray_number','patients.date_of_service','prescription_type.type','lens_type.lenses')->join('order_head','orders.order_head_id','order_head.id')->join('lens_type','lens_type.id','orders.lens_type_id')->join('patients','patients.id','order_head.patient_id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->join('frame_models','frame_models.id','order_head.frame_model_id')->where(DB::raw("orders.sph BETWEEN '".$from_sph."' AND '".$to_sph."'"),true)->where(DB::raw("orders.cyl BETWEEN '".$from_cyl."' AND '".$to_cyl."'"),true)->where('orders.lens_type_id', $lens_type_id)->orWhereIn('orders.coating_1_id', $coating)->orWhereIn('orders.coating_2_id', $coating)->orWhereIn('orders.coating_3_id', $coating)->orWhereIn('orders.coating_4_id', $coating)->orderBy('orders.id', 'desc')->get();
        //dd($orders);
        // return view('Orders.details',compact('orders'));
       }

      
      

       if ($coating) {
        $orders = Orders::select('orders.*','order_head.tracking_numbers','order_head.order_status','patients.patient_name','patients.tray_number','patients.date_of_service','prescription_type.type','lens_type.lenses')->join('order_head','orders.order_head_id','order_head.id')->join('lens_type','lens_type.id','orders.lens_type_id')->join('patients','patients.id','order_head.patient_id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->join('frame_models','frame_models.id','order_head.frame_model_id')->orWhereIn('orders.coating_1_id', $coating)->orWhereIn('orders.coating_2_id', $coating)->orWhereIn('orders.coating_3_id', $coating)->orWhereIn('orders.coating_4_id', $coating)->orderBy('orders.id', 'desc')->get();
         //dd($orders);
        // return view('Orders.details',compact('orders'));
    }
   
    return view('Orders.details',compact('orders'));


    }
    public function OrderPrint($patient_id)
    {

    $order_logs = OrderLogsModels::select('order_logs.*','users.name')->join('users','users.id','order_logs.created_by')->where('order_logs.order_head_id','=',$patient_id)->get();
        
        $order_data = Orders::select('orders.*','lens_type.lenses','frame_models.model_name','frame_brands.brand_name')->join('order_head','order_head.id','orders.order_head_id')->join('lens_type','lens_type.id','orders.lens_type_id')->join('frame_models','frame_models.id','order_head.frame_model_id')->join('frame_brands','frame_models.brand_id','frame_brands.id')->where('order_head_id','=',$patient_id)->get();
        $id = $order_data[0]->order_head_id;
        //dd($id);
        $edit_order_head = VendorNumberModel::where('id','=',$id)->get();  
        //dd($edit_order_head);
        $p_id = $edit_order_head[0]->patient_id;
        $vendor_id = $edit_order_head[0]->vendor_id;
        //dd($vendor_id);
        $vendor_name = User::where('id','=',$vendor_id)->get();
        
        $prescription_id = $edit_order_head[0]->prescription_id;
        //dd($prescription_id);
        $get_prescription = PrescriptionModel::where('id','=',$prescription_id)->get();
        
        $patient_data = OrderHeadModel::where('id','=',$p_id)->get();
          
        return view('Orders.print')->with('order_data',$order_data)->with('order_logs',$order_logs)->with('edit_order_head',$edit_order_head)->with('patient_data',$patient_data)->with('get_prescription',$get_prescription)->with('vendor_name',$vendor_name);
    }
    public function printMultipleOrders(Request $request)
    {
            $print_order_id = $request->print_order_id;
            $p_id = explode(',', $print_order_id);
            // dd($p_id);
               $data_id = array_shift($p_id);
               //dd($data_id);
                   if ($data_id == 'on') {
                       if(is_array($p_id)){
                           $patient_data = Orders::select('orders.*','order_head.date','order_head.tracking_numbers','order_head.lens_order_number','order_head.frame_order_number','order_head.staff_notes','order_head.frame_status','order_head.order_status','patients.patient_name','patients.date_of_service','patients.tray_number','lens_type.lenses','users.name','prescription_type.type','frame_models.model_name','frame_brands.brand_name')->join('order_head','order_head.id','orders.order_head_id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->join('patients','patients.id','order_head.patient_id')->join('lens_type','lens_type.id','orders.lens_type_id')->join('frame_models','frame_models.id','order_head.frame_model_id')->join('frame_brands','frame_models.brand_id','frame_brands.id')->join('users','users.id','order_head.vendor_id')->whereIn('orders.order_head_id',$p_id)->orderBy('patients.patient_name','ASC')->orderBy('orders.id','ASC')->orderBy('orders.eye','DESC')->get();
                            $count_rows = count($patient_data);
                       //     foreach($p_id as $id){
                       //        // echo($id);
                       //        // echo("<br>");
                       //         //dd($patient_data);
                             
                        
                       // }
                       //dd($patient_data);
                          return view('Orders.Print_Multiple_Orders',compact('patient_data','count_rows'));     
                       }
                   } else{
                       $print_order_id = $request->input('print_order_id');
                   $p_id = explode(',', $print_order_id);
               if(is_array($p_id)){
                //dd(($p_id));
                $patient_data = Orders::select('orders.*','order_head.date','order_head.tracking_numbers','order_head.lens_order_number','order_head.frame_order_number','order_head.staff_notes','order_head.frame_status','order_head.order_status','patients.patient_name','patients.date_of_service','patients.tray_number','lens_type.lenses','users.name','prescription_type.type','frame_models.model_name','frame_brands.brand_name')->join('order_head','order_head.id','orders.order_head_id')->join('prescription_type','prescription_type.id','order_head.prescription_id')->join('patients','patients.id','order_head.patient_id')->join('lens_type','lens_type.id','orders.lens_type_id')->join('frame_models','frame_models.id','order_head.frame_model_id')->join('frame_brands','frame_models.brand_id','frame_brands.id')->join('users','users.id','order_head.vendor_id')->whereIn('orders.order_head_id',$p_id)->orderBy('patients.patient_name','ASC')->orderBy('orders.id','ASC')->orderBy('orders.eye','DESC')->get();
                $count_rows = count($patient_data);
                   // foreach($p_id as $id){
                   //     $patient_data += VendorNumberModel::select('order_head.*','patients.patient_name','patients.tray_number','frame_models.model_name')->join('patients','patients.id','order_head.patient_id')->join('frame_models','order_head.frame_model_id','frame_models.id')->whereIn('order_head.id','=',[$p_id])->get();
                   //     //dd($patient_data);
                   //     //return 1;
                   // }
               }
              //dd($patient_data);
               return view('Orders.Print_Multiple_Orders',compact('patient_data','count_rows'));    
    }
}
    public function frameStatus($id, $frame_status)
    {
        $order_query=DB::table('order_head')->where('id','=',$id)->update(['frame_status' => $frame_status]);
        $order_query=VendorNumberModel::where('id','=',$id)->where('order_status','Received')->orWhere('frame_status','Received')->update(['lab_status_id' => '2']);
        $order=VendorNumberModel::where('id','=',$id)->where('order_status','Received')->where('frame_status','Received')->update(['lab_status_id' => '3']);

    }
}