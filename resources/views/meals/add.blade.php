@extends('layouts.master')
@section('title')
  Sofra
@endsection
@section('css')
<link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    
@endsection
@section('title1')
     Add meal
    
@endsection
@section('title2')

    meals
@endsection
@section('sub_title2')
   Add meal
    
@endsection

@section('content')

     <div class="row">

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('meals.store') }}" method="post" enctype="multipart/form-data"
                        autocomplete="off">
                        {{ csrf_field() }}
                        {{-- 1 --}}

    <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">name:</label>
    <input type="text" name="meal_name" class="form-control" id="exampleInputName" aria-describedby="nameHelp">
                                            
         
            
    <label for="recipient-name" class="col-form-label">meal</label>
                                                <textarea class="form-control" name="description" id="description"  ></textarea>
                                                <div class="mb-3">
                    
                </div>
                
                                                 <label class="my-1 mr-2" for="inlineFormCustomSelectPref">category</label>
                                        <select name="category" id="category_id" class="form-control" required>
                                            <option value="" selected disabled> </option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>

                                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">resturant</label>
                                        <select name="resturant" id="resturant_id" class="form-control" required>
                                            <option value="" selected disabled> </option>
                                            @foreach ($resturants as $resturant)
                                                <option value="{{ $resturant->id }}">{{ $resturant->name }}</option>
                                            @endforeach
                                        </select>
                                     
                                                
                                            </div>
                                            <div>
                                                
                                                <label for="name" class="col-form-label">price:</label>
                                                <input type="text" name="price" id="price" value="">
                                                <label for="name" class="col-form-label">offer_price:</label>
                                                <input type="text" name="offer_price" id="offer_price" value="">
                                                <label for="name" class="col-form-label">prepare_time:</label>
                                                <input type="text" name="time" id="time" value="">
                                            </div>
                                        

                            <input type="file" name="pic" class="dropify" accept=".pdf,.jpg, .png, image/jpeg, image/png"
                                data-height="70" />
                        
                                    </div> 
  

  
     <div class="modal-footer">
            <button class="btn ripple btn-primary" type="submit">add</button>
            <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
          </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    
@endsection
