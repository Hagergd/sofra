@extends('layouts.master')
@section('title')

    bloodbank
@endsection
@section('css')
<link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    
@endsection
@section('title1')
     Edit post
    
@endsection
@section('title2')

    posts
@endsection
@section('sub_title2')
   post
    
@endsection

@section('content')

     <div class="row">

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    
                    <form action="{{ url('update') }}/{{ $posts->id }} " method="post" enctype="multipart/form-data"
                        autocomplete="off">
                        {{ csrf_field() }}
                        {{-- 1 --}}
    
    <div class="mb-3">
        
    <label for="exampleInputEmail1" class="form-label">name:</label>
    <input type="text" name="post_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $posts->name }}">
    <input type="hidden" name="post_id" value="{{ $posts->id }}">
                                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">category:</label>
                                        <select name="category" id="category_id" class="form-control" required>
                                            
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        
                                         <label for="exampleTextarea">content:</label>
                                           <textarea class="form-control" id="exampleTextarea" name="content" rows="3" >{{ $posts->content }}</textarea>
                                        
                                         

                            <input type="file" name="pic" class="dropify" accept=".pdf,.jpg, .png, image/jpeg, image/png"
                                data-height="70" value="" />
                        
                                    </div> 
  

  
     <div class="modal-footer">
            <button class="btn ripple btn-primary" type="submit">update</button>
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
