<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VendorNumberModel;

class OrderHeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function update(Request $request, $order_id)
    {
        //dd($order_id);
        $order_query=VendorNumberModel::where('id','=',$order_id)->update(['lab_status_id' => '2']);
        dd($order_query);
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
    public function ChangeLabStatus(Request $request)
    {   
        // $order_status = $request->order_status;
        // $frame_status = $request->frame_status;
        // echo($order_status);
        // echo($frame_status);
       
        // $order_query=VendorNumberModel::where('order_status','Received')->orWhere('frame_status','Received')->update(['lab_status_id' => '2']);
        // $order=VendorNumberModel::where('order_status','Received')->where('frame_status','Received')->update(['lab_status_id' => '3']);
        // dd($order_query);

    }
}
