@extends('adminlte::page')

@section('title', 'Deleted Job Qualifications')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header alert d-flex justify-content-between align-items-center">
            <h3>Deleted Job Qualifications</h3>
          </div>            
          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
            <table style="width:100%" id="jobQualifications" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th class="display-none"></th>
                  <th>{{ __('adminlte::adminlte.name') }}</th>
                  <th>{{ __('adminlte::adminlte.job_industry') }}</th>
                  <th>{{ __('adminlte::adminlte.status') }}</th>
                  @can('manage_recycle_bin_job_qualifications')
                  <th>{{ __('adminlte::adminlte.actions') }}</th>
                  @endcan
                </tr>
              </thead>
              <tbody>
                <?php for ($i=0; $i < count($deletedJobQualifications); $i++) { 
                  $organisation = \App\Models\Organization::where('id', $deletedJobQualifications[$i]->organization_id)->get();
                  $jobTypeTrimmed = str_replace('_', ' ', $deletedJobQualifications[$i]->job_type);
                  $jobType = ucwords($jobTypeTrimmed);
                ?>
                <tr>
                  <th class="display-none"></th>
                  <td>{{ $deletedJobQualifications[$i]->name }}</td>
                  <td>{{ App\Models\JobIndustry::where('id', $deletedJobQualifications[$i]->job_industry_id)->withTrashed()->first()->name }}</td>
                  <td>{{ $deletedJobQualifications[$i]->status ? 'Active' : 'Inactive' }}</td>
                  @can('manage_recycle_bin_job_qualifications')
                    <td>
                      @can('restore_job_qualifications')
                        <a class="action-button restore-button" title="Delete" href="javascript:void(0)" data-id="{{ $deletedJobQualifications[$i]->id}}"><i class="text-success fa fa-undo"></i></a>
                      @endcan
                      @can('permanent_delete_job_qualifications')
                        <a class="action-button remove-button" title="Permanent Delete" href="javascript:void(0)" data-id="{{ $deletedJobQualifications[$i]->id}}"><i class="text-danger fa fa-trash"></i></a>
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
      $('#jobQualifications').DataTable( {
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
        text: "Are you sure you want to restore this Job Qualification?",
        type: "warning",
        showCancelButton: true,
      }, function(willDelete) {
        if (willDelete) {
          $.ajax({
            url: "{{ route('restore_job_qualification') }}",
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
            url: "{{ route('permanent_delete_job_qualification') }}",
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
