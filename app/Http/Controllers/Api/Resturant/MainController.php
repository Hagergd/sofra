<?php

namespace App\Http\Controllers\Api\Resturant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Region;
use App\Models\City;
use App\Models\Contact;
use App\Models\Setting;
use App\Models\Resturant;
use App\Models\Meal;
use App\Models\Comment;
use App\Models\Offer;
use App\Models\Order;
use App\Models\Token;
use App\Models\Notification;
use Illuminate\Support\Facades\sum;


class MainController extends Controller
{
    public function resturantMeals(Request $request)
    {
    
        $meals = $request->user()->meals()->paginate(6);
        
        return responseJson(status:1,message:'success',data:$meals);
    }

    public function addMeal(Request $request)
    {
        
      $Validator = Validator()->make($request->all(), [

        'meal_name' => 'required',
        'image' => 'required',
        'description' => 'required',
        'price' => 'required',
        'offer_price' => 'required',
        'prepare_time' => 'required',
        'resturant_id' => 'required',


      ]);

      if ($Validator->fails()) {

        return responseJson(status:0,message:$Validator->errors()->first(),data:$Validator->errors());
           
       }
       $resturant = Resturant::find($request->resturant_id);
        
        if ($resturant) {
            
       $meals = Meal::create($request->all());
      
        return responseJson(status:1,message:'تم الاضافة بنجاح ',data:[

        ]);
           }
    }

    public function editMeal(Request $request)
    {
        
      $Validator = Validator()->make($request->all(), [

        'meal_name' => 'required',
        'image' => 'required',
        'description' => 'required',
        'price' => 'required',
        'offer_price' => 'required',
        'prepare_time' => 'required',
         'meal_id'=> 'required',
      ]); 

      if ($Validator->fails()) {

        return responseJson(status:0,message:$Validator->errors()->first(),data:$Validator->errors());   
       } 
       
       $meals = Meal::find($request->meal_id);
       if($meals){

        $meals->update($request->all());
        $meals->save();
       
        return responseJson(status:1,message:'تم التعديل بنجاح ',data:$meals);
        }   
    }

    public function getNewOrders(Request $request)
    {
        $orders = Order::where('status','pending')->paginate(6);

        return responseJson(status:1,message:'success',data:$orders);
    }

     public function getNowOrders(Request $request)
    {
        $orders = Order::where('status','accepted')->paginate(6);

        return responseJson(status:1,message:'success',data:$orders);
    }

    public function getOldtOrders(Request $request)
    {
        $orders = Order::where('status','=','rejected')->orwhere('status','=','deliverd')
        ->paginate(6);

        return responseJson(status:1,message:'success',data:$orders);
    }


    public function acceptorder(Request $request)
    {
        $orders = Order::find($request->order_id);

        if($orders){

         $orders->update(['status'=>'accepted']);

         $orders->save();

        return responseJson(status:1,message:'success',data:$orders);
    }}

    public function confirmOrder(Request $request)
    {
        $orders = Order::find($request->order_id);

        if($orders){

         $orders->update(['status'=>'deliverd']);

         $orders->save();

        return responseJson(status:1,message:'success',data:$orders);
      }
    }

    public function cancelOrder(Request $request)
    {
        $orders = Order::find($request->order_id);

        if($orders){

         $orders>update(['status'=>'rejected']);

         $orders->save();

        return responseJson(status:1,message:'success',data:$orders);
      }
    }

    public function resturantNotifications(Request $request)
    {
        //dd($request->user());
        $notification = Notification::where('notificationable_type','resturant')->where('notificationable_id',$request->user()->id)->get();

        return responseJson(status:1,message:'success',data:$notification);
    }

    public function addOffer(Request $request)
    {
        
      $Validator = Validator()->make($request->all(), [

        'name' => 'required',
        'image' => 'required',
        'description' => 'required',
        'from' => 'required',
        'to' => 'required',
        'resturant_id'=>'required',


      ]);

      if ($Validator->fails()) {

        return responseJson(status:0,message:$Validator->errors()->first(),data:$Validator->errors());
           
       } 
       
       $offers = $request->user()->oferrs()-> create($request->all());
       
        return responseJson(status:1,message:'تم الاضافة بنجاح ',data:[

        ]);

    }

    public function allOffers(Request $request)
    {
        $offers = $request->user()->oferrs()->paginate(6);

             
        return responseJson(status:1,message:'success',data:$offers);
    }

    public function commission(Request $request)
    {
        $settings =Setting::first();

        $appCommision = $settings->commission;

        $ordersSum= $request->user()->orders()->where('status','deliverd')->sum('total_price');

        $paidAmount = $request->user()->payments()->sum('paid_amount');
         dd($payments);

         $remmingAmount = $request->user()->payments()->sum('remaining_amount');
         dd($payments);
        
             
        return responseJson(status:1,message:'success',data:$payments);
    }


}
