@extends('adminlte::page')

@section('title', 'School List')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header alert d-flex justify-content-between align-items-center">
          <h3>{{ __('adminlte::adminlte.school') }}</h3>
          @can('add_jobseeker')<a class="btn btn-sm btn-success" href="{{ route('add_school') }}">{{ __('adminlte::adminlte.add_new_school') }}</a>@endcan
        </div>
        <div class="card-body">
          @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
          @endif
          <table style="width:100%" id="jobseekers-list" class="table table-bordered table-hover">
            <thead>
              <tr>
                  <th class="display-none"></th>
                <th>{{ __('adminlte::adminlte.email') }}</th>
                <th>{{ __('adminlte::adminlte.name') }}</th>
                <th>{{ __('adminlte::adminlte.contact_number') }}</th>
                <th>{{ __('adminlte::adminlte.status') }}</th>
                <th>{{ __('adminlte::adminlte.actions') }}</th>
              </tr>
            </thead>
            <tbody>
              <?php for ($i=0; $i < count($school_list); $i++) { ?>
              <tr>
                  <th class="display-none"></th>
                <td>{{ $school_list[$i]->email }}</td>
                <td>{{ $school_list[$i]->name }}</td>
                <td>{{ $school_list[$i]->phone ? $school_list[$i]->phone : '' }}</td>

                <td>{{ $school_list[$i]->status ? 'Active' : 'Inactive' }}</td>
                <!--{{ Auth()->user()->role->permissions }}-->


                  <td>

                    @can('view_school')
                      <a class="action-button" title="View" href="view/{{$school_list[$i]->id}}"><i class="text-info fa fa-eye"></i></a>
                    @endcan
                    @can('edit_school')
                      <a class="action-button" title="Edit" href="edit/{{$school_list[$i]->id}}"><i class="text-warning fa fa-edit"></i></a>
                    @endcan
                    @can('delete_school')
                      <a class="action-button delete-button" title="Delete" href="javascript:void(0)" data-id="{{ $school_list[$i]->id}}"><i class="text-danger fa fa-trash-alt"></i></a>
                    @endcan
                  </td>

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
      $('#jobseekers-list').DataTable( {
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
        text: "Are you sure you want to move this School to the Recycle Bin?",
        type: "warning",
        showCancelButton: true,
      }, function(willDelete) {
        if (willDelete) {
          $.ajax({
            url: "{{ route('delete_school') }}",
            method: "DELETE",
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
