<?php

namespace App\Http\Controllers\Api\Client;

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


class OrderController extends Controller
{

    public function newOrder(Request $request)
    {
        //dd($request);
        $Validator = Validator()->make($request->all(), [

        'resturant_id' => 'required|exists:resturants,id',
        'meals.*.meal_id' => 'required|exists:meals,id',
        'meals.*.quantity'=>'required',
        'address'=>'required',
        'payment_method'=>'required',

        ]);

       if ($Validator->fails()) {

            return responseJson(status:0,message:$Validator->errors()->first(),data:$Validator->errors());
       }

       $resturant = Resturant::find($request->resturant_id);

       if ($resturant->status == 'off') {

             return responseJson(status:0,message:'المطعم مغلق الان ',data:$Validator->errors());

        } else {

           $order = $request->user()->orders()->create([
            'resturant_id'=>$request->resturant_id,
            'specail_order'=>$request->note,
            'status'=>'pending',
            'address'=>$request->address,
            'payment_method'=>$request->payment_method,
            'image'=>'1',

           ]);

          $cost =0;
          $delivery_price = $resturant->delivery_price;
          foreach ($request->meals as $i) {

          $meals = Meal::findOrFail($i['meal_id']);
          //dd($meals);
           $readymeal = [

              $i['meal_id'] => [
               'quantity'  => $i['quantity'],
               'price' =>$meals->price,
               'special_order' => (isset($i['note'])) ? $i['note'] : ''

               ]
               ] ;
         $order->meals()->attach($readymeal);
         $cost += ($meals->price * $i['quantity'] );

            if ($cost >= $resturant->$delivery_price) {

                $total = $cost + $delivery_price;
                $setting = Setting::first();
                $commission = $setting->commission * $cost;
                $net = $total- $setting->commission;
                $update = $order->update([
                  'cost'=>$cost,
                  'delivery_price'=>$delivery_price,
                  'image'=>$meals->image,
                  'order_price'=>$total,
                  'total_price'=>$net,
                  'commission'=>$commission,

                ]);
            }}

              }


       $notifications= Notification::create([
            'title'=>'لديك طلب جديد ',
            'content'=>'لديك طلب جديد من العميل '.$request->user()->name,
            'notificationable_id'=>$request->order_id,
            'notificationable_type'=>'resturant',
            'is_read'=>'0'
        ]);

      //dd($notifications);
        $tokens = $resturant->tokenable()->where('token','!=','')->pluck('token')->toArray();
        $audience = ['include_players_ids'=>$tokens];
        $contents = [
            'en'=>'you have new order from' .$request->user()->name,
            'en'=>'لديك طلب جديد' .$request->user()->name,

        ];
        $send = notifyByOneSignal($audience,$contents,[
            'user_type'=>'resturant',
            'action'=>'new_order',
            'order_id'=>$order->id,
        ]);

        $send = json_decode($send);
        $data   = [ 'order' => $order->fresh()->load('meals')];

        return responseJson(status:1,message:"تم اضافة الطلب ",data:$data);
    }

    public function showOrder(Request $request)
    {
        $order = Order::find($request->order_id);

        if($order){

         $order->first();

        return responseJson(status:1,message:'success',data:$order);
    } }


    public function neworders(Request $request)
    {
        $orders = Order::where('status','pending')->paginate(6);

        return responseJson(status:1,message:'success',data:$orders);
    }


    public function oldorders(Request $request)
    {
        $orders = Order::where('status','deliverd')->paginate(6);

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

    public function cancelOrder(Request $request)
    {
         $orders = Order::find($request->order_id);

        if($orders){

         $orders->update(['status'=>'rejected']);

         $orders->save();

        return responseJson(status:1,message:'success',data:$orders);
    }}

}
