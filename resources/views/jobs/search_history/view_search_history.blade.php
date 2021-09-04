@extends('adminlte::page')

@section('title', 'Search History Details')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header alert d-flex justify-content-between align-items-center">
          <h3>Search History Details</h3>
          <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
        </div>        
        <div class="card-body job-history">
          @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
          @endif
          
          <form class="form_wrap">

            <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.posted_within') }}</label>
                  <input class="form-control" placeholder="{{ $jobSearchHistory->posted_within_days ? $jobSearchHistory->posted_within_days.' Days' : '' }}" readonly>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.job_industry') }}</label>
                  <div class="job-description" style="{{ is_countable($jobIndustries) && count($jobIndustries) > 1 ? 'height: fit-content' : 'height: 50px'}}">
                    <?php for ($i=0; $i < count(is_countable($jobIndustries)?$jobIndustries:[]); $i++) { ?>
                      {{ $jobIndustries[$i]->name }}<br/>
                    <?php } ?>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.distance') }}</label>
                  <input class="form-control" placeholder="{{ $jobSearchHistory->distance ? $jobSearchHistory->distance.' KM' : '' }}" readonly>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.job_type') }}</label>
                  <div class="job-description" style="{{ is_countable($jobTypes) && count($jobTypes) != null ? 'height: fit-content' : 'height: 50px'}}">
                    <?php for ($i=0; $i < count(is_countable($jobTypes)?$jobTypes:[]); $i++) { ?>
                      {{ ucwords(str_replace('_', ' ', $jobTypes[$i])) }}<br/>
                    <?php } ?>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.salary_range') }}</label>
                  <input class="form-control" placeholder="{{ $jobSearchHistory->salary_range != null ? '£'.$jobSearchHistory->salary_range : '' }}" readonly>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.keywords') }}</label>
                  <input class="form-control" placeholder="{{ $jobSearchHistory->keywords }}" readonly>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.search_history_location') }}</label>
                  <input class="form-control" placeholder="{{ $jobSearchHistory->location }}" readonly>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.searched_by') }}</label>
                  <a class="link-text" href="{{ $user ? route('view_jobseeker', ['id' => $user->id]) : '#' }}">
                  @php if($user) {
                    if($user && $user->first_name) {
                      $userName = $user->first_name.' '.$user->last_name;
                    }
                    else {
                      $userName = $user->email;
                    }
                  }
                  else {
                    $userName = $reportedJob->email_sent;
                  } @endphp
                  <input class="form-control" placeholder="{{ $userName }}" readonly></a>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.searched_date') }}</label>
                  <input class="form-control" placeholder="{{ date('d/m/y', strtotime($jobSearchHistory->created_at)) }}" readonly>
                </div>
              </div>
            </div>
            
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('css')
  <link rel="stylesheet" type="text/css" href="https://www.jquery-az.com/jquery/css/intlTelInput//demo.css">
  <style>
    .job-description { font-size: 13px; }
    img.job_image { width: 150px; object-fit: cover; border: 1px solid #343d49; padding: 5px; border-radius: 3px; }
    .job_image_show { padding: 10px 10px 30px 10px; }
  </style>
@stop

@section('js')
@stop
