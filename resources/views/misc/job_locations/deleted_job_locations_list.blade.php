@extends('adminlte::page')

@section('title', 'Deleted Job Locations')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header alert d-flex justify-content-between align-items-center">
            <h3>{{ __('adminlte::adminlte.deleted_job_locations') }}</h3>
            <a class="btn btn-sm btn-success invisible" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
          </div>           
          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
            <table style="width:100%" id="deletedJobLocations" class="table table-bordered table-hover">
              <thead>
              <tr>
                  <th class="display-none"></th>
                  <th>{{ __('adminlte::adminlte.name') }}</th>
                  <th>{{ __('adminlte::adminlte.status') }}</th>
                  @can('manage_recycle_bin_job_locations')
                    <th>{{ __('adminlte::adminlte.actions') }}</th>
                  @endcan
                </tr>
              </thead>
              <tbody>
                <?php for ($i=0; $i < count($deletedJobLocations); $i++) { 
                  $organisation = \App\Models\Organization::where('id', $deletedJobLocations[$i]->organization_id)->get();
                  $jobTypeTrimmed = str_replace('_', ' ', $deletedJobLocations[$i]->job_type);
                  $jobType = ucwords($jobTypeTrimmed);
                ?>
                <tr>
                  <th class="display-none"></th>
                  <td>{{ $deletedJobLocations[$i]->name }}</td>
                  <td>{{ $deletedJobLocations[$i]->status ? 'Active' : 'Inactive' }}</td>
                  @can('manage_recycle_bin_job_locations')
                    <td>
                      @can('restore_job_locations')
                        <a class="action-button restore-button" title="Restore" href="javascript:void(0)" data-id="{{ $deletedJobLocations[$i]->id}}"><i class="text-success fa fa-undo"></i></a>
                      @endcan
                      @can('permanent_delete_job_locations')
                        <a class="action-button remove-button" title="Permanent Delete" href="javascript:void(0)" data-id="{{ $deletedJobLocations[$i]->id}}"><i class="text-danger fa fa-trash"></i></a>
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
      $('#deletedJobLocations').DataTable( {
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
      var obj = $(this);
      swal({
        title: "Are you sure?",
        text: "Are you sure you want to restore this Job Location?",
        type: "warning",
        showCancelButton: true,
      }, function(willDelete) {
        if (willDelete) {
          $.ajax({
            url: "{{ route('restore_job_location') }}",
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
            url: "{{ route('permanent_delete_job_location') }}",
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
