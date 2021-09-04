@extends('adminlte::page')

@section('title', 'Job Information')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header alert d-flex justify-content-between align-items-center">
          <h3>{{ __('adminlte::adminlte.job_information') }}</h3>
          <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
        </div>        
        <div class="card-body job-history">
          @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
          @endif
          
          <?php 
            $url = config('adminlte.website_url', '').'images/companyLogos/';
            $filePath = $jobHistory->company_logo ? $url.$jobHistory->company_logo : config("adminlte.default_avatar");
          ?>
          
          <form class="form_wrap">
            <div class="title">
              <h5>Tell Us About Your Job</h5>
              <hr/>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.reference_number') }}</label>
                  <a class="link-text" href="{{ route('view_job', ['id' => $jobHistory->job_id]) }}">
                    <input class="form-control" placeholder="{{ $jobHistory->job_ref_number ? $jobHistory->job_ref_number : '' }}" readonly>
                  </a>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.job_title') }}</label>
                  <input class="form-control" placeholder="{{ $jobHistory->job_title ? $jobHistory->job_title : '' }}" readonly>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group description">
                  <label>{{ __('adminlte::adminlte.job_description') }}</label><br/>
                  <div class="job-description">{!! $jobHistory->job_description !!}</div>
                </div>
              </div>
            </div>

            <div class="title">
              <h5>Location of the job</h5>
              <hr/>
            </div>

            <div class="row">
              <!-- <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.address') }}</label>
                  <input class="form-control" placeholder="{{ $jobHistory->job_address ? $jobHistory->job_address : '' }}" readonly>
                </div>
              </div> -->

              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.city') }}</label>
                  <input class="form-control" placeholder="{{ $jobHistory->city ? $jobHistory->city : '' }}" readonly>
                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.county') }}</label>
                  <input class="form-control" placeholder="{{ $jobHistory->county ? $jobHistory->county : '' }}" readonly>
                </div>
              </div>
            </div>

            <div class="row">

              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.state') }}</label>
                  <input class="form-control" placeholder="{{ $jobHistory->state ? $jobHistory->state : '' }}" readonly>
                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.country') }}</label>
                  <input class="form-control" placeholder="{{ $jobHistory->country ? $jobHistory->country : '' }}" readonly>
                </div>
              </div>
            </div>

            <!-- <div class="row">
              
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.zip') }}</label>
                  <input class="form-control" placeholder="{{ $jobHistory->pincode ? $jobHistory->pincode : '' }}" readonly>
                </div>
              </div>
            </div> -->

            <div class="title">
              <h5>What Are The Job Requirements?</h5>
              <hr/>
            </div>

            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="skills">{{ __('adminlte::adminlte.skills') }}<span class="text-danger"> *</span></label>
                  <input class="form-control"placeholder="HTML" readonly>
                  @if($errors->has('skills'))
                    <div class="error">{{ $errors->first('skills') }}</div>
                  @endif
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.minimum_experience_required') }}</label>
                  <input class="form-control" placeholder="{{ $jobHistory->experience_range_min ? $jobHistory->experience_range_min.' Years' : '' }}" readonly>
                </div>
              </div>

              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.employment_eligibility') }}</label>
                  <?php $employmentEligibility = str_replace('_', ' ', $jobHistory->employment_eligibility); ?>
                  <input class="form-control" placeholder="{{ ucwords($employmentEligibility) }}" readonly>
                </div>
              </div>
            </div>

            <div class="title">
              <h5>What Does This Job Pay?</h5>
              <hr/>
            </div>

            <div class="row">
              <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.minimum_package_amount') }}</label>
                  <?php $currency = $jobHistory->salary_currency == 'pounds' ? '£' : '$' ?>
                  <input class="form-control" placeholder="{{ $jobHistory->package_range_from ? $jobHistory->package_range_from : '' }}" readonly>
                </div>
              </div>

              <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.maximum_package_amount') }}</label>
                  <?php $currency = $jobHistory->salary_currency == 'pounds' ? '£' : '$' ?>
                  <input class="form-control" placeholder="{{ $jobHistory->package_range_to ? $jobHistory->package_range_to : '' }}" readonly>
                </div>
              </div>

              <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.currency') }}</label>
                  <?php $currency = $jobHistory->salary_currency == 'pounds' ? '£' : '$' ?>
                  <input class="form-control" placeholder="{{ $jobHistory->currency == 'pounds' ? 'Pounds' : 'USD' }}" readonly>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.job_type') }}</label>
                  <?php $jobTypeTrimmed = str_replace('_', ' ', $jobHistory->job_type);
                    $jobType = ucwords($jobTypeTrimmed);
                  ?>
                  <input class="form-control" placeholder="{{ $jobHistory->job_type ? $jobType : '' }}" readonly>
                </div>
              </div>
            </div>

            <div class="title">
              <h5>Tell Us About Your Company</h5>
              <hr/>
            </div>

            <div class="row">
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.recruiter') }}</label>
                  @if($recruiter != null)
                  <a class="link-text" href="{{ route('view_recruiter', [ 'id' => $recruiter->id ]) }}">
                    <input class="form-control" placeholder="{{ $recruiter->first_name ? $recruiter->first_name.' '.$recruiter->last_name : $recruiter->email }}" readonly>
                  </a>
                  @else
                    <input class="form-control" readonly>
                  @endif
                </div>
              </div>

              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.company_name') }}</label>
                  <input class="form-control" placeholder="{{ $organizationName }}" readonly>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.job_url') }}</label>
                  <input class="form-control" placeholder="{{ $jobHistory->job_url }}" readonly>
                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.is_featured') }}</label>
                  <input class="form-control" placeholder="{{ $jobHistory->is_featured ? 'Yes' : 'No' }}" readonly>
                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group profile_image">
                  <label>Profile Image</label>
                  <img class="job_image" src="{{ $filePath }}">
                </div>
              </div>                      
              <!-- <div class="job_image_show">
                <img class="job_image" src="{{ $filePath }}">
              </div> -->
            </div>

            <div class="title">
              <h5>Other Details</h5>
              <hr/>
            </div>

            <div class="row">
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.job_industry') }}</label>
                  <input class="form-control" placeholder="{{ $jobIndustry ? $jobIndustry : '' }}" readonly>
                </div>
              </div>

              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.job_function') }}</label>
                  <input class="form-control" placeholder="{{ $jobHistory->job_function }}" readonly>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.region') }}</label>
                  <input class="form-control" placeholder="{{ $jobHistory->region }}" readonly>
                </div>
              </div>

              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.advert_days') }}</label>
                  <input class="form-control" placeholder="90 Days" readonly>
                </div>
              </div>
            </div>

            <div class="row">

              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.status') }}</label>
                  <?php $statusTrimmed = str_replace('_', ' ', $jobHistory->status);
                    $status = ucwords($statusTrimmed);
                  ?>
                  <input class="form-control" placeholder="{{ $jobHistory->status ? $status : '' }}" readonly>
                </div>
              </div>
              
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.created_by') }}</label>
                  <input class="form-control" placeholder="{{ $jobHistory->created_by ? $jobHistory->created_by : '' }}" readonly>
                </div>
              </div>
                      
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.expiry_date') }}</label>
                  <input class="form-control" placeholder="{{ $jobHistory->expiring_at ? date('d/m/y', strtotime($jobHistory->expiring_at)) : '' }}" readonly>
                </div>
              </div>
              
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.created_date') }}</label>
                  <input class="form-control" placeholder="{{ $jobHistory->created_at ? date('d/m/y', strtotime($jobHistory->created_at)) : '' }}" readonly>
                </div>
              </div>
            
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.last_updated_date') }}</label>
                  <input class="form-control" placeholder="{{ $jobHistory->updated_at ? date('d/m/y', strtotime($jobHistory->updated_at)) : '' }}" readonly>
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
