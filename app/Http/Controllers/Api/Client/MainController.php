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


class MainController extends Controller
{

    public function getResturants(Request $request)
    {
        $resturants = Resturant::where(function($query) use($request){

            if ($request->has('region_id')) {

                $query->where('region_id',$request->region_id);
             }

           
            if ($request->has('name')) {

                $query->where('name',$request->name);
             }

            else {
                
                }  })->paginate(6);

        return responseJson(status:1,message:'success',data:$resturants);
    }


    public function resturantMeals(Request $request)
    {

        $meals = Meal::where(function($query) use($request){

            if ($request->has('resturant_id')) {

                $query->where('id',$request->resturant_id);
            };

        })->paginate(6);
 
        return responseJson(status:1,message:'success',data:$meals);
    }

    public function mealDetails(Request $request)
    {
        $meal = Meal::find($request->meal_id);
        
        if ($meal) {
    
         $meal->first();


          return responseJson(status:1,message:'success',data:$meal);

     }
        // where(function($query) use($request){

        //     if ($request->has('meal_id')) {

        //         $query->where('id',$request->meal_id);
        //     };

        // })->first();
 
       
    }

    public function comments(Request $request)
    {
        $comments = Comment::paginate(3);

        return responseJson(status:1,message:'success',data:$comments);
    }

    public function addComment(Request $request)
    {

      $Validator = Validator()->make($request->all(), [

        'comment' => 'required',
        'rate' => 'required',
        'resturant_id'=>'required',

      ]);
      
      if ($Validator->fails()) {

        return responseJson(status:0,message:$Validator->errors()->first(),data:$Validator->errors());
           
       }  
             $comment = Comment::create($request->all());
    
             return responseJson(status:1,message:'success',data:$comment);
            
    }

    public function resturantInformation(Request $request)

    {
            $resturant = Resturant::find($request->resturant_id);

            if ($resturant) {
                
                $resturant->first();
            }
               return responseJson(status:1,message:'success',data:$resturant);

    }


    public function offers(Request $request)
    {
         $offer = Offer::find($request->resturant_id);

            if ($offer) {
                
                $offer->first();
            }
               return responseJson(status:1,message:'success',data:$offer);

        
    }

    public function allOffers(Request $request)
    {
        $offers = Offer::paginate(6);
             
        return responseJson(status:1,message:'success',data:$offers);
    }

 
    public function clientNotification(Request $request)
    {
        //dd($request->user());
        $notification = Notification::where('notificationable_type','client')->where('notificationable_id',$request->user()->id)->get();

        return responseJson(status:1,message:'success',data:$notification);
    }
    
    public function clientNotifications(Request $request)
    {
        $notification = $request->user()->notifications()->latest()->paginate(2);

        return responseJson(status:1,message:'success',data:$notification);
    }


}
