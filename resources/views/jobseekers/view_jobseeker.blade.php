@extends('adminlte::page')

@section('title', 'Job Seeker Information')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header alert d-flex justify-content-between align-items-center">
          <h3>{{ __('adminlte::adminlte.jobseeker_information') }}</h3>
          <!-- <a class="btn btn-sm btn-success" href="{{ route('jobseekers_list') }}">Back to Jobseekers</a>
          <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">Back to Prevous Page</a> -->
          <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
        </div>
        <div class="card-body">
          @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
          @endif

          <form class="form_wrap">
            <div class="row">
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.name') }}</label>
                  <input class="form-control" placeholder="{{ $jobseeker[0]->first_name }} {{ $jobseeker[0]->last_name }}" readonly>
                </div>
              </div>
              <!-- <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>First Name</label>
                  <input class="form-control" readonly>
                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>Last Name</label>
                  <input class="form-control" readonly>
                </div>
              </div> -->
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.email') }}</label>
                  <input class="form-control" placeholder="{{ $jobseeker[0]->email }}" readonly>
                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.contact_number') }}</label>
                  <input class="form-control" placeholder="{{ $jobseeker[0]->phone_number ? $jobseeker[0]->phone_number : '' }}" readonly>
                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.ip_address') }}</label>
                  <input class="form-control" placeholder="{{ $jobseeker[0]->ip_address ? $jobseeker[0]->ip_address : '' }}" readonly>
                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>Signup Via</label>
                  <input class="form-control" placeholder="{{ ucfirst($jobseeker[0]->signup_via) }}" readonly>
                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.email_verification_status') }}</label>
                  <input class="form-control" placeholder="{{ $jobseeker[0]->is_email_verified == 1 ? 'Verified' : 'Not Verified' }}" readonly>
                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.email_verification_date') }}</label>
                  <input class="form-control" placeholder="{{ $jobseeker[0]->is_email_verified == 1 ? date('d/m/y', strtotime($jobseeker[0]->email_verified_at)) : '' }}" readonly>
                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.user_locked_status') }}</label>
                  <input class="form-control" placeholder="{{ $jobseeker[0]->is_user_locked == 1 ? 'Locked' : 'Not Locked' }}" readonly>
                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.user_locked_date') }}</label>
                  <input class="form-control" placeholder="{{ $jobseeker[0]->is_user_locked == 1 ? date('d/m/y', strtotime($jobseeker[0]->user_locked_at)) : '' }}" readonly>
                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.job_alerts_status') }}</label>
                  <input class="form-control" placeholder="{{ $jobseeker[0]->is_job_alert_enabled == 1 ? 'Enabled' : 'Disabled' }}" readonly>
                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.created_date') }}</label>
                  <input class="form-control" placeholder="{{ $jobseeker[0]->created_at ? date('d/m/y', strtotime($jobseeker[0]->created_at)) : '' }}" readonly>
                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.last_updated_date') }}</label>
                  <input class="form-control" placeholder="{{ $jobseeker[0]->updated_at ? date('d/m/y', strtotime($jobseeker[0]->updated_at)) : '' }}" readonly>
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
@stop

@section('js')
@stop
