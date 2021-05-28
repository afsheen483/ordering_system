<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FrameOrderModel;
use App\Models\FrameLogsModel;
use App\Models\FrameModel;
use Auth;


class FrameOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $frame_order = FrameOrderModel::select('frame_order.*','frame_models.model_name','frame_brands.brand_name','manufacturer.manufacturer_name','categories.category_name','frame_order_status.status_title')->join('frame_models','frame_models.id','frame_order.frame_model_id')->join('frame_order_status','frame_order_status.id','frame_order.status_id')->join('frame_brands','frame_models.brand_id','frame_brands.id')->join('categories','categories.id','frame_models.category_id')->join('manufacturer','frame_brands.manufacturer_id','manufacturer.id')->get();
        return view('FrameOrder.index',compact('frame_order'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //dd($request->id);
        $id = $request->id;
        $frame_order[] = new FrameOrderModel();
        $frame_model[] = new FrameModel();
        if ($id > 0) {
            $frame_order = FrameOrderModel::select('frame_order.*','frame_models.brand_id','frame_brands.brand_name','manufacturer.manufacturer_name')->join('frame_models','frame_order.frame_model_id','frame_models.id')->join('frame_brands','frame_models.brand_id','frame_brands.id')->join('manufacturer','manufacturer.id','frame_brands.manufacturer_id')->where('frame_order.id','=',$id)->get();
            $frame_model = FrameOrderModel::select('frame_order.*','frame_models.brand_id','frame_brands.brand_name','manufacturer.manufacturer_name')->join('frame_models','frame_order.frame_model_id','frame_models.id')->join('frame_brands','frame_models.brand_id','frame_brands.id')->join('manufacturer','manufacturer.id','frame_brands.manufacturer_id')->where('frame_order.id','=',$id)->get();
            //dd($frame_order);
        }
        //dd($frame_order);
        return view('FrameOrder.form',compact('frame_order','frame_model'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = Auth::user()->id;
        $date = date("Y-m-d h:i:s");
    
        $order_id = FrameOrderModel::create([
        'frame_model_id' => $request->frame_model_id,
        'quantity' => $request->quantity,
        'unit_cost' => $request->unit_cost,
        
       
        'user_id' => $request->user_id,
        'status_id' => $request->status_id,
        'created_at' => $date,
        'created_by'=>$id,
        
        ])->id;
        FrameLogsModel::create([
            'action'=>'insert',
            'frame_order_id'=>$order_id,
            'created_at' => $date,
            'created_by'=>$id,
        ]);
        return redirect()->route('frame_order.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $frame_order_data = FrameOrderModel::select('frame_order.*','frame_models.model_name','frame_brands.brand_name','manufacturer.manufacturer_name','categories.category_name','status.status_type','users.name')->join('frame_models','frame_models.id','frame_order.frame_model_id')->join('status','status.id','frame_order.status_id')->join('frame_brands','frame_models.brand_id','frame_brands.id')->join('users','users.id','frame_order.user_id')->join('categories','categories.id','frame_models.category_id')->join('manufacturer','frame_brands.manufacturer_id','manufacturer.id')->where('frame_models.id','=',$id)->get();
        //dd($frame_order_data);
        $frame_logs = FrameLogsModel::select('frame_logs.*','users.name')->join('users','users.id','frame_logs.created_by')->where('frame_logs.frame_order_id','=',$id)->get();
        return view('FrameOrder.show')->with('frame_order_data',$frame_order_data)->with('frame_logs',$frame_logs);
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
    public function update(Request $request, $id)
    {
        //dd($id);
        $user_id = Auth::user()->id;
        $date = date("Y-m-d h:i:s");
    
        FrameOrderModel::where('id','=',$id)->update([
        'frame_model_id' => $request->frame_model_id,
        'quantity' => $request->quantity,
        'unit_cost' => $request->unit_cost,
       
       
        'user_id' => $request->user_id,
        'status_id' => $request->status_id,
        'modified_at' => $date,
        'modified_by'=>$user_id,
        
        ]);
        FrameLogsModel::where('frame_order_id','=',$id)->update([
            'action'=>'update',
            'modified_at' => $date,
            'modified_by'=>$id,
        ]);
        return redirect()->route('frame_order.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(FrameOrderModel $frameOrder)
    {
        $frameOrder->delete();
        return redirect()->route('frames.index')->with('error','Data has deleted successfully!');
    }
}
