<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;
use App\Models\City;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class regionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $regions = Region::all();
         $cities = City::all();

        return view('region.index',compact('regions','cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //     $validated = $request->validate([
    //     'name' => 'required|unique:name|max:255',
        
    // ],[

    //     'city_name.required' =>'يجب ادخال هذا الحق',
    //     'city_name.unique' =>'حقل موجود مسبقا ',
        
         
    // ]);
     // dd($request);

       region::create([
        'name'=>$request->region_name,
        'city_id' => $request->city,
        'created_by'=>(Auth::user()->name),

    ]);

       session()->flash('add','تم اضافة القسم بنجاح ');
      
      return redirect('/regions');

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
        //dd($request);
         $id = $request->id;
        $id2 =City::where('id',$request->city)->first()->id;
       
    //     $validated = $request->validate([
    //     'product_name' => 'required|unique:products,product_name|max:255'.$id,
    //     'descreption' => 'required',
    // ],[

    //     'product_name.required' =>'يجب ادخال هذا الحق',
    //     'product_name.unique' =>'حقل موجود مسبقا ',
    //     'descreption.required' => 'يجب ادخال هذا الحق',
         
    // ]);

        $regions= Region::findOrFail($id);

        $regions->update([
             
        'name'=>$request->region_name,
        //'city_id'=>$request->city,
        
        'city_id'=>$id2,
        


        ]);


      session()->flash('edit','تم تعديل القسم بنجاح ');
      
      return redirect('/regions');
    }


    
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
         $id = $request->id;

       Region::find($id)->delete();
        session()->flash('delete','تم حذف القسم بنجاح');
        return redirect('/regions');
    }
}
