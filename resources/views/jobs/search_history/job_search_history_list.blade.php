@extends('adminlte::page')

@section('title', 'Job Search History')

@section('content_header')
  <h1>Job Search History</h1>
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
                  <th>{{ __('adminlte::adminlte.keywords') }}</th>
                  <th>{{ __('adminlte::adminlte.searched_by') }}</th>
                  <!-- <th>{{ __('adminlte::adminlte.searched_date') }}</th> -->
                  <th>{{ __('adminlte::adminlte.actions') }}</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  for ($i=0; $i < count($jobSearchHistoryList); $i++) {
                    $jobSearchHistory = $jobSearchHistoryList[$i];
                    $user = \DB::table('users')->find($jobSearchHistory->user_id);
                ?>
                <tr>
                  <td class="display-none"></td>
                  <td>{{ $jobSearchHistory->keywords }}</td>
                  <td><a class="link-text" href="{{ $user ? route('view_jobseeker', ['id' => $user->id]) : '#' }}">{{ $user->first_name ? $user->first_name.' '.$user->last_name : $user->email }}</a></td>
                  <!-- <td>{{ date('d/m/y', strtotime($jobSearchHistory->created_at)) }}</td> -->
                  <td>
                    <a class="action-button" title="View" href="{{route('view_search_history', ['id'=>$jobSearchHistory->id])}}"><i class="text-info fa fa-eye"></i></a>
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
