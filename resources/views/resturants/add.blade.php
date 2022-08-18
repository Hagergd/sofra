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
     Add resturant
    
@endsection
@section('title2')

    resturants
@endsection
@section('sub_title2')
   Add resturant
    
@endsection

@section('content')

     <div class="row">

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('resturants.store') }}" method="post" enctype="multipart/form-data"
                        autocomplete="off">
                        {{ csrf_field() }}
                        {{-- 1 --}}

    <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">name:</label>
    <input type="text" name="resturant_name" class="form-control" id="exampleInputName" aria-describedby="nameHelp">
                                            
         
            
    <label for="recipient-name" class="col-form-label">resturant</label>
                                                <textarea class="form-control" name="about" id="about_id"  value=""></textarea>
                                                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input value=""
                        type="email" 
                        class="form-control" 
                        name="email" 
                        placeholder="Email address" required>
                    @if ($errors->has('email'))
                        <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input value=""
                        type="phone" 
                        class="form-control" 
                        name="phone" 
                        placeholder="phone" required>
                    @if ($errors->has('phone'))
                        <span class="text-danger text-left">{{ $errors->first('phone') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input value=""
                        type="password" 
                        class="form-control" 
                        name="password" 
                        placeholder="password" required>
                    @if ($errors->has('password'))
                        <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Whats_Phone</label>
                    <input value=""
                        type="phone" 
                        class="form-control" 
                        name="whats_phone" 
                        placeholder="phone" required>
                    @if ($errors->has('phone'))
                        <span class="text-danger text-left">{{ $errors->first('phone') }}</span>
                    @endif
                </div>
                                                 <label class="my-1 mr-2" for="inlineFormCustomSelectPref">region</label>
                                        <select name="region" id="region_id" class="form-control" required>
                                            <option value="" selected disabled> {{ $resturant->region->name }}</option>
                                            @foreach ($regions as $region)
                                                <option value="{{ $region->id }}">{{ $region->name }}</option>
                                            @endforeach
                                        </select>
                                     
                                                
                                            </div>
                                            <div>
                                                
                                                <label for="name" class="col-form-label">lowest_price:</label>
                                                <input type="text" name="lowest_price" id="Lowest_price" value=""><label for="name" class="col-form-label">delivery_price:</label>
                                                <input type="text" name="delivery_price" id="delivery_price" value=""><label for="name" class="col-form-label">commission:</label>
                                                <input type="text" name="commission" id="Commision" value="">
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
