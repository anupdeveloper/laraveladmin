@extends('adminlte::page')

@section('title', 'Deleted Roles')

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
            <table style="width:100%" id="roles-list" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th class="display-none"></th>
                  <th>{{ __('adminlte::adminlte.name') }}</th>
                  <!-- <th>{{ __('adminlte::adminlte.permissions') }}</th> -->
                  @can('manage_recycle_bin_roles')
                    <th>{{ __('adminlte::adminlte.actions') }}</th>
                  @endcan
                </tr>
              </thead>
              <tbody>
                <?php for ($i=0; $i < count($deletedRoles); $i++) { ?>
                  <tr>
                    <th class="display-none"></th>
                    <td>{{ $deletedRoles[$i]->name }}</td>
                    <!-- <td>
                      @foreach($deletedRoles[$i]->permissions as $permissions)
                        {{ $permissions->name }}
                      @endforeach
                    </td> -->
                    @can('manage_recycle_bin_roles')
                      <td>
                        @can('restore_roles')
                          <a class="action-button restore-button" title="Delete" href="javascript:void(0)" data-id="{{ $deletedRoles[$i]->id}}"><i class="text-success fa fa-undo"></i></a>
                        @endcan
                        @can('permanent_delete_roles')
                          <a class="action-button remove-button" title="Permanent Delete" href="javascript:void(0)" data-id="{{ $deletedRoles[$i]->id}}"><i class="text-danger fa fa-trash"></i></a>
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

    $('.restore-button').click(function(e) {
      var id = $(this).attr('data-id');
      // var obj = $(this);
      // console.log("ID - ", id);
      // console.log("obj - ", obj);
      swal({
        title: "Are you sure?",
        text: "Are you sure you want to move this Role to the Recycle Bin?",
        type: "warning",
        showCancelButton: true,
      }, function(willDelete) {
        if (willDelete) {
          $.ajax({
            url: "{{ route('restore_role') }}",
            type: 'post',
            data: {
              id: id
            },
            dataType: "JSON",
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
              if(response.success) {
                window.location.reload();
              }
              else {
                alert("Something went wrong!");
              }
              /* console.log("response", response);
              obj.parent().parent().remove(); */
            }
          });
        } 
      });
    });

    $('.remove-button').click(function(e) {
      var id = $(this).attr('data-id');
      var obj = $(this);
      swal({
        title: "Are you sure?",
        text: "Are you sure you want to Permanently Delete this Record?",
        type: "warning",
        showCancelButton: true,
      }, function(willDelete) {
        if (willDelete) {
          $.ajax({
            url: "{{ route('permanent_delete_role') }}",
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
