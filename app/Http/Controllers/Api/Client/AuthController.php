<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Login;
use App\Models\Token;
use App\Models\Comment;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
//use Illuminate\Support\Facades\Rule;
use Illuminate\Validation\Rule;


class AuthController extends Controller
{   
    public function clientRegister(Request $request)
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

       $client = Client::create($request->all());

       $client->api_token = $this->quickRandom(60);
       //Str::random(60);

       //$client->city()->attach($request->city_id);

       $client->save();
        //return redirect('/');

        return responseJson(status:1,message:'تم الاضافة بنجاح ',data:[
            'api_token'=>$client->api_token,
            'client'=>$client
        ]);

    }

    public static function quickRandom($length = 16)
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }

    public function clientLogin(Request $request)
    {
        
        $Validator = Validator()->make($request->all(), [

        'email' => 'required',
        'password' => 'required',
        ]);

       if ($Validator->fails()) {

            return responseJson(status:0,message:$Validator->errors()->first(),data:$Validator->errors());  
       } 

       $client = Client::where('email',$request->email)->first();

       if ($client) {
            

           if (Hash::check($request->password,$client->password)) {
              // return redirect('/'); 
              return responseJson(status:1,message:"تم تسجيل الدخول بنجاح ",data:[
                'api_token'=>$client->api_token,
                'client'=>$client 
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
        
       $user = Client::where('phone',$request->phone)->first();

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

       $client = Client::where('pin_code',$request->pin_code)->where('pin_code','!=',0)->first();

       if ($client) {

        //$code= rand(1111,9999);

       //$request->merge(['password'=>bcrypt($request->password),'pin_code'=>$code]);

            $client->password = bcrypt($request->password);

            $client->pin_code =rand(1111,9999); 
       //$clients = Client::update($request->all());

           if ($client->save()) {

              return responseJson(status:1,message:"تم تغيير كلمة المرور بنجاح ",data:[
                'new-password'=>$client->password,
                 
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

           return responseJson(status:1,message:"تم التحديث بنجاح ",data:$loginUser); 

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

          $data = $request->user()->tokens()->create($request->all());
       
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
    public function contactUs(Request $request)
    {
       $Validator = Validator()->make($request->all(), [

        'name' => 'required',
        'email' => 'required',
        'phone' => 'required',
        'message' => 'required',
        'message_type' => 'required',

      ]);

      if ($Validator->fails()) {

        return responseJson(status:0,message:$Validator->errors()->first(),data:$Validator->errors());    
       }  
           if ($request->has('client_id')){
            
             $contacts = $request->user()->contacts()->create($request->all());
    
             return responseJson(status:1,message:'success',data:$contacts);
            }
    }

    

}
