<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FrameModel;
use App\Models\FrameOrderModel;
use App\Models\VendorNumberModel;
use DB;
class GetFrameModelController extends Controller
{
    public function index($id)
    {
        $get_data = FrameModel::where('brand_id','=',$id)->get();
       // dd($get_data);
        return $get_data;
    }
    public function status()
    {
        $get_status = DB::table('frame_order_status')->get();
        return $get_status;
    }
    public function update($id,Request $request)
    {
        $status_id = $request->status_id;
        $update = FrameOrderModel::where('id','=',$id)->update([
        'status_id'=>$status_id
        ]);
    }
    public function LabStatus()
    {
        $get_lab_status = DB::table('lab_status')->get();
        return $get_lab_status;
    }
    public function LabStatusUpdate(Request $request,$id)
    {
       $lab_status_id = $request->lab_status_id;
       $update = VendorNumberModel::where('id','=',$id)->update([
        'lab_status_id'=>$lab_status_id
        ]);
    }
}
