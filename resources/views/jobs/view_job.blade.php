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
          <!-- <a class="btn btn-sm btn-success" href="{{ route('jobs_list') }}">Back to Jobs Published</a>
          <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">Back to Prevous Page</a> -->
          <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
        </div>
        <div class="card-body">
          @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
          @endif
          <div class="card-primary card-tabs">
              <!-- <div class="card-header p-0 m-0 mb-4">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true"><i class="fas fa-fw fa-cogs "></i>Job Detail</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false"><i class="fas fa-user-circle"></i>Jobseekers applied for this job</a>
                  </li>
                </ul>
              </div> -->
              <div class="card-body p-0">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                  <?php 
                    $url = config('adminlte.website_url', '').'images/companyLogos/';
                    $filePath = $jobDetails->company_logo ? $url.$jobDetails->company_logo : config("adminlte.default_avatar");
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
                          <input class="form-control" placeholder="{{ $jobDetails->job_ref_number ? $jobDetails->job_ref_number : '' }}" readonly>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group">
                          <label>{{ __('adminlte::adminlte.job_title') }}</label>
                          <input class="form-control" placeholder="{{ $jobDetails->job_title ? $jobDetails->job_title : '' }}" readonly>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-group description">
                          <label>{{ __('adminlte::adminlte.job_description') }}</label><br/>
                          <div class="job-description">{!! $jobDetails->job_description !!}</div>
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
                          <input class="form-control" placeholder="{{ $jobDetails->job_address ? $jobDetails->job_address : '' }}" readonly>
                        </div>
                      </div> -->

                      <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                        <div class="form-group">
                          <label>{{ __('adminlte::adminlte.city') }}</label>
                          <input class="form-control" placeholder="{{ $jobDetails->city ? $jobDetails->city : '' }}" readonly>
                        </div>
                      </div>
                      <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                        <div class="form-group">
                          <label>{{ __('adminlte::adminlte.county') }}</label>
                          <input class="form-control" placeholder="{{ $jobDetails->county ? $jobDetails->county : '' }}" readonly>
                        </div>
                      </div>
                    </div>

                    <div class="row">

                      {{-- <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                        <div class="form-group">
                          <label>{{ __('adminlte::adminlte.state') }}</label>
                          <input class="form-control" placeholder="{{ $jobDetails->state ? $jobDetails->state : '' }}" readonly>
                        </div>
                      </div> --}}
                      <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                        <div class="form-group">
                          <label>{{ __('adminlte::adminlte.country') }}</label>
                          <input class="form-control" placeholder="{{ $jobDetails->country ? $jobDetails->country : '' }}" readonly>
                        </div>
                      </div>
                    </div>

                    <!-- <div class="row">
                      
                      <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                        <div class="form-group">
                          <label>{{ __('adminlte::adminlte.zip') }}</label>
                          <input class="form-control" placeholder="{{ $jobDetails->pincode ? $jobDetails->pincode : '' }}" readonly>
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
                          <label for="skills">{{ __('adminlte::adminlte.skills') }}</label>
                          @php
                            $skills = implode(', ', $jobDetails->skills->pluck('name')->toArray());
                          @endphp
                          {{-- {{dump($skills)}} --}}

                          <div class="job-description">
                            {{ $skills }}
                          </div>
                          @if($errors->has('skills'))
                            <div class="error">{{ $errors->first('skills') }}</div>
                          @endif
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                        <div class="form-group">
                          <label>{{ __('adminlte::adminlte.minimum_experience_required') }} <small class="ml-1">(In Years)</small></label>
                          <input class="form-control" placeholder="{{ $jobDetails->experience_range_min ? $jobDetails->experience_range_min.' Years' : '' }}" readonly>
                        </div>
                      </div>

                      <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                        <div class="form-group">
                          <label>{{ __('adminlte::adminlte.employment_eligibility') }}</label>
                          <?php $employmentEligibility = str_replace('_', ' ', $jobDetails->employment_eligibility); ?>
                          <input class="form-control" placeholder="{{ ucwords($employmentEligibility) }}" readonly>
                        </div>
                      </div>

                      <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                        <div class="form-group">
                          <label>{{ __('adminlte::adminlte.job_industry') }}</label>
                          <input class="form-control" placeholder="{{ $jobIndustry ? $jobIndustry : '' }}" readonly>
                        </div>
                      </div>

                      <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                        <div class="form-group">
                          <label>Qualifications Required</label>
                          @php
                            $qualifications = implode(', ', $jobDetails->jobQualifications->pluck('name')->toArray());
                          @endphp
                          {{-- {{dump($qualifications)}} --}}

                          <div class="job-description">
                            {{ $qualifications }}
                          </div>
                          <!-- <input class="form-control" placeholder="{{ $qualifications }}" readonly> -->
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
                          <?php $currency = $jobDetails->salary_currency == 'pounds' ? '£' : '$' ?>
                          <input class="form-control" placeholder="{{ $jobDetails->package_range_from ? number_format($jobDetails->package_range_from) : '' }}" readonly>
                        </div>
                      </div>

                      <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 col-12">
                        <div class="form-group">
                          <label>{{ __('adminlte::adminlte.maximum_package_amount') }}</label>
                          <?php $currency = $jobDetails->salary_currency == 'pounds' ? '£' : '$' ?>
                          <input class="form-control" placeholder="{{ $jobDetails->package_range_to ? number_format($jobDetails->package_range_to) : '' }}" readonly>
                        </div>
                      </div>

                      <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 col-12">
                        <div class="form-group">
                          <label>{{ __('adminlte::adminlte.currency') }}</label>
                          <?php $currency = $jobDetails->salary_currency == 'pounds' ? '£' : '$' ?>
                          <input class="form-control" placeholder="{{ $jobDetails->currency == 'pounds' ? 'Pounds' : 'USD' }}" readonly>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-12">
                        <div class="form-group">
                          <label>{{ __('adminlte::adminlte.job_type') }}</label>
                          <?php $jobTypeTrimmed = str_replace('_', ' ', $jobDetails->job_type);
                            $jobType = ucwords($jobTypeTrimmed);
                          ?>
                          <input class="form-control" placeholder="{{ $jobDetails->job_type ? $jobType : '' }}" readonly>
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
                            <input class="form-control" placeholder="{{ $recruiter }}" readonly>
                          @else
                            <input class="form-control" readonly>
                          @endif
                        </div>
                      </div>

                      <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                        <div class="form-group">
                          <label>{{ __('adminlte::adminlte.company_name') }}</label>
                          <input class="form-control" placeholder="{{ $organization }}" readonly>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                        <div class="form-group">
                          <label>{{ __('adminlte::adminlte.job_url') }}</label>
                          <input class="form-control" placeholder="{{ $jobDetails->job_url }}" readonly>
                        </div>
                      </div>
                      <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                        <div class="form-group">
                          <label>{{ __('adminlte::adminlte.is_suspended') }}</label>
                          <input class="form-control" placeholder="{{ $jobDetails->is_suspended ? 'Yes' : 'No' }}" readonly>
                        </div>
                      </div>
                      <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                        <div class="form-group" style="padding-top: 30px;">
                          <label class="float-left">{{ __('adminlte::adminlte.is_featured') }}</label>
                          <label class="switch float-left">
                            <input class="" type="checkbox" name="is_featured" id="is_featured" disabled {{ $jobDetails->is_featured ? 'checked' : '' }}>
                            <span class="slider-btn round"></span>
                          </label>
                          <!-- <input class="form-control" placeholder="{{ $jobDetails->is_featured ? 'Yes' : 'No' }}" readonly> -->
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
                      

                      {{-- <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                        <div class="form-group">
                          <label>{{ __('adminlte::adminlte.job_function') }}</label>
                          <input class="form-control" placeholder="{{ $jobDetails->job_function }}" readonly>
                        </div>
                      </div> --}}
                    {{-- </div> --}}

                    {{-- <div class="row"> --}}
                      <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                        <div class="form-group">
                          <label>{{ __('adminlte::adminlte.region') }}</label>
                          <input class="form-control" placeholder="{{ $jobDetails->region }}" readonly>
                        </div>
                      </div>

                      <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                        <div class="form-group">
                          <label>{{ __('adminlte::adminlte.advert_days') }}</label>
                          <input class="form-control" placeholder="90 Days" readonly>
                        </div>
                      </div>
                    {{-- </div> --}}

                    {{-- <div class="row"> --}}

                      <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                        <div class="form-group">
                          <label>{{ __('adminlte::adminlte.status') }}</label>
                          <?php $statusTrimmed = str_replace('_', ' ', $jobDetails->status);
                            $status = ucwords($statusTrimmed);
                          ?>
                          <input class="form-control" placeholder="{{ $jobDetails->status ? $status : '' }}" readonly>
                        </div>
                      </div>
                      
                      <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                        <div class="form-group">
                          <label>{{ __('adminlte::adminlte.created_by') }}</label>
                          <input class="form-control" placeholder="{{ $jobDetails->created_by ? $jobDetails->created_by : '' }}" readonly>
                        </div>
                      </div>
                              
                      <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                        <div class="form-group">
                          <label>{{ __('adminlte::adminlte.expiry_date') }}</label>
                          <input class="form-control" placeholder="{{ $jobDetails->expiring_at ? date('d/m/y', strtotime($jobDetails->expiring_at)) : '' }}" readonly>
                        </div>
                      </div>
                      
                      <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                        <div class="form-group">
                          <label>{{ __('adminlte::adminlte.created_date') }}</label>
                          <input class="form-control" placeholder="{{ $jobDetails->created_at ? date('d/m/y', strtotime($jobDetails->created_at)) : '' }}" readonly>
                        </div>
                      </div>
                    
                      <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                        <div class="form-group">
                          <label>{{ __('adminlte::adminlte.last_updated_date') }}</label>
                          <input class="form-control" placeholder="{{ $jobDetails->updated_at ? date('d/m/y', strtotime($jobDetails->updated_at)) : '' }}" readonly>
                        </div>
                      </div>
                    </div>
                    
                  </form>
                  
                  </div>
                  <!-- <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                    <table style="width:100%" id="applicators-list" class="table table-bordered table-hover">
                      <thead>
                        <tr>
                          <th class="display-none"></th>
                          <th>{{ __('adminlte::adminlte.email') }}</th>
                          <th>{{ __('adminlte::adminlte.name') }}</th>
                          <th>{{ __('adminlte::adminlte.applicant_type') }}</th>
                          <th>{{ __('adminlte::adminlte.actions') }}</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                       for($i=0; $i < count($jobApplications); $i++) {
                        $applicant = $jobApplications[$i]->applicant_type::find($jobApplications[$i]->applicant_id);
                        $applicantType = $jobApplications[$i]->applicant_type == 'App\Models\User' ? 'Jobseeker' : 'Guest'; ?>
                          <tr>
                            <td class="display-none">1</td>
                            <td>{{ $applicant->email }}</td>
                            <td>{{ $applicant->first_name.' '.$applicant->last_name }}</td>
                            <td>{{ $applicantType }}</td>
                            <td>
                            @if($applicantType == 'Jobseeker')
                              <a class="action-button" title="View" href="{{route('view_jobseeker', ['id'=>$applicant->id])}}"><i class="text-info fa fa-eye"></i></a>
                            @else
                              <a class="action-button" title="View" href="{{route('view_guest', ['id'=>$applicant->id])}}"><i class="text-info fa fa-eye"></i></a>
                            @endif
                            </td>
                          </tr>
                      <?php } ?>
                      </tbody>
                    </table>
                  </div> -->
                </div>
              </div>
              <!-- /.card -->
            </div>
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

    /* Toggle Button */
    .switch { position: relative; display: block; width: 45px; height: 25px; left: 10px; top: -2px; }
    .switch input { opacity: 0; width: 0; height: 0; }
    .slider-btn { position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: #ccc; -webkit-transition: .4s; transition: .4s; }
    .slider-btn:before { position: absolute; content: ""; height: 19px; width: 18px; left: 1px; bottom: 1px; background-color: white; -webkit-transition: .4s; transition: .4s; }
    input:checked + .slider-btn { background-color: #2d8427; right: -1px; position: absolute; }
    input:focus + .slider-btn { box-shadow: 0 0 1px #2d8427; right: -1px; position: absolute; }
    input:checked + .slider-btn:before { -webkit-transform: translateX(26px); -ms-transform: translateX(26px); transform: translateX(26px); left: 1px; top: 3px; }
    /* Rounded sliders */
    .slider-btn.round { border-radius: 34px; }
    .slider-btn.round:before { border-radius: 50%; }
  </style>
@stop

@section('js')
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#applicators-list').DataTable( {
        columnDefs: [ {
          targets: 0,
          render: function ( data, type, row ) {
            return data.substr( 0, 2 );
          }
        }]
      });
    });
  </script>
@stop
