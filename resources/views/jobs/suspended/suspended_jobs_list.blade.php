@extends('adminlte::page')

@section('title', 'Suspended Jobs')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header alert d-flex justify-content-between align-items-center">
            <h3>{{ __('adminlte::adminlte.suspended_jobs') }}</h3>
            <a class="btn btn-sm btn-success invisible" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
          </div>           
          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
            <!-- <a class="btn btn-sm btn-success float-right" href="{{ route('add_job') }}">{{ __('adminlte::adminlte.add_new_job') }}</a> -->
            <table style="width:100%" id="suspendJobs" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th class="display-none"></th>
                  <th>{{ __('adminlte::adminlte.reference_number') }}</th>
                  <th>{{ __('adminlte::adminlte.job_title') }}</th>
                  <th>{{ __('adminlte::adminlte.company') }}</th>
                  <th>{{ __('adminlte::adminlte.created_by') }}</th>
                  <th>{{ __('adminlte::adminlte.expiry_date') }}</th>
                  @can('resume_job')<th>{{ __('adminlte::adminlte.actions') }}</th>@endcan
                </tr>
              </thead>
              <tbody>
                <?php for ($i=0; $i < count($suspendJobs); $i++) { 
                  $organisation = \App\Models\Organization::find($suspendJobs[$i]->organization_id);
                  $recruiter = \App\Models\Recruiter::find($suspendJobs[$i]->recruiter_id);
                ?>
                <tr>
                  <th class="display-none"></th>
                  <td>{{ $suspendJobs[$i]->job_ref_number }}</td>
                  <td>{{ $suspendJobs[$i]->job_title }}</td>
                  <td>{{ $organisation ? $organisation->name : '' }}</td>
                  <td>
                    @if($recruiter)
                      <a href="{{ route('view_recruiter', [ 'id' => $recruiter->id ]) }}">
                        {{ $recruiter->first_name ? $recruiter->first_name.' '.$recruiter->last_name : $recruiter->email }}
                      <a>
                    @endif
                  </td>
                  <td>{{ $suspendJobs[$i]->expiring_at ? date('d/m/y', strtotime($suspendJobs[$i]->expiring_at)) : '' }}</td>
                  @can('resume_job')
                    <td>
                      @can('resume_job')
                        <a class="action-button" title="Resume" href="{{ route('resume_job', ['id' => $suspendJobs[$i]->id]) }}"><i class="text-primary fa fa-arrow-circle-up"></i></a>
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
      $('#suspendJobs').DataTable( {
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
        text: "Are you sure you want to move this Job to the Recycle Bin?",
        type: "warning",
        showCancelButton: true,
      }, function(willDelete) {
        if (willDelete) {
          $.ajax({
            url: "{{ route('delete_job') }}",
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
