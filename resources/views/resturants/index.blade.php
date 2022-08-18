@extends('layouts.master')
@section('title')

    Sofra
@endsection
@section('css')
  <link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
  
    
@endsection
@section('title1')

    resturants
@endsection
@section('title2')

    resturant
@endsection
@section('sub_title2')

    list of resturants
@endsection

@section('content')
@if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


   @if(session()->has('add'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('add') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-text="true">&times;</span>
            </button>
        </div>
    @endif

   @if(session()->has('edit'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('edit') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-text="true">&times;</span>
            </button>
        </div>
    @endif

     @if(session()->has('delete'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('delete') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-text="true">&times;</span>
            </button>
        </div>
    @endif



        <div class="row row-sm">
          <div class="col-xl-12">
            <div class="card">
              <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                  <a class="btn ripple btn-primary"  href="resturants/create">Add</a>
                  <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
                
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table text-md-nowrap" id="example1">
                    <thead>
                      <tr>
                        <th class="wd-15p border-bottom-0">#</th>
                        <th class="wd-15p border-bottom-0"> Name</th>
                        <th class="wd-15p border-bottom-0">About_resturant</th>
                        <th class="wd-15p border-bottom-0">Whats_phone</th>
                        <th class="wd-15p border-bottom-0">Phone</th>
                        <th class="wd-15p border-bottom-0">Email</th>     
                        <th class="wd-15p border-bottom-0">Region</th>
                        <th class="wd-15p border-bottom-0">Image</th>
                        <th class="wd-15p border-bottom-0">Lowest_price</th>
                        <th class="wd-15p border-bottom-0">Delivry_price</th>
                        <th class="wd-15p border-bottom-0">Commision</th>
                        <th class="wd-15p border-bottom-0">Status</th>
                        <th class="wd-15p border-bottom-0">Edit</th>
                        <th class="wd-15p border-bottom-0">Delete</th>
                        
                      </tr>
                    </thead>
                    <tbody>

                         <?php $i=0;  ?>
                                             @foreach($resturants as $resturant)

                                               <?php $i++;  ?>

                                             <tr>
                        <td>{{$i}}</td>
                        <td>{{$resturant->name}}</td>
                        <td>{{$resturant->about_resturant}}</td>
                        <td>{{$resturant->whats_phone}}</td>
                        <td>{{$resturant->phone}}</td>
                        <td>{{$resturant->email}}</td>
                        <td>{{$resturant->region->name}}</td>
                        <td>{{$resturant->image}}</td>
                        <td>{{$resturant->lowest_price}}</td>
                        <td>{{$resturant->delivery_price}}</td>
                        <td>{{$resturant->commission}}</td>
                        <td>{{$resturant->status}}</td>

                        <td><a href="{{ url('edit') }}/{{ $resturant->id }}"
                                                    class="btn  btn-primary btn-sm"
                                                    type="button">Edit<i class="fas fa" ></i></a>
                        </td>
                        <td> <a class="modal-effect btn  btn-danger btn-sm" href="#" data-id="{{ $resturant->id }}" data-resturant_name="{{ $resturant->name }}"
                                                            data-toggle="modal" data-target="#delete_resturant"><i
                                                                class="text-danger fas fa"></i>Delete</a>
                        </td>
                        
                      </tr>

                                              @endforeach

                      
                      
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!--/div-->

    <!-- End Basic modal -->
          <!--div-->
          
        </div>



            </div>            <!-- delete -->
<div class="modal" id="delete_resturant">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Delete resturant</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-text="true">&times;</span></button>
            </div>
            <form action="resturants/destroy" method="post">
                                    {{method_field('delete')}}
                                    {{csrf_field()}}
                                    <div class="modal-body">
                                        <p>Are you sure delete</p><br>
                                        <input type="hidden" name="id" id="id" value="">
                                        <input class="form-control" name="resturant_name" id="resturant_id" value="" type="text" readonly>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">cancel</button>
                                        <button type="submit" class="btn btn-danger">ok</button>
                                    </div>
            </div>
                </form>
                            
        
    </div>
</div>

        <!-- /row -->
      </div>

      <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection

    


@section('scripts')

    


     <script>
        $('#delete_resturant').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var resturant_name = button.data('resturant_name')
           var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #resturant_id').val(resturant_name);
        })
    </script>
@endsection
