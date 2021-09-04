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
          <h3>{{ __('adminlte::adminlte.course_list') }}</h3>
          @can('add_jobseeker')<a class="btn btn-sm btn-success" href="{{ route('add_course') }}">{{ __('adminlte::adminlte.add_new') }}</a>@endcan
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
                <th>{{ __('adminlte::adminlte.name') }}</th>
                <th>{{ __('adminlte::adminlte.school_name') }}</th>
                <th>Course Code</th>
                <th>Subject</th>
                <th>Created By</th>
                <th>{{ __('adminlte::adminlte.status') }}</th>
                @can('manage_jobseekers_actions')<th>{{ __('adminlte::adminlte.actions') }}</th>@endcan
              </tr>
            </thead>
            <tbody>
              <?php for ($i=0; $i < count($list); $i++) { ?>
              <tr>
                  <th class="display-none"></th>
                <td>{{ $list[$i]->name }}</td>
                <td>{{ $list[$i]->get_school_detail[0]->name }}</td>
                <td>{{ $list[$i]->course_code ? $list[$i]->course_code : '' }}</td>
                <td>{{ $list[$i]->subject }}</td>
                <td>{{ $list[$i]->get_user_detail->first_name }}</td>
                <td>{{ $list[$i]->status ? 'Active' : 'Inactive' }}</td>
                @can('manage_jobseekers_actions')
                  <td>
                    @can('view_jobseeker')
                      <!--a class="action-button" title="View" href="view/{{$list[$i]->id}}"><i class="text-info fa fa-eye"></i></a-->
                    @endcan
                    @can('edit_jobseeker')
                      <a class="action-button" title="Edit" href="edit/{{$list[$i]->id}}"><i class="text-warning fa fa-edit"></i></a>
                    @endcan
                    @can('delete_jobseeker')
                      <a class="action-button delete-button" title="Delete" href="javascript:void(0)" data-id="{{ $list[$i]->id}}"><i class="text-danger fa fa-trash-alt"></i></a>
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
        text: "Are you sure you want to move this Course to the Recycle Bin?",
        type: "warning",
        showCancelButton: true,
      }, function(willDelete) {
        if (willDelete) {
          $.ajax({
            url: "{{ route('delete_course') }}",
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
