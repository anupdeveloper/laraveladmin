@extends('adminlte::page')

@section('title', 'Recruiter Information')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header alert d-flex justify-content-between align-items-center">
          <h3>{{ __('adminlte::adminlte.recruiter_information') }}</h3>
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
                  <?php $name;
                    if($recruiter[0]->first_name) {
                      $name = $recruiter[0]->first_name.' '.$recruiter[0]->last_name;
                    }
                    else if($recruiter[0]->name) {
                      $name = $recruiter[0]->name;
                    }
                    else {
                      $name = "";
                    }
                  ?>
                  <input class="form-control" placeholder="{{ $name }}" readonly>
                </div>
              </div>
              <!-- <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>First Name</label>
                  <input class="form-control" placeholder="" readonly>
                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>Last Name</label>
                  <input class="form-control" placeholder="" readonly>
                </div>
              </div> -->
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.email') }}</label>
                  <input class="form-control" placeholder="{{ $recruiter[0]->email ? $recruiter[0]->email : '' }}" readonly>
                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.contact_number') }}</label>
                  <input class="form-control" placeholder="{{ $recruiter[0]->phone_number ? $recruiter[0]->phone_number : '' }}" readonly>
                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>Signup Via</label>
                  <input class="form-control" placeholder="{{ ucfirst($recruiter[0]->signup_via) }}" readonly>
                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.status') }}</label>
                  <input class="form-control" placeholder="{{ ucwords($recruiter[0]->status) }}" readonly>
                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.is_parent') }}</label>
                  <input class="form-control" placeholder="{{ $recruiter[0]->is_parent ? 'Yes' : 'No' }}" readonly>
                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.ip_address') }}</label>
                  <input class="form-control" placeholder="{{ $recruiter[0]->ip_address }}" readonly>
                </div>
              </div>
              <!-- <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>Logged In With</label>
                  <input class="form-control" readonly>
                </div>
              </div> -->
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.last_logged_in_date_time') }}</label>
                  <input class="form-control" placeholder="{{ $recruiter[0]->last_logged_in_at ? date('d/m/y', strtotime($recruiter[0]->last_logged_in_at)) : '' }}" readonly>
                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.email_verification_status') }}</label>
                  <input class="form-control" placeholder="{{ $recruiter[0]->is_email_verified ? 'Verified' : 'Unverified' }}" readonly>
                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.email_verification_date') }}</label>
                  <input class="form-control" placeholder="{{ $recruiter[0]->email_verified_at ? date('d/m/y', strtotime($recruiter[0]->email_verified_at)) : '' }}" readonly>
                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.user_locked_status') }}</label>
                  <input class="form-control" placeholder="{{ $recruiter[0]->is_user_locked ? 'Locked' : 'Not Locked' }}" readonly>
                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.user_locked_date') }}</label>
                  <input class="form-control" placeholder="{{ $recruiter[0]->user_locked_at ? date('d/m/y', strtotime($recruiter[0]->user_locked_at)) : '' }}" readonly>
                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.company_name') }}</label>
                  <input class="form-control" placeholder="{{ $organization[0]->name ? $organization[0]->name : '' }}" readonly>
                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.created_date') }}</label>
                  <input class="form-control" placeholder="{{ $organization[0]->created_at ? date('d/m/y', strtotime($organization[0]->created_at)) : '' }}" readonly>
                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.last_updated_date') }}</label>
                  <input class="form-control" placeholder="{{ $organization[0]->updated_at ? date('d/m/y', strtotime($organization[0]->updated_at)) : '' }}" readonly>
                </div>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>Company's Address</label>
                  <input class="form-control" placeholder="{{ $organization[0]->address }}" readonly>
                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>City / Town</label>
                  <input class="form-control" placeholder="{{ $organization[0]->city }}" readonly>
                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>County</label>
                  <input class="form-control" placeholder="{{ $organization[0]->county }}" readonly>
                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>State</label>
                  <input class="form-control" placeholder="{{ $organization[0]->state }}" readonly>
                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>Country</label>
                  <input class="form-control" placeholder="{{ $organization[0]->country }}" readonly>
                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>Zip / Postcode</label>
                  <input class="form-control" placeholder="{{ $organization[0]->pincode }}" readonly>
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