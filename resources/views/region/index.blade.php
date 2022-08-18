@extends('layouts.master')
@section('title')

    Sofra
@endsection
@section('css')
  <link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
  
    
@endsection
@section('title1')

    region
@endsection
@section('title2')
region
    
@endsection
@section('sub_title2')

    list of regions
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
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

   @if(session()->has('edit'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('edit') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

     @if(session()->has('delete'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('delete') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif



        <div class="row row-sm">
          <div class="col-xl-12">
            <div class="card">
              <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                  <a class="btn ripple btn-primary" data-target="#modaldemo1" data-toggle="modal" href="regions/create">Add</a>
                  <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
                
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table text-md-nowrap" id="example1">
                    <thead>
                      <tr>
                        <th class="wd-15p border-bottom-0">#</th>
                        <th class="wd-15p border-bottom-0"> region</th>
                        <th class="wd-15p border-bottom-0">city</th>
                        <th class="wd-15p border-bottom-0">Edit</th>
                        <th class="wd-15p border-bottom-0">Delete</th>
                        
                      </tr>
                    </thead>
                    <tbody>

                         <?php $i=0;  ?>
                                             @foreach($regions as $region)

                                               <?php $i++;  ?>

                                             <tr>
                        <td>{{$i}}</td>
                        <td>{{$region->name}}</td>
                        <td>{{$region->city->name}}</td>
                        <td><a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                       data-id="{{$region->id}}" data-region_name="{{$region->name}}" data-city_name="{{$region->city->name}}"
                                                      data-toggle="modal" href="#exampleModal2"
                                                       title="Edit"><i class="las la-pen"></i>Edit</a>
                        </td>
                        <td> <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                       data-id="{{$region->id}}" data-region_name="{{$region->name}}" data-city_name="{{$region->city->name}}"
                                                        data-toggle="modal"
                                                       href="#modaldemo9" title="delete" ><i class="las la-trash"></i>Delete</a>
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
<div class="modal" id="modaldemo1">
      <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
          <div class="modal-header">
            <h6 class="modal-title">add region</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <h6></h6>

   <form method="post" action="{{route('regions.store')}}">
                   @csrf
    <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">region</label>
    <input type="text" name="region_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">city</label>
                                        <select name="city" id="city_id" class="form-control" required>
                                            <option value="" selected disabled> --add--</option>
                                            @foreach ($cities as $city)
                                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                                            @endforeach
                                        </select>
                                    </div> 
  

  
     <div class="modal-footer">
            <button class="btn ripple btn-primary" type="submit">add</button>
            <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
          </div>
    </form>

          </div>
      </div>
</div>
    <!-- End Basic modal -->
          <!--div-->
          
        </div>
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit region</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <form action="regions/update" method="post" autocomplete="off">
                                            {{method_field('patch')}}
                                            {{csrf_field()}}
                                            <div class="form-group">
                                                <input type="hidden" name="id" id="id" value="">
                                                <label for="recipient-name" class="col-form-label">region</label>
                                                <input class="form-control" name="region_name" id="region_id" type="text" value="">
                                                 <label class="my-1 mr-2" for="inlineFormCustomSelectPref">city</label>
                                        <select name="city" id="city_id" class="form-control" required>
                                            <option value="" selected disabled> ----</option>
                                            @foreach ($cities as $city)
                                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                                            @endforeach
                                        </select>
                                     
                                                
                                            </div>
                                          
                                    
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">ok</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">close</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
</div>

            </div>            <!-- delete -->
<div class="modal" id="modaldemo9">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Delete region</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="regions/destroy" method="post">
                                    {{method_field('delete')}}
                                    {{csrf_field()}}
                                    <div class="modal-body">
                                        <p>Are you sure delete</p><br>
                                        <input type="hidden" name="id" id="id" value="">
                                        <input class="form-control" name="region_name" id="region_id" value="" type="text" readonly>
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
        $('#exampleModal2').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var region_name = button.data('region_name')
            var city_name = button.data('city_name')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #region_id').val(region_name);
            modal.find('.modal-body #city_id').val(city_name);
           
        })
    </script>


     <script>
        $('#modaldemo9').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var region_name = button.data('region_name')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #region_id').val(region_name);
        })
    </script>
@endsection
