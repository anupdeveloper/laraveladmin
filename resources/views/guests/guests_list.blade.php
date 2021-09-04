@extends('adminlte::page')

@section('title', 'Guests')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header alert d-flex justify-content-between align-items-center">
          <h3>{{ __('adminlte::adminlte.guests') }}</h3>
        </div>        
        <div class="card-body">
          @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
          @endif
          <table style="width:100%" id="guests-list" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th class="display-none"></th>
                <th>{{ __('adminlte::adminlte.email') }}</th>
                <th>{{ __('adminlte::adminlte.created_at') }}</th>
                @can('manage_guests')<th>{{ __('adminlte::adminlte.actions') }}</th>@endcan
              </tr>
            </thead>
            <tbody>
              <?php for ($i=0; $i < count($guestsList); $i++) { ?>
              <tr>
                <th class="display-none"></th>
                <td>{{ $guestsList[$i]->email }}</td>
                <td>{{ $guestsList[$i]->created_at ? date('d/m/y', strtotime($guestsList[$i]->created_at)) : '' }}</td>
                @can('manage_guests')
                  <td>
                    @can('view_guest')
                      <a class="action-button" title="View" href="{{ route('view_guest', ['id' => $guestsList[$i]->id]) }}"><i class="text-info fa fa-eye"></i></a>
                    @endcan
                    @can('view_guest_resume')
                    <?php
                      $resumePath = config('adminlte.website_url').'guest_resume/';
                      $extension = explode('.', $guestsList[$i]->resume)[1];
                    ?>
                      <a class="action-button" target="_blank" title="View Resume" href="{{ $resumePath.$guestsList[$i]->resume }}"><i class="text-success fa fa-file-alt"></i></a>
                    @endcan
                  </td>
                @endcan
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
@stop

@section('js')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#guests-list').DataTable( {
        columnDefs: [ {
          targets: 0,
          render: function ( data, type, row ) {
            return data.substr( 0, 2 );
          }
        }]
      });
    });
    
    $('.delete-button').click(function(e) {
      var id = $(this).attr('data-id');
      var obj = $(this);
      // console.log({id});
      swal({
        title: "Are you sure?",
        text: "Are you sure you want to move this Jobseeker to the Recycle Bin?",
        type: "warning",
        showCancelButton: true,
      }, function(willDelete) {
        if (willDelete) {
          $.ajax({
            url: "{{ route('delete_jobseeker') }}",
            type: 'post',
            data: {
              id: id
            },
            dataType: "JSON",
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
              console.log("Response", response);
              if(response.success == 1) {
                window.location.reload();
                /* console.log("response", response);
                obj.parent().parent().remove(); */
              }
              else {
                console.log("FALSE");
                setTimeout(() => {
                alert("Something went wrong! Please try again.");
                }, 500);
                // swal("Error!", "Something went wrong! Please try again.", "error");
                // swal("Something went wrong! Please try again.");
              }
            }
          });
        } 
      });
    });
  </script>
@stop
