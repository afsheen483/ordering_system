<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderHeadModel;
use App\Models\Orders;
use App\Models\VendorNumberModel;
use App\Models\User;
use App\Models\TrackingHeadModel;
use DB;
use Carbon\Carbon;


class VendorsNumbersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $totalprice = 0.0;
        $tracking_numbers = $request->tracking_numbers;
        $query = DB::table('order_head')->select('price')->where("tracking_numbers",$tracking_numbers)->get();
        foreach ($query as $price) {
            $price = $price->price;
            $totalprice += $price;
               
           
        }
        echo $totalprice;
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    public function trackingDetails(){
       // $tracking_numbers = VendorNumberModel::all()->sum('tracking_numbers');
       $id =User::role('vendor')->pluck('id');
    //   $get = DB::table('users')->select('name','email','password')->whereIn('id',$id)->pluck('name');
    //    dd($get);
       //$tracking_numbers = VendorNumberModel::select('tracking_numbers,date ,Sum(price) as toal_amount')->whereIn('vendor_id',$id)->groupBy('tracking_numbers','date')->get();
             //dd($tracking_numbers);
             
             
        //= VendorNumberModel::selectRaw("tracking_numbers, date,SUM(price) as total_amount")->groupBy('tracking_numbers','date')->get();
        $tracking_numbers =  DB::table('order_head')
        ->join('users','order_head.vendor_id','=','users.id')
        ->whereIn('order_head.vendor_id',$id )
        ->where('order_head.tracking_numbers','!=','')
        ->select('order_head.date','order_head.tracking_numbers','users.name',DB::raw("SUM(order_head.price) as total_amount"),DB::raw("SUM(order_head.paid) as total_paid"))
        ->groupBy('order_head.tracking_numbers','order_head.date','users.name')
        ->get();

        return view('vendors.tracking_details')->with('tracking_numbers',$tracking_numbers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
            
        $patient_id = $request->input('patient_id');
        $freight_cost = $request->freight_cost;
        //dd(is_array($patient_id));
        $shipped = "Shipped";
        $tracking_numbers = $request->tracking_numbers;
        $carbon_date = Carbon::now();
        $currentDate = $carbon_date->toDateString();
        $date =  date("Y-m-d");
        
       
        $p_id = explode(',', $patient_id[0]);
       //dd($p_id);
        $data_id = array_shift($p_id);
     
            if ($data_id == 'on') {
                if(is_array($p_id)){ 
        
                        foreach($p_id as $id){
                        //dd($id);
                            VendorNumberModel::updateOrCreate([
                                'id' => $id,
                            ],[
                                'date' => $date,
                                'tracking_numbers' => $request->tracking_numbers,
                                'order_status' => $shipped
                               
                    ]);
                 
                }
            if (isset($_POST['ship']) && $tracking_numbers != '') {
                TrackingHeadModel::updateOrCreate(
                    [
                    'id' => $tracking_numbers,
                    'tracking_number' => $tracking_numbers,
                    ],[
                        'id' => $tracking_numbers,
                        'tracking_number' => $tracking_numbers,
                        'date' => $date,
                        'freight_cost' => $freight_cost
                ]);
            }
                //$update = DB::table('orders')->where('patient_id',$id)->update(['shippment_status' => $shipped]);
                return redirect('/orders-list/all');  
                }
        }
            else{
                $patient_id = $request->input('patient_id');
                $p_id = explode(',', $patient_id[0]);
            if(is_array($p_id)){
             //dd(($p_id));
                foreach($p_id as $id){
                   // print_r($id);
                        VendorNumberModel::updateOrCreate(
                        [
                            'id' => $id,
                        ],[
                            'date' => $date,
                            'tracking_numbers' => $request->tracking_numbers,
                            'order_status' => $shipped,
                            
                          
                ]);
             }
            if (isset($_POST['ship']) && $tracking_numbers != '') {
             TrackingHeadModel::updateOrCreate(
                [
                'id' => $tracking_numbers,
                'tracking_number' => $tracking_numbers
                ],[
                    'id' => $tracking_numbers,
                    'tracking_number' => $tracking_numbers,
                    'date' => $date,
                    'freight_cost' => $freight_cost
            ]);
             }
             return redirect('/orders-list/all');  
            }
        }
            // else{           
            //    try {
                
            //     return redirect('/orders-list/all');  
            //    } catch (\Throwable $th) {
            //        dd($th);
            //    }
            
            // }
        }
    
    
        
       
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        
        try {
            
        
        //print_r($price);
        $price = $request->price;
        $order_query=VendorNumberModel::where('id','=',$id)->update(['price' => $price]);
            //dd($order_query);
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
        }
        
    }
    public function updatePaidStatus($id,Request $request)
    {
        
        try {
            
            $paid = $request->paid;

        $order_query=VendorNumberModel::where('id','=',$id)->update(['paid' => $paid]);
           // dd($order_query);
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
        //
    }
    public function totalPrice($patient_id)
    {
    
       // $array= str_split($patient_id);
        $array_id = explode(',', $patient_id);
       // dd($array_id);
        $totalprice = 0.0;
        // $patient_id = explode(" ",$patient_id);
        $id = explode(',', $patient_id);
       
        $data_id = array_shift($id);
        //dd($patient_id); 
        if ($data_id == 'on') {
          
                if(is_array($id)){ 
                     
                       
                            $query = DB::table('order_head')->whereIn("id",$id)->sum('price');
                           echo ($query);
                           
                        }       
    }
    elseif(is_array($array_id)){
        $query = DB::table('order_head')->whereIn("id",$array_id)->sum('price');
      echo ($query);
    }
    else{
        // echo('else');
        //dd($patient_id);
        $query = DB::table('order_head')->where('id',$patient_id)->first();
        $price = $query->price;
       echo ($price);
        
    }
}
    public function InsertTrayNumber(Request $request,$id)
    {
        try {
            
            $tray_number = $request->tray_number;
            // dd($id);
            // dd($tray_number);

        $order_query=OrderHeadModel::where('id','=',$id)->update(['tray_number' => $tray_number]);
           dd($order_query);
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
        }
    }
}