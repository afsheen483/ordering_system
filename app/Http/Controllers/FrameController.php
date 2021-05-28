<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FrameModel;
use Auth;

class FrameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $frame = FrameModel::select('frame_models.*','frame_brands.brand_name','manufacturer.manufacturer_name','categories.category_name')->join('frame_brands','frame_models.brand_id','frame_brands.id')->join('categories','categories.id','frame_models.category_id')->join('manufacturer','frame_brands.manufacturer_id','manufacturer.id')->get();
        return view('Frames.index',compact('frame'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Frames.create');

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
    
        FrameModel::create([
            'model_name' => $request->model_name,
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'cost' => $request->cost,
            'sell_price' => $request->sell_price,
            'url_link' => $request->url_link,
            'purchasing_link' => $request->purchasing_link,
            'is_active' => $request->is_active,
            'is_stocked_item' => $request->is_stocked_item,
            'created_at' => $date,
            'created_by'=>$id,
        ]);
        return redirect()->route('frame.index');
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
        $frame = FrameModel::findOrFail($id);
        return view('Frames.edit')->with('frame',$frame);

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
    
        $frame = FrameModel::findOrFail($id);
        $user_id = Auth::user()->id;
        $date = date("Y-m-d h:i:s");

       FrameModel::where('id','=',$id)->update([
        'model_name' => $request->model_name,
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'cost' => $request->cost,
            'sell_price' => $request->sell_price,
            'url_link' => $request->url_link,
            'purchasing_link' => $request->purchasing_link,
            'is_active' => $request->is_active,
            'is_stocked_item' => $request->is_stocked_item,
            'modified_at' => $date,
            'modified_by'=>$user_id,
       
       ]);
       return redirect()->route('frame.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $frame = FrameModel::find($id);
        $frame->delete();
        return redirect()->route('frames.index')->with('error','Data has deleted successfully!');
    }
}
