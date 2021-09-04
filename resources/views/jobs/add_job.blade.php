@extends('adminlte::page')

@section('title', 'Add Job')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header alert d-flex justify-content-between align-items-center">
            <a class="btn btn-sm btn-success back-button" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
            <h3>{{ __('adminlte::adminlte.add_job') }}</h3>
          </div>
          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
            <form id="addJobForm" method="post" action="{{ route('save_job') }}">
              @csrf
              <div class="card-body">
                @if ($errors->any())
                  <div class="alert alert-warning">
                    <ul>
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                @endif

                <div class="information_fields">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="job_title">{{ __('adminlte::adminlte.job_title') }}<span class="text-danger"> *</span></label>
                        <input type="text" name="job_title" class="form-control" id="job_title" maxlength="100">
                        @if($errors->has('job_title'))
                          <div class="error">{{ $errors->first('job_title') }}</div>
                        @endif
                      </div>
                    </div>
                      
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="job_type">{{ __('adminlte::adminlte.job_type') }}<span class="text-danger"> *</span></label>
                        <select name="job_type" class="form-control" id="job_type">
                          <option value="full_time">{{ __('adminlte::adminlte.full_time') }}</option>
                          <option value="contract_basis">{{ __('adminlte::adminlte.contract_basis') }}</option>
                          <option value="work_from_home">{{ __('adminlte::adminlte.work_from_home') }}</option>
                        </select>
                        @if($errors->has('job_type'))
                          <div class="error">{{ $errors->last('job_type') }}</div>
                        @endif
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="job_industry_id">{{ __('adminlte::adminlte.job_industry') }}<span class="text-danger"> *</span></label>
                        <select name="job_industry_id" class="form-control" id="job_industry_id">
                          <?php for ($i=0; $i < count($jobIndustries); $i++) { ?> 
                            <option value="{{ $jobIndustries[$i]->id }}">{{ $jobIndustries[$i]->name }}</option>
                          <?php } ?>
                        </select>
                        @if($errors->has('job_industry_id'))
                          <div class="error">{{ $errors->first('job_industry_id') }}</div>
                        @endif
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="job_function">{{ __('adminlte::adminlte.job_function') }}<span class="text-danger"> *</span></label>
                        <input type="hidden" name="job_location_id" value="1" maxlength="100">
                        <select name="job_function" class="form-control" id="job_function">
                          <?php for ($i=0; $i < count($jobFunctions); $i++) { ?> 
                            <option value="{{ $jobFunctions[$i]->id }}">{{ $jobFunctions[$i]->name }}</option>
                          <?php } ?>
                        </select>
                        @if($errors->has('job_function'))
                          <div class="error">{{ $errors->first('job_function') }}</div>
                        @endif
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="organization_id">{{ __('adminlte::adminlte.company') }}<span class="text-danger"> *</span></label>
                        <select name="organization_id" class="form-control" id="organization_id">
                          <?php for($i=0; $i<count($organisationsList); $i++) { ?>
                            <option value="{{ $organisationsList[$i]->id }}">{{ $organisationsList[$i]->name }}</option>
                          <?php } ?>
                        </select>
                        @if($errors->has('organization_id'))
                          <div class="error">{{ $errors->last('organization_id') }}</div>
                        @endif
                      </div>
                    </div>
                      
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="recruiter_id">{{ __('adminlte::adminlte.recruiter') }}<span class="text-danger"> *</span></label>
                        <select name="recruiter_id" class="form-control" id="recruiter_id">
                          <?php for($i=0; $i<count($recruitersList); $i++) { ?>
                            <option value="{{ $recruitersList[$i]->id }}">{{ $recruitersList[$i]->name }}</option>
                          <?php } ?>
                        </select>
                        @if($errors->has('recruiter_id'))
                          <div class="error">{{ $errors->last('recruiter_id') }}</div>
                        @endif
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="job_skills">{{ __('adminlte::adminlte.required_skills') }}</label>
                        <select multiple="multiple" name="job_skills[]" class="form-control" id="job_skills">
                          <?php for ($i=0; $i < count($JobSkills); $i++) { ?> 
                            <option value="{{ $JobSkills[$i]->id }}">{{ $JobSkills[$i]->name }}</option>
                          <?php } ?>
                        </select>
                        @if($errors->has('job_skills'))
                          <div class="error">{{ $errors->first('job_skills') }}</div>
                        @endif
                      </div>
                    </div>
                   
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="is_featured">{{ __('adminlte::adminlte.is_featured') }}</label>
                        <select name="is_featured" class="form-control" id="is_featured">
                          <option value="0">No</option>
                          <option value="1">Yes</option>
                        </select>
                        @if($errors->has('is_featured'))
                          <div class="error">{{ $errors->first('is_featured') }}</div>
                        @endif
                      </div>
                    </div>
                  </div>

                  <div class="row">  
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label for="job_description">{{ __('adminlte::adminlte.job_description') }}<span class="text-danger"> *</span></label>
                        <textarea id="job_description" name="job_description" maxlength="1000"></textarea>
                        @if($errors->has('job_description'))
                          <div class="error">{{ $errors->last('job_description') }}</div>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>

                <hr/>

                <div class="financial_fields">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="min_monthly_salary">{{ __('adminlte::adminlte.min_salary') }}</label>
                        <input type="text" name="min_monthly_salary" class="form-control" id="min_monthly_salary" maxlength="100">
                        @if($errors->has('min_monthly_salary'))
                          <div class="error">{{ $errors->first('min_monthly_salary') }}</div>
                        @endif
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="max_monthly_salary">{{ __('adminlte::adminlte.max_salary') }}</label>
                        <input type="text" name="max_monthly_salary" class="form-control" id="max_monthly_salary" maxlength="100">
                        @if($errors->has('max_monthly_salary'))
                          <div class="error">{{ $errors->first('max_monthly_salary') }}</div>
                        @endif
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">

                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="min_experience">{{ __('adminlte::adminlte.min_experience') }}</label>
                        <input type="text" name="min_experience" class="form-control" id="min_experience" maxlength="100">
                        @if($errors->has('min_experience'))
                          <div class="error">{{ $errors->first('min_experience') }}</div>
                        @endif
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="max_experience">{{ __('adminlte::adminlte.max_experience') }}</label>
                        <input type="text" name="max_experience" class="form-control" id="max_experience" maxlength="100">
                        @if($errors->has('max_experience'))
                          <div class="error">{{ $errors->first('max_experience') }}</div>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>

                <hr/>

                <div class="address_fields">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label for="job_location_id">{{ __('adminlte::adminlte.location') }}<span class="text-danger"> *</span></label>
                        <select name="job_skills" class="form-control" id="job_skills">
                          <?php for ($i=0; $i < count($jobLocations); $i++) { ?> 
                            <option value="{{ $jobLocations[$i]->id }}">{{ $jobLocations[$i]->name }}</option>
                          <?php } ?>
                        </select>
                        @if($errors->has('job_location_id'))
                          <div class="error">{{ $errors->first('job_location_id') }}</div>
                        @endif
                      </div>
                    </div>
                  </div>

                <div class="address_fields">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="job_address">{{ __('adminlte::adminlte.address') }}<span class="text-danger"> *</span></label>
                        <input type="text" name="job_address" class="form-control" id="job_address" maxlength="100">
                        @if($errors->has('job_address'))
                          <div class="error">{{ $errors->first('job_address') }}</div>
                        @endif
                      </div>
                    </div>
                      
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="city">{{ __('adminlte::adminlte.city') }}<span class="text-danger"> *</span></label>
                        <input class="form-control" list="cities" name="city" id="city" placeholder="Start to enter City/ Town">
                        <datalist id="cities">
                          <?php for($i=0; $i<count($cities); $i++) { ?>
                            <option value="{{ $cities[$i]->city }}" {{ $cities[$i]->city == 'United Kingdom' ? 'selected' : '' }}>{{ $cities[$i]->city }}</option>
                          <?php } ?>
                        </datalist>
                        @if($errors->has('city'))
                          <div class="error">{{ $errors->first('city') }}</div>
                        @endif
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="state">{{ __('adminlte::adminlte.state') }}<span class="text-danger"> *</span></label>
                        <input type="text" name="state" class="form-control" id="state" maxlength="100">
                        @if($errors->has('state'))
                          <div class="error">{{ $errors->first('state') }}</div>
                        @endif
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="pincode">{{ __('adminlte::adminlte.zip') }}<span class="text-danger"> *</span></label>
                        <input type="text" name="pincode" class="form-control" id="pincode" maxlength="7">
                        @if($errors->has('pincode'))
                          <div class="error">{{ $errors->first('pincode') }}</div>
                        @endif
                      </div>
                    </div>
                  </div>
                      
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="county">{{ __('adminlte::adminlte.county') }}</label>
                        <input class="form-control" list="counties" name="county" id="county" placeholder="Start to enter County">
                        <datalist id="counties">
                          <?php for($i=0; $i<count($counties); $i++) { ?>
                            <option value="{{ $counties[$i]->county }}" {{ $counties[$i]->county == 'United Kingdom' ? 'selected' : '' }}>{{ $counties[$i]->county }}</option>
                          <?php } ?>
                        </datalist>
                        @if($errors->has('county'))
                          <div class="error">{{ $errors->first('county') }}</div>
                        @endif
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="country">{{ __('adminlte::adminlte.country') }}<span class="text-danger"> *</span></label>
                        <select name="country" class="form-control" id="country">
                            <?php for($i=0; $i<count($countries); $i++) { rsort($countries); ?>
                              <option value="{{ $countries[$i]->name }}" {{ $countries[$i]->name == 'United Kingdom' ? 'selected' : '' }}>{{ $countries[$i]->name }}</option>
                            <?php } ?>
                        </select>
                        @if($errors->has('country'))
                          <div class="error">{{ $errors->last('country') }}</div>
                        @endif
                      </div>
                    </div>
                  </div>

                </div>

              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="text" class="btn btn-primary" >{{ __('adminlte::adminlte.save') }}</button>
              </div>
            </form>
          </div>
        </div>
      </div>
  </div>
</div>
@endsection

@section('css')
  <style>
    .information_fields { margin-bottom: 30px; }
    .financial_fields { margin-top: 30px; margin-bottom: 30px; }
    .address_fields { margin-top: 30px; }
  </style>
@stop

@section('js')
  <script>
    $(document).ready(function() {
      CKEDITOR.replace( 'job_description', {
        customConfig : 'config.js',
        toolbar : 'simple'
      })
      $('#addJobForm').validate({
        ignore: [],
        debug: false,
        rules: {
          job_title: {
            required: true
          },
          job_type: {
            required: true
          },
          job_industry_id: {
            required: true
          },
          job_function: {
            required: true
          },
          job_location_id: {
            required: true
          },
          organization_id: {
            required: true
          },
          recruiter_id: {
            required: true
          },
          is_featured: {
            required: true
          },
          job_description:{
            required: function() {
              CKEDITOR.instances.job_description.updateElement();
            },
            minlength:10
          },
          min_monthly_salary: {
            number: true
          },
          max_monthly_salary: {
            number: true
          },
          min_experience: {
            number: true
          },
          max_experience: {
            number: true
          },
          job_address: {
            required: true
          },
          city: {
            required: true
          },
          state: {
            required: true
          },
          pincode: {
            required: true
          },
          country: {
            required: true
          },
        },
        messages: {
          job_title: {
            required: "The Job Title field is required."
          },
          job_type: {
            required: "The Job Type field is required."
          },
          job_industry_id: {
            required: "The Job Industry field is required."
          },
          job_function: {
            required: "The Job Function field is required."
          },
          job_location_id: {
            required: "The Job Region field is required."
          },
          organization_id: {
            required: "The Company field is required."
          },
          recruiter_id: {
            required: "The Recruiter field is required."
          },
          is_featured: {
            required: "The Is Featured field is required."
          },
          job_description: {
            required: "The Job Description field is required.",
            minlength: "Minimum Length must be 10"
          },
          min_monthly_salary: {
            required: "The Minimum Monthly Salary must be in numbers only."
          },
          max_monthly_salary: {
            required: "The Maximum Monthly Salary must be in numbers only."
          },
          min_experience: {
            required: "The Minimum Experience must be in numbers only."
          },
          max_experience: {
            required: "The Maximum Experience must be in numbers only."
          },
          job_address: {
            required: "The Job Address field is required."
          },
          city: {
            required: "The City / Town field is required."
          },
          state: {
            required: "The State field is required."
          },
          pincode: {
            required: "The Zip / Postcode field is required."
          },
          country: {
            required: "The Country field is required."
          },
        }
      });
    });
  </script>
@stop
