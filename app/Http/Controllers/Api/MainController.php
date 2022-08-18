<?php

namespace App\Http\Controllers\Api;

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

    public function cities(Request $request)
    {
        $cities = City::all();

        return responseJson(status:1,message:'success',data:$cities);
    }

    public function categories(Request $request)
    {
        $categories = Category::all();

        return responseJson(status:1,message:'success',data:$categories);
    }

    public function regions(Request $request)
    {
        $regions = Region::where(function($query) use($request){

            if ($request->has('city_id')) {

                $query->where('city_id',$request->city_id);
            }

        })->get();

        return responseJson(status:1,message:'success',data:$regions);
    }


    public function aboutApp(Request $request)
    {
        $settings = Setting::first();
             
        return responseJson(status:1,message:'success',data:$settings);
    



}
