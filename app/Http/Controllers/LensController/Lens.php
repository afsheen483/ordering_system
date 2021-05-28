<?php

namespace App\Http\Controllers\LensController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LensModel;
class Lens extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lenses= LensModel::all();
        return view('LensType.lens',compact('lenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('LensType.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        LensModel::create([
            'lenses' => $request->lenses,
        ]);
        return redirect()->route('lens.index');
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
        $lens = LensModel::findOrFail($id);
        return view('LensType.edit')->with('lens',$lens);
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
        $lens = LensModel::findOrFail($id);

        $lens->update($request->all());
        return redirect('/lens');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(LensModel $len)
    {
        $len->delete();
        return redirect()->route('lens.index')->with('error','Data has deleted successfully!');
    }
}
