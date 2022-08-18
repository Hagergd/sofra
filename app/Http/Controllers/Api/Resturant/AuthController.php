<?php

namespace App\Http\Controllers\Api\Resturant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Login;
use App\Models\Token;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\Resturant;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
//use Illuminate\Support\Facades\Rule;
use Illuminate\Validation\Rule;




class AuthController extends Controller
{   
    public function resturantRegister(Request $request)
    {
        
      $Validator = Validator()->make($request->all(), [

        'name' => 'required',
        'phone' => 'required',
        'password' => 'required',
        'region_id' => 'required',
        'email' => 'required',
        

      ]);

      if ($Validator->fails()) {

        return responseJson(status:0,message:$Validator->errors()->first(),data:$Validator->errors());
           
       } 
       $code= rand(1111,9999);

       $request->merge(['password'=>bcrypt($request->password),'pin_code'=>$code]);

       $resturant = Resturant::create($request->all());

       $resturant->api_token = $this->quickRandom(60);//Str::random(60);

       //$client->city()->attach($request->city_id);

       $resturant->save();
        //return redirect('/');

        return responseJson(status:1,message:'تم الاضافة بنجاح ',data:[
            'api_token'=>$resturant->api_token,
            'resturant'=>$resturant
        ]);

    }

    public static function quickRandom($length = 16)
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }

    public function resturantLogin(Request $request)
    {
        
        $Validator = Validator()->make($request->all(), [

        'email' => 'required',
        'password' => 'required',
        ]);

       if ($Validator->fails()) {

            return responseJson(status:0,message:$Validator->errors()->first(),data:$Validator->errors());  
       } 

       $resturant = Resturant::where('email',$request->email)->first();

       if ($resturant) {
            

           if (Hash::check($request->password,$resturant->password)) {
              // return redirect('/'); 
              return responseJson(status:1,message:"تم تسجيل الدخول بنجاح ",data:[
                'api_token'=>$resturant->api_token,
                'resturant'=>$resturant 
                ]);
               

           } else {
               
                 return responseJson(status:0,message:"يانات غير صحيحة ",data:['nn']); 
               
              }
           

       } else

        {
          return responseJson(status:0,message:"يانات غير صحيحة ",data:['mm']);   
       }
       

    }
    
    public function resetPassword(Request $request)
    {
        
       $user = Resturant::where('phone',$request->phone)->first();

       if ($user) {
             
             $code = rand(1111,9999);

             $update = $user->update(['pin_code'=>$code]);  


           if ($update) {
             //sms 

             //emails
            
            Mail::to($user->email)
                 ->bcc("gogoyoyo646@gmail.com")
                 ->send(new ResetPassword($user));

              return responseJson(status:1,message:"برجاء فحص هاتفك ",data:[
                'pin_code_test'=> $code,

                ]);

            } else {
               
                return responseJson(status:0,message:"حاول مرة اخري ",data:[]); 

            }
           

       } else

        {
          return responseJson(status:0,message:"رقم التلفون غير صحيح ",data:[]);   
       }
       

    }



    public function newPassword(Request $request)

    {
        $Validator = Validator()->make($request->all(), [

        'pin_code' => 'required',
        'password' => 'required|confirmed',

        ]);

       if ($Validator->fails()) {

            return responseJson(status:0,message:$Validator->errors()->first(),data:$Validator->errors());  
       } 

       $resturant = Resturant::where('pin_code',$request->pin_code)->where('pin_code','!=',0)->first();

       if ($resturant) {

        //$code= rand(1111,9999);

       //$request->merge(['password'=>bcrypt($request->password),'pin_code'=>$code]);

            $resturant->password = bcrypt($request->password);

            $resturant->pin_code =rand(1111,9999); 
       //$clients = Client::update($request->all());

           if ($resturant->save()) {

              return responseJson(status:1,message:"تم تغيير كلمة المرور بنجاح ",data:[
                'new-password'=>$resturant->password,
                 
                ]);

           } else {
               
                return responseJson(status:0,message:"حاول مرة اخري ",data:[]); 

           }
           

       } else

        {
          return responseJson(status:0,message:"هذا الكود غير صحيح ",data:[]);   
       }
       

    }

    public function profile(Request $request)
    {
        $Validator = Validator()->make($request->all(), [

        'password' => 'confirmed',
        'email' =>Rule::unique('clients')->ignore($request->user()->id),
        'phone' =>Rule::unique('clients')->ignore($request->user()->id),

        ]);

       if ($Validator->fails()) {

            return responseJson(status:0,message:$Validator->errors()->first(),data:$Validator->errors());  
       } 

       $loginUser = $request->user();

          
       $loginUser->update($request->all());

       if ($request->has('password')) {
           
           $loginUser->password = bcrypt($request->password);
           
       } 

          $loginUser->save();
           return responseJson(status:1,message:"تم التحديث بنجاح ",data:[]); 

     


    }
    public function registerToken(Request $request)

    {
        $Validator = Validator()->make($request->all(), [

        'token' => 'required',
        'platform' => 'required|in:android,ios',

        ]);

       if ($Validator->fails()) {

            return responseJson(status:0,message:$Validator->errors()->first(),data:$Validator->errors());  
       } 

        Token::where('token',$request->token)->delete();

          $data = $request->user()->tokenable()->create($request->all());
       
           return responseJson(status:1,message:"تم التسجيل بنجاح ",data:[$data]);   
       
       

    }
     


      public function removeToken(Request $request)

    {
        $Validator = Validator()->make($request->all(), [

        'token' => 'required',
      

        ]);

       if ($Validator->fails()) {

            return responseJson(status:0,message:$Validator->errors()->first(),data:$Validator->errors());  
       } 

        Token::where('token',$request->token)->delete();

         
       
           return responseJson(status:1,message:"تم الحذف بنجاح ",data:[]);   
       
       

    }

    



}
