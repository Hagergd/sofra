@extends('layouts.master')
@section('title')

    Sofra
@endsection
@section('css')
  <link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
  
    
@endsection
@section('title1')

    comments
@endsection
@section('title2')

    comments
@endsection
@section('sub_title2')

    list of comments
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
                  
                  <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
                
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table text-md-nowrap" id="example1">
                    <thead>
                      <tr>
                        <th class="wd-15p border-bottom-0">#</th>
                        <th class="wd-15p border-bottom-0"> Comment</th>
                        <th class="wd-15p border-bottom-0">Rate</th>
                        <th class="wd-15p border-bottom-0">Client</th>
                        <th class="wd-15p border-bottom-0">Resturant</th>
                        <th class="wd-15p border-bottom-0">Delete</th>

                        
                      </tr>
                    </thead>
                    <tbody>

                    <?php $i=0;  ?>

                    @foreach($comments as $comment)

                     <?php $i++;  ?>

                     <tr>
                        <td>{{$i}}</td>
                        <td>{{$comment->comment}}</td>
                        <td>{{$comment->rate}}</td>
                        <td>{{$comment->client->name}}</td>
                        <td>{{$comment->resturant->name}}</td>

                        <td> <a class="modal-effect btn  btn-danger btn-sm" href="#" data-id="{{ $comment->id }}" data-comment_name="{{ $comment->comment}}"
                                                            data-toggle="modal" data-target="#delete_post"><i
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
<div class="modal" id="delete_post">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Delete comment</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="comments/destroy" method="post">
                                    {{method_field('delete')}}
                                    {{csrf_field()}}
                                    <div class="modal-body">
                                        <p>Are you sure delete</p><br>
                                        <input type="hidden" name="id" id="id" value="">
                                        <input class="form-control" name="comment_name" id="comment_id" value="" type="text" readonly>
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
        $('#delete_post').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var comment_name = button.data('comment_name')
           var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #comment_id').val(comment_name);
        })
    </script>
@endsection
