<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClinicModel;
use Auth;
class ClinicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clinic = ClinicModel::all();
        return view('Clinic.index',compact('clinic'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $id = $request->id;
        $clinic = new ClinicModel();
        if ($id > 0) {
            $clinic = ClinicModel::find($id);
        }
        return view('Clinic.form',compact('clinic'));
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
        ClinicModel::create([
        'clinic_name'=>$request->clinic_name,
        'number'=>$request->number,
        'address'=>$request->address,
        'created_at' => $date,
        'created_by'=>$id,
        
        
        ]);
        return redirect()->route('clinic.index');
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
    public function update(Request $request, $id)
    {
        $user_id = Auth::user()->id;
        $date = date("Y-m-d h:i:s");
        ClinicModel::where('id','=',$id)->update([
        'clinic_name'=>$request->clinic_name,
        'number'=>$request->number,
        'address'=>$request->address,
        'modified_at' => $date,
        'modified_by'=>$user_id,
        
        
        ]);
        return redirect()->route('clinic.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClinicModel $clinic,$id)
    {
        $clinic = ClinicModel::find($id);
       if ($clinic->delete())
       {
        return 1;
       }
       else{
        echo 0;
       }
    }
}
