<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\resturant;
use App\Models\Region;
use App\Models\City;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class resturantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resturants = Resturant::paginate(6);
         $regions = Region::all();

        return view('resturants.index',compact('resturants','regions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $resturants = Resturant::all();
        $regions = Region::all();
        return view('resturants.add',compact('resturants','regions'));

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


        Resturant::create([
        'name'=>$request->resturant_name,
        'about_resturant' => $request->about,
        'phone'=>$request->phone,
        'whats_phone'=>$request->whats_phone,
        'email'=>$request->email,
        'password'=>$request->password,
        'pin_code'=>'1234',
        'api_token'=>'qwe123456778',
        'region_id'=>$request->region,
        'delivery_price'=>$request->delivery_price,
        'lowest_price'=>$request->lowest_price,
        'commission'=>$request->commission,
        'image'=>$imageName ,
        'created_by'=>(Auth::user()->name),

    ]);

       session()->flash('add','تم اضافة القسم بنجاح ');
      
      return redirect('/resturants');  
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
        
        $resturant = DB::table('resturants')
                ->where('id', '=', $id)
                ->first();

        $regions = Region::all();
        //dd($regions);
       return view('resturants.edit',compact('resturant','regions')); 
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

        $resturants = Resturant::findOrFail($id);


            $resturants->update([
                'name' => $request->resturant_name ,
                'image' => $request->pic->getClientOriginalName(),
        
        'about_resturant' => $request->about,
        'phone'=>$request->phone,
        'whats_phone'=>$request->whats_phone,
        'email'=>$request->email,
        'password'=>$request->password,
        'pin_code'=>'1234',
        'api_token'=>'qwe123456778',
        'region_id'=>$request->region,
        'delivery_price'=>$request->delivery_price,
        'lowest_price'=>$request->lowest_price,
        'commission'=>$request->commission,
                //'resturant_id' =>$id_resturant, 
            ]); 
            
        session()->flash('Status_Update');
        return redirect('/resturants');
 
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

       Resturant::find($id)->delete();
        session()->flash('delete','تم حذف القسم بنجاح');
        return redirect('/resturants');
    }
}
