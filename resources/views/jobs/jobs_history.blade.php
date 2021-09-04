@extends('adminlte::page')

@section('title', 'Jobs History')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header alert d-flex justify-content-between align-items-center">
            <h3>{{ __('adminlte::adminlte.jobs_history') }}</h3>
            <a class="btn btn-sm btn-success invisible" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
          </div>           
          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
            <!-- <a class="btn btn-sm btn-success float-right" href="{{ route('add_job') }}">{{ __('adminlte::adminlte.add_new_job') }}</a> -->
            <table style="width:100%" id="JobHistory" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th class="display-none"></th>
                  <th>{{ __('adminlte::adminlte.reference_number') }}</th>
                  <th>{{ __('adminlte::adminlte.job_title') }}</th>
                  <!-- <th>{{ __('adminlte::adminlte.job_type') }}</th>
                  <th>{{ __('adminlte::adminlte.industry') }}</th> -->
                  <th>{{ __('adminlte::adminlte.company') }}</th>
                  <th>{{ __('adminlte::adminlte.recruiter') }}</th>
                  <th>{{ __('adminlte::adminlte.actions') }}</th>
                </tr>
              </thead>
              <tbody>
                <?php for ($i=0; $i < count($jobHistory); $i++) { 
                  $organisation = \App\Models\Organization::find($jobHistory[$i]->organization_id);
                  $recruiter = \App\Models\Recruiter::find($jobHistory[$i]->recruiter_id);
                  $jobTypeTrimmed = str_replace('_', ' ', $jobHistory[$i]->job_type);
                  $jobType = ucwords($jobTypeTrimmed);
                  $jobIndustry = \App\Models\JobIndustry::find($jobHistory[$i]->job_industry_id);
                ?>
                <tr>
                  <th class="display-none"></th>
                  <td><a class="link-text" href="{{ route('view_job', ['id' => $jobHistory[$i]->job_id]) }}">{{ $jobHistory[$i]->job_ref_number }}</a></td>
                  <td>{{ $jobHistory[$i]->job_title }}</td>
                  <!-- <td>{{ $jobType }}</td>
                  <td>{{ $jobIndustry->name }}</td> -->
                  <td>{{ $organisation ? $organisation->name : '' }}</td>
                  <td>
                    @if($recruiter)
                      <a class="link-text" href="{{ route('view_recruiter', [ 'id' => $recruiter->id ]) }}">
                        {{ $recruiter->first_name ? $recruiter->first_name.' '.$recruiter->last_name : $recruiter->email }}
                      <a>
                    @endif
                  </td>
                  <td>
                    <a class="action-button" title="View" href="view_job_history/{{ $jobHistory[$i]->id}} "><i class="text-info fa fa-eye"></i></a>
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
    $('#JobHistory').DataTable( {
      columnDefs: [ {
        targets: 0,
        render: function ( data, type, row ) {
          return data.substr( 0, 2 );
        }
      }]
    });
  </script>
@stop
