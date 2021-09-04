@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
@stop

@section('content')
<div class="">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3>{{ __('adminlte::adminlte.roles') }}</h3>
          </div>
          <div class="card-body">
            @can('add_role')<a class="btn btn-sm btn-success float-right clear" href="add">Create New Role</a>@endcan
            <table style="width:100%" id="roles-list" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th class="display-none"></th>
                  <th>{{ __('adminlte::adminlte.name') }}</th>
                  @can('manage_roles_actions')<th>{{ __('adminlte::adminlte.actions') }}</th>@endcan
                </tr>
              </thead>
              <tbody>
                <?php for ($i=0; $i < count($roles); $i++) { ?>
                  <tr>
                    <th class="display-none"></th>
                    <td>{{ $roles[$i]->name }}</td>
                    @can('manage_roles_actions')
                      <td>
                        @can('view_role')
                          <a href="{{ route('view_role', ['id' => $roles[$i]->id]) }}" title="View"><i class="text-info fa fa-eye"></i></a>
                        @endcan
                        @can('edit_role')
                          <a title="Edit" href="{{ route('edit_role', ['id' => $roles[$i]->id]) }}"><i class="text-warning fa fa-edit"></i></a>
                        @endcan
                        @can('delete_role')
                          <a class="action-button delete-button" title="Delete" href="javascript:void(0)" data-id="{{ $roles[$i]->id}}"><i class="text-danger fa fa-trash-alt"></i></a>
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
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#roles-list').DataTable( {
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
      swal({
        title: "Are you sure?",
        text: "Are you sure you want to move this Role to the Recycle Bin?",
        type: "warning",
        showCancelButton: true,
      }, function(willDelete) {
        if (willDelete) {
          $.ajax({
            url: "{{ route('delete_role') }}",
            type: 'post',
            data: {
              id: id
            },
            dataType: "JSON",
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
              if(response.success == 1) {
                window.location.reload();
              }
              else {
                console.log(response);
                setTimeout(() => {
                  swal("Warning!", response.message, "warning");
                }, 500);
              }
            }
          });
        } 
      });
    });
  </script>
@stop
