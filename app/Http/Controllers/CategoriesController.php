<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;
use App\Models\City;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return view('category.index',compact('categories'));
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
         //dd($request);
    //     $validated = $request->validate([
    //     'name' => 'required|unique:name|max:255',
        
    // ],[

    //     'governorate_name.required' =>'يجب ادخال هذا الحق',
    //     'governorate_name.unique' =>'حقل موجود مسبقا ',
        
         
    // ]);


       Category::create([
        'name'=>$request->category_name,
        'created_by'=>(Auth::user()->name),

    ]);

       session()->flash('add','تم اضافة القسم بنجاح ');
      
      return redirect('/categories');
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
        $id = $request->id;
       
    //     $validated = $request->validate([
    //     'section_name' => 'required|unique:sections,section_name|max:255'.$id,
    //     'descreption' => 'required',
    // ],[

    //     'section_name.required' =>'يجب ادخال هذا الحق',
    //     'section_name.unique' =>'حقل موجود مسبقا ',
    //     'descreption.required' => 'يجب ادخال هذا الحق',
         
    // ]);

        $categories= Category::find($id);

        $categories->update([
             
        'name'=>$request->category_name,
        
        'created_by'=>(Auth::user()->name),


        ]);


      session()->flash('edit','تم تعديل القسم بنجاح ');
      
      return redirect('/categories');

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

          Category::find($id)->delete();
        session()->flash('delete','تم حذف القسم بنجاح');
        return redirect('/categories');
    }
}
