<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\city;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class citiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::all();

        return view('city.index',compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::all();

        return view('city.add',compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    //     //dd($request);
    //     $validated = $request->validate([
    //     'name' => 'required|unique:cities|max:255',
        
    // ],[

    //     'name.required' =>'يجب ادخال هذا الحق',
    //     'name.unique' =>'حقل موجود مسبقا ', 
         
    // ]);

       city::create([
        'name'=>$request->city_name,
        'created_by'=>(Auth::user()->name),

    ]);

       session()->flash('add','تم اضافة القسم بنجاح ');
      
      return redirect('/cities');

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
        $city = DB::table('cities')
                ->where('id', '=', $id)
                ->first();

 
          
       return view('city.edit',compact('city')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {

        $id = $request->id;
       
    //     $validated = $request->validate([
    //     'name' => 'required|unique:cities|max:255',
        
    // ],[

    //     'name.required' =>'يجب ادخال هذا الحق',
    //      'name.unique' =>'حقل موجود مسبقا ',
       
         
    // ]);

        $cities= City::find($id);

        $cities->update([
             
        'name'=>$request->city_name,
        
        'created_by'=>(Auth::user()->name),


        ]);


      session()->flash('edit','تم تعديل القسم بنجاح ');
      
      return redirect('/cities');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
         $id = $request->id;

       city::find($id)->delete();
        session()->flash('delete','تم حذف القسم بنجاح');
        return redirect('/cities');
    }
}
