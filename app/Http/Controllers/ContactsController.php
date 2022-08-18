<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\City;
use App\Models\Client;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();
        $contacts = Contact::all();
         

        return view('contacts.index',compact('clients','contacts'));
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
        

        $id_client =Client::where('id',$request->id)->first()->id;
        Contact::create([
        'name'=>$request->name,
        'phone' => $request->phone,
        'email'=>$request->email,
        'message_type'=>$request->type ,
        'message'=>$request->text ,
        'client_id'=>$id_client ,



        'created_by'=>(Auth::user()->name),

    ]);

       session()->flash('add','تم اضافة القسم بنجاح ');
      
      return redirect('/client-contact-us');
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
        //
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

       Contact::find($id)->delete();
        session()->flash('delete','تم حذف القسم بنجاح');
        return redirect('/contacts');
    }
    public function search(Request $request)
    {
        $clients = Client::all();
       

        $contacts = Contact::where('message_type','like',$request->search)->get();
        //dd($search);
              return view('contacts.index',compact('clients','contacts'));
    }
}
