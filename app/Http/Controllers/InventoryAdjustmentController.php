<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\InventoryAdjustmentModel;
use App\Models\FrameModel;

class InventoryAdjustmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventory_adjustment = InventoryAdjustmentModel::select('inventory_adjustment.*','frame_models.model_name','adjustment.type','frame_brands.brand_name')->join('adjustment','inventory_adjustment.adjustment_type_id','adjustment.id')->join('frame_models','frame_models.id','inventory_adjustment.frame_model_id')->join('frame_brands','frame_brands.id','frame_models.brand_id')->get();
        return view('InventoryAdjustment.index',compact('inventory_adjustment'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $id = $request->id;
        $inventory_adjustment[] = new InventoryAdjustmentModel();
        $frame_model[] = new FrameModel();
        if ($id > 0) {
            $inventory_adjustment = InventoryAdjustmentModel::select('inventory_adjustment.*','frame_models.brand_id','frame_brands.brand_name','manufacturer.manufacturer_name')->join('frame_models','inventory_adjustment.frame_model_id','frame_models.id')->join('frame_brands','frame_models.brand_id','frame_brands.id')->join('manufacturer','manufacturer.id','frame_brands.manufacturer_id')->where('inventory_adjustment.id','=',$id)->get();
            $frame_model = InventoryAdjustmentModel::select('inventory_adjustment.*','frame_models.brand_id','frame_brands.brand_name','manufacturer.manufacturer_name')->join('frame_models','inventory_adjustment.frame_model_id','frame_models.id')->join('frame_brands','frame_models.brand_id','frame_brands.id')->join('manufacturer','manufacturer.id','frame_brands.manufacturer_id')->where('inventory_adjustment.id','=',$id)->get();            
        }
        
        return view('InventoryAdjustment.form',compact('inventory_adjustment','frame_model'));
        
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
        InventoryAdjustmentModel::create([
        'adjustment_type_id'=>$request->adjustment_type_id,
        'frame_model_id'=>$request->frame_model_id,
        'qty'=>$request->qty,
        'remarks'=>$request->remarks,
        'created_at' => $date,
        'created_by'=>$id,
        ]);
        return redirect()->route('inventory_adjustment.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $inventory_adjustment = InventoryAdjustmentModel::select('inventory_adjustment.*','frame_models.model_name','adjustment.type','frame_brands.brand_name','categories.category_name','manufacturer.manufacturer_name')->join('adjustment','inventory_adjustment.adjustment_type_id','adjustment.id')->join('frame_models','frame_models.id','inventory_adjustment.frame_model_id')->join('frame_brands','frame_brands.id','frame_models.brand_id')->join('manufacturer','manufacturer.id','frame_brands.manufacturer_id')->join('categories','categories.id','frame_models.category_id')->where('inventory_adjustment.id','=',$id)->get();
        return view('InventoryAdjustment.show',compact('inventory_adjustment'));
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
        $user_id = Auth::user()->id;
        $date = date("Y-m-d h:i:s");
        InventoryAdjustmentModel::where('id','=',$id)->update([
        'adjustment_type_id'=>$request->adjustment_type_id,
        'frame_model_id'=>$request->frame_model_id,
        'qty'=>$request->qty,
        'remarks'=>$request->remarks,
        'modified_at' => $date,
        'modified_by'=>$user_id,
        
        
        ]);
        return redirect()->route('inventory_adjustment.index');

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
}
