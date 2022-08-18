<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;
use App\Models\City;
use App\Models\Client;
use App\Models\Resturant;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ordersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = order::paginate(6);
         $resturants = Resturant::all();
         $clients = Client::all();


        return view('orders.index',compact('orders','resturants','clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $orders = order::all();
        $regions = Region::all();
        return view('orders.add',compact('orders','regions'));

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
            $order_name = $request->order_name;

            // move pic
            $imageName = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('Attachments/' . $order_name), $imageName);
        }


        order::create([
        'name'=>$request->order_name,
        'about_order' => $request->about,
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
      
      return redirect('/orders');  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $orders = order::where('id', $id)->first();
        return view('orders.show', compact('orders'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
        
         
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

       order::find($id)->delete();
        session()->flash('delete','تم حذف القسم بنجاح');
        return redirect('/orders');
    }
}
