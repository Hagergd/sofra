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
     Edit password
    
@endsection
@section('title2')

    admin
@endsection
@section('sub_title2')
   admin
    
@endsection

@section('content')

     <div class="bg-light p-4 rounded">
        <h1>Update user</h1>
        <div class="lead">
            
        </div>
        
        <div class="container mt-4">
            
            <form method="post" action="{{ url('update-password') }}/{{ $user->id }}">
                @method('post')
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">password</label>
                    <input value="{{ $user->password }}" 
                        type="text" 
                        class="form-control" 
                        name="password" 
                        placeholder="password" required>

                    @if ($errors->has('name'))
                        <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                

                <button type="submit" class="btn btn-primary">Update password</button>
                <a href="{{ route('admin.index') }}" class="btn btn-default">Cancel</a>
            </form>
            
        </div>

    </div>
@endsection

@section('scripts')

    
@endsection
