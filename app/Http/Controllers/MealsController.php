<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\resturant;
use App\Models\Region;
use App\Models\City;
use App\Models\Client;
use App\Models\Meal;
use App\Models\Category;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class mealsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resturants = Resturant::paginate(6);
         $categories = Category::all();
         $meals=Meal::paginate(6);

        return view('meals.index',compact('resturants','categories','meals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $meals = Meal::all();
        $resturants =Resturant::all();
        $categories =Category::all();


        return view('meals.add',compact('meals','resturants','categories'));

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

    //     'governorate_name.required' =>'يجب ادخال هذا الحق',
    //     'governorate_name.unique' =>'حقل موجود مسبقا ',
        
         
    // ]);
     //dd($request);
              
        if ($request->hasFile('pic')) {

            
            $image = $request->file('pic');
            $file_name = $image->getClientOriginalName();
            $resturant_name = $request->resturant_name;

            // move pic
            $imageName = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('Attachments/' . $resturant_name), $imageName);
        }


        Meal::create([
        'meal_name'=>$request->meal_name,
        'description' => $request->description,
        'category_id'=>$request->category,
        'resturant_id'=>$request->resturant,
        'price'=>$request->price,
        'offer_price'=>$request->offer_price,
        'prepare_time'=>$request->time,
        'image'=>$imageName ,
        'created_by'=>(Auth::user()->name),

    ]);

       session()->flash('add','تم اضافة القسم بنجاح ');
      
      return redirect('/meals');  
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
    public function edit($id,Request $request)
    {
        
        $meal = DB::table('meals')
                ->where('id', '=', $id)
                ->first();

        $resturants = Resturant::all();
        $categories =Category::all();

        
       return view('meals.edit',compact('resturants','categories','meal')); 
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
        // $id = $request->resturant_id;

        // $id_resturant =Resturant::where('id',$request->resturant)->first()->id;
//dd($request);
        $meals = Meal::findOrFail($id);


        $meals->update([
        'meal_name'=>$request->meal_name,        
        'image' => $request->pic->getClientOriginalName(),
        'description' => $request->description,
        'category_id'=>$request->category,
        'resturant_id'=>$request->resturant,
        'price'=>$request->price,
        'offer_price'=>$request->offer_price,
        'prepare_time'=>$request->time,
        'created_by'=>(Auth::user()->name),
        
            ]); 
            
        session()->flash('Status_Update');
        return redirect('/meals');
 
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

       Meal::find($id)->delete();
        session()->flash('delete','تم حذف القسم بنجاح');
        return redirect('/meals');
    }
}
