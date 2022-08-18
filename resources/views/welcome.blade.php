
@extends('layouts.master')
@section('title')
Sofra
@endsection
@section('css')

    
@endsection
@section('title1')

    Home
@endsection
@section('title2')

    home
@endsection
@section('sub_title2')
dashbord
@endsection

@section('content')
     <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        @inject('client','App\Models\Client')
        @inject('contact','App\Models\Contact')
        @inject('order','App\Models\Order')
        @inject('offer','App\Models\Offer')
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Contacts</span>
                <span class="info-box-number">{{$contact->count()}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="fa fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Client</span>
                <span class="info-box-number">{{$client->count()}}</</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Orders</span>
                <span class="info-box-number">{{$order->count()}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-danger"><i class="far fa-star"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Offers</span>
                <span class="info-box-number">{{$offer->count()}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    
@endsection

@section('scripts')

    
@endsection








 