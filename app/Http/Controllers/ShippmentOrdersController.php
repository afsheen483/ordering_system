<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\OrderHeadModel;
use App\Models\VendorNumberModel;
use App\Models\OrderLogsModels;
use Auth;
class ShippmentOrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders_data = Orders::all();
      
        return view('vendors.shippment_orders',compact('orders_data'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('vendors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Orders $order) 
    {
        return view('vendors.shippment_orders',compact('$order'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user_id = Auth::user()->id;
        $date = date("Y-m-d h:i:s");
    
        //$id = Orders::find($id);
        //dd($order_head_id );
          //$id = $id->order_head_id;
          //dd($id);
          $patient_id = VendorNumberModel::where('id','=',$id)->get();
          $p_id = $patient_id[0]->patient_id;
          //dd($p_id);
          $update = VendorNumberModel::where('id','=',$id)->update([
            'vendor_id' => $request->vendor_name,
            'clinic_id' => $request->clinic_id,
            'lab_status_id'=>'1',
            'lens_order_number'=> $request->order_number,
            'frame_order_number' => $request->frame_order_number,
            'staff_notes'=> $request->staff_notes,
            'frame_model_id'=>$request->frame_model_id,
            'prescription_id' => $request->prescription_id,
            ]);
          $order_head_id = OrderHeadModel::where('id',$p_id)->update([
            'date_of_service' => $request->date_of_service,
            'patient_name' => $request->patient_name,
            'tray_number'=>$request->tray_number,
            ]);
            //$vendor_name = $request->vendor_name;
            Orders::where('eye', 'R')->where('order_head_id','=',$id)->update([
               
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
            ]);
        
            
            Orders::where('eye','L')->where('order_head_id','=',$id)->update([

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
            ]);
           
            OrderLogsModels::create([
                'action'=>'update',
                'order_head_id'=> $id,
                'created_at' => $date,
                'created_by'=>$user_id,
            ]);
            
       
            
            return redirect('/orders-list/all');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Orders $order)
    // {
    //     $order->delete();
    //     return redirect()->route('shippment_orders.index')->with('error','Data has deleted successfully!');
    // }
}
