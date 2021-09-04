@extends('adminlte::page')

@section('title', 'Bookmarked Jobs')

@section('content_header')
  <h1>{{ __('adminlte::adminlte.bookmarked_jobs') }}</h1>
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
            <table style="width:100%" id="bookmarked-jobs" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th class="display-none"></th>
                  <th>{{ __('adminlte::adminlte.reference_number') }}</th>
                  <th>{{ __('adminlte::adminlte.job_title') }}</th>
                  <th>{{ __('adminlte::adminlte.bookmarked_by') }}</th>
                  <th>{{ __('adminlte::adminlte.actions') }}</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  for ($i=0; $i < count($bookmarkedJobs); $i++) {
                    $bookmarkedJob = $bookmarkedJobs[$i];
                    $job = \App\Models\Job::find($bookmarkedJob->job_id);
                    $organization = \App\Models\Organization::with('jobs')->find($job->organization_id);
                    $user = \App\Models\User::find($bookmarkedJob->user_id);
                ?>
                <tr>
                  <td class="display-none"></td>
                  <td><a class="link-text" href="{{ route('view_job', ['id' => $job->id]) }}">{{ $job->job_ref_number }}<a></td>
                  <td>{{ $job->job_title }}</td>
                  <td><a class="link-text" href="{{ route('view_jobseeker', ['id' => $user->id]) }}">{{ $user->first_name ? $user->first_name.' '.$user->last_name : $user->email }}</a></td>
                  <td>
                    <a class="action-button" title="View" href="{{route('view_bookmarked_job', ['id'=>$bookmarkedJob->id])}}"><i class="text-info fa fa-eye"></i></a>
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
@stop

@section('js')
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script>
    $('#bookmarked-jobs').DataTable( {
      columnDefs: [ {
        targets: 0,
        render: function ( data, type, row ) {
          return data.substr( 0, 2 );
        }
      }]
    });
  </script>
@stop
