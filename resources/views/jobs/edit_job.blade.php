@extends('adminlte::page')

@section('title', 'Edit Job')

@section('content_header')
@stop

@section('content')
<?php //dd($_SERVER['DOCUMENT_ROOT'].config('adminlte.logo_path')); ?>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header alert d-flex justify-content-between align-items-center">
            <h3>{{ __('adminlte::adminlte.edit_job') }}</h3>
            <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
          </div>
          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
            <form id="editJobForm" method="post" action="{{ route('update_job') }}" enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="id" id="JobId" value="{{ $jobDetails->id }}" maxlength="100">
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

                <div class="title">
                  <h5>Tell Us About Your Job</h5>
                  <hr/>
                </div>
                <div class="information_fields">
                  <div class="row">
                    <div class="col-12">
                      <div class="form-group">
                        <label for="job_title">{{ __('adminlte::adminlte.job_title') }}<span class="text-danger"> *</span></label>
                        <input type="text" name="job_title" class="form-control" id="job_title" value="{{ $jobDetails->job_title }}" maxlength="100"
                        list="job_title_suggestion_list">
                          @php
                              $job_title_suggestion = \App\Models\JobTitleSuggestion::all();
                          @endphp
                          <datalist id="job_title_suggestion_list">
                              @foreach($job_title_suggestion as $v)
                                  <option>{{$v->title}}</option>
                              @endforeach
                          </datalist>
                        @if($errors->has('job_title'))
                          <div class="error">{{ $errors->first('job_title') }}</div>
                        @endif
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form-group">
                        <label for="job_description">{{ __('adminlte::adminlte.job_description') }}<span class="text-danger"> *</span></label>
                        <textarea class="form-control" id="job_description" name="job_description" maxlength="1000" style="font-size: 13px;">{{ $jobDetails->job_description }}</textarea>
                        <div class="counter-wrappar">
                          <span>0</span> /
                          1000
                        </div>
                        @if($errors->has('job_description'))
                          <div class="error">{{ $errors->last('job_description') }}</div>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>

                <div class="title">
                  <h5>Location of the job</h5>
                  <hr/>
                </div>

                <div class="address_fields">
                  <div class="row">
                    <!-- <div class="col-6">
                      <div class="form-group">
                        <label for="job_address">{{ __('adminlte::adminlte.address') }}<span class="text-danger"> *</span></label>
                        <input type="text" name="job_address" class="form-control" id="job_address" value="{{ $jobDetails->job_address }}" maxlength="100">
                        @if($errors->has('job_address'))
                          <div class="error">{{ $errors->first('job_address') }}</div>
                        @endif
                      </div>
                    </div> -->
                      
                    <div class="col-6">
                      <div class="form-group">
                        <label for="city">{{ __('adminlte::adminlte.city') }}<span class="text-danger"> *</span></label>
                        <input class="form-control city" list="cities" name="city" id="city" value="{{ $jobDetails->city }}" placeholder="Start to enter City/ Town">
                        {{-- <datalist id="cities">
                          <?php for($i=0; $i<count($cities); $i++) { ?>
                            <option value="{{ $cities[$i]->city }}" {{ $cities[$i]->city == 'United Kingdom' ? 'selected' : '' }}>{{ $cities[$i]->city }}</option>
                          <?php } ?>
                        </datalist> --}}
                        @if($errors->has('city'))
                          <div class="error" id="city-error">{{ $errors->first('city') }}</div>
                        @endif
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="county">{{ __('adminlte::adminlte.county') }}<span class="text-danger"> *</span></label>
                        <input class="form-control county" list="counties" name="county" id="county" value="{{ $jobDetails->county }}" placeholder="Start to enter County" readonly="">
                        {{-- <datalist id="counties">
                          <?php for($i=0; $i<count($counties); $i++) { ?>
                            <option value="{{ $counties[$i]->county }}" {{ $counties[$i]->county == 'United Kingdom' ? 'selected' : '' }}>{{ $counties[$i]->county }}</option>
                          <?php } ?>
                        </datalist> --}}
                        @if($errors->has('county'))
                          <div class="error" id="county-error">{{ $errors->first('county') }}</div>
                        @endif
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    {{-- <div class="col-6">
                      <div class="form-group">
                        <label for="state">{{ __('adminlte::adminlte.state') }}</label>
                        <input type="text" name="state" class="form-control" id="state" value="{{ $jobDetails->state }}" maxlength="100">
                        @if($errors->has('state'))
                          <div class="error">{{ $errors->first('state') }}</div>
                        @endif
                      </div>
                    </div> --}}
                    <div class="col-6">
                      <div class="form-group">
                        <label for="country">{{ __('adminlte::adminlte.country') }}<span class="text-danger"> *</span></label>
                        <input type="text" readonly="" name="country" value="{{ $jobDetails->country }}" class="form-control">
                        {{-- <select name="country" class="form-control" id="country">
                            <?php for($i=0; $i<count($countries); $i++) { ?>
                              <option value="{{ $countries[$i]['name'] }}" {{ $countries[$i]['name'] == 'United Kingdom' ? 'selected' : '' }}>{{ $countries[$i]['name'] }}</option>
                            <?php } ?>
                        </select> --}}
                        @if($errors->has('country'))
                          <div class="error">{{ $errors->last('country') }}</div>
                        @endif
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    
                    <!-- <div class="col-6">
                      <div class="form-group">
                        <label for="pincode">{{ __('adminlte::adminlte.zip') }}<span class="text-danger"> *</span></label>
                        <input type="text" name="pincode" class="form-control" id="pincode" value="{{ $jobDetails->pincode }}" maxlength="7">
                        @if($errors->has('pincode'))
                          <div class="error">{{ $errors->first('pincode') }}</div>
                        @endif
                      </div>
                    </div> -->
                  </div>
                </div>

                <div class="title">
                  <h5>What Are The Job Requirements?</h5>
                  <hr/>
                </div>

                <div class="requirements_fields"> 
                  <div class="row">
                    <div class="col-xl-12 col-lg-12 col-sm-12 col-12">
                      <div class="form-group">
                        <label for="skills">{{ __('adminlte::adminlte.skills') }}<span class="text-danger"> *</span></label>
                        <select class="form-control" id="skills" multiple="multiple" name="skills[]">
                          @foreach($skills as $skill)
                            @php
                              if (old('skills')) {
                                if (in_array($skill->id, old('skills'))) {
                                  $selected = "selected";
                                }
                                else{
                                  $selected = "";
                                }
                              }
                              elseif($jobDetails->skills){
                                if (in_array($skill->id, $jobDetails->skills->pluck('id')->toArray())) {
                                  $selected = "selected";
                                }
                                else{
                                  $selected = "";
                                }
                              }
                              else{
                                $selected = "";
                              }    
                            @endphp
                            <option {{$selected}} value="{{$skill->id}}">{{$skill->name}}</option>
                            @endforeach
                        </select>
                        <!-- <input type="text" name="skills" class="form-control" id="skills" maxlength="100"> -->
                        @if($errors->has('skills'))
                          <div class="error">{{ $errors->first('skills') }}</div>
                        @endif
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="experience_range_min">{{ __('adminlte::adminlte.minimum_experience_required') }} <small class="ml-1"> (In Years)</small></label>
                        <input type="text" name="experience_range_min" class="form-control" id="experience_range_min" value="{{ $jobDetails->experience_range_min }}" maxlength="100">
                        @if($errors->has('experience_range_min'))
                          <div class="error">{{ $errors->first('experience_range_min') }}</div>
                        @endif
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="employment_eligibility">{{ __('adminlte::adminlte.employment_eligibility') }}</label>
                        <select name="employment_eligibility" class="form-control" id="employment_eligibility">
                        @foreach($employmentDropdowns as $employmentDropdown)
                          <option value="{{ $employmentDropdown->slug }}" {{ $jobDetails->employment_eligibility == $employmentDropdown->slug ? 'selected' : '' }}>{{ $employmentDropdown->value }}</option>
                        @endforeach
                        </select>
                        @if($errors->has('employment_eligibility'))
                          <div class="error">{{ $errors->first('employment_eligibility') }}</div>
                        @endif
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="job_industry_id">{{ __('adminlte::adminlte.industry') }}<span class="text-danger"> *</span></label>
                        <select name="job_industry_id" class="form-control" id="job_industry_id">
                          <?php for($i=0; $i<count($jobIndustries); $i++) { ?>
                            <option value="{{ $jobIndustries[$i]->id }}" {{ ( $jobIndustries[$i]->id == $jobDetails->job_industry_id) ? 'selected' : '' }}>{{ $jobIndustries[$i]->name }}</option>
                          <?php } ?>
                        </select>
                        @if($errors->has('job_industry_id'))
                          <div class="error">{{ $errors->first('job_industry_id') }}</div>
                        @endif
                      </div>
                    </div>

                    <div class="col-6">
                      <div class="form-group">
                        @php
                            $all_qualification = \App\Models\JobIndustry::find($jobDetails->job_industry_id)->jobQualifications;
                            // dd($all_qualification);
                            $selected_qualifications = $jobDetails->jobQualifications()->pluck('job_qualifications.id')->toArray();                                   
                        @endphp
                          <label class=""><img src="{{asset('assets/images/industry')}}.png" alt="">Qualifications Required</label>
                          <select name="qualification_required[]" multiple="multiple" class="qualification-multiselect">
                            @if(!empty($all_qualification))
                              @foreach($all_qualification as $k => $q)
                                  <option {{in_array($q->id, $selected_qualifications)?'selected':''}} value="{{$q->id}}">{{$q->name}}</option>
                              @endforeach
                            @endif
                          </select>
                      </div>
                    </div>
                  </div> 

                <div class="title">
                  <h5>What Does This Job Pay?</h5>
                  <hr/>
                </div>

                  <div class="row">
                    <div class="col-xl-4 col-lg-4 col-sm-4 col-">
                      <div class="form-group ">
                          <label><img class="" src="{{asset('assets/images/amount')}}.png" alt="">Salary Type</label>
                          @php
                              $salary_types = \App\Models\Dropdown::where('name','salary_type')->get();
                          @endphp
                          <select name="salary_type" class="form-control">
                              <option selected="selected" disabled="disabled">Select salary type</option>
                              @foreach($salary_types as $salary_type)
                                  <option {{($jobDetails->salary_type == $salary_type->slug)?'selected':''}} value="{{$salary_type->slug}}">{{$salary_type->value}}</option>
                              @endforeach
                          </select>
                          @error('salary_type')
                              <label class="error">{{$message}}</label>
                          @enderror
                      </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-sm-4 col-12">
                      <div class="form-group amount">
                        <label for="package_range_from">{{ __('adminlte::adminlte.minimum_package_amount') }}</label>
                        <input type="text" name="package_range_from" class="form-control" id="package_range_from" value="{{ ($jobDetails->package_range_from)?number_format($jobDetails->package_range_from):'' }}" maxlength="11" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)">
                        @if($errors->has('package_range_from'))
                          <div class="error">{{ $errors->first('package_range_from') }}</div>
                        @endif
                      </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-sm-4 col-12">
                      <div class="form-group amount">
                        <label for="package_range_to">{{ __('adminlte::adminlte.maximum_package_amount') }}</label>
                        <input type="text" name="package_range_to" class="form-control" id="package_range_to" value="{{ ($jobDetails->package_range_to)?number_format($jobDetails->package_range_to):'' }}" maxlength="11" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)">
                        @if($errors->has('package_range_to'))
                          <div class="error">{{ $errors->first('package_range_to') }}</div>
                        @endif
                      </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-sm-4 col-12">
                      <div class="form-group amount">
                        <label for="salary_currency">{{ __('adminlte::adminlte.currency') }}</label>
                        <select name="salary_currency" class="form-control" id="salary_currency">
                          @foreach($currencies as $currency)
                            <option value="{{ $currency->slug }}" {{ $jobDetails->currency == $currency->slug ? 'selected' : '' }}>{{ $currency->value }}</option>
                          @endforeach
                        </select>
                        @if($errors->has('salary_currency'))
                          <div class="error">{{ $errors->first('salary_currency') }}</div>
                        @endif
                      </div>
                    </div>

                    <div class="col-xl-8 col-lg-8 col-sm-8 col-8">
                      {{-- <div class="type_fields">  --}}
                      <div class=""> 
                              
                            <div class="form-group">
                              <label for="job_type">{{ __('adminlte::adminlte.job_type') }}<span class="text-danger"> *</span></label>
                              <select name="job_type" class="form-control" id="job_type">
                                @foreach($jobTypes as $jobType)
                                  <option {{ $jobDetails->job_type == $jobType->slug ? 'selected' : '' }} value="{{ $jobType->slug }}">{{ $jobType->value }}</option>
                                @endforeach
                              </select>
                              @if($errors->has('job_type'))
                                <div class="error">{{ $errors->last('job_type') }}</div>
                              @endif
                            </div>
                          </div>
                        

                    </div>
                  </div>

                  <div class="row">
                    <!-- <div class="col-6">
                      <div class="form-group">
                        <label for="experience_range_min">{{ __('adminlte::adminlte.minimum_experience_required') }}</label>
                        <input type="text" name="experience_range_min" class="form-control" id="experience_range_min" value="{{ $jobDetails->experience_range_min }}" maxlength="100">
                        @if($errors->has('experience_range_min'))
                          <div class="error">{{ $errors->first('experience_range_min') }}</div>
                        @endif
                      </div>
                    </div> -->
                  </div>

                </div>

                    
                <div class="title">
                  <h5>Tell Us About Your Company</h5>
                  <hr/>
                </div>

                <div class="about_fields"> 
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <label for="organization_id">{{ __('adminlte::adminlte.company_name') }}<span class="text-danger"> *</span></label>
                        <input type="text" name="organization_id" class="form-control" id="organization_id" value="{{ $organisation->name }}" readonly>
                        @if($errors->has('organization_id'))
                          <div class="error">{{ $errors->last('organization_id') }}</div>
                        @endif
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="job_url">{{ __('adminlte::adminlte.job_url') }}<small>(Featured job only)</small></label>
                        <input type="hidden" name="company_url" value="{{ $organisation->url }}">
                        <input type="text" name="job_url" class="form-control" id="job_url" value="{{ $jobDetails->job_url }}" maxlength="100" readonly>
                        @if($errors->has('job_url'))
                          <div class="error">{{ $errors->first('job_url') }}</div>
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group is_featured_group">
                        <label for="is_featured">{{ __('adminlte::adminlte.is_featured') }}</label>
                        <label class="switch">
                          <input class="" type="checkbox" name="is_featured" id="is_featured" disabled {{ $jobDetails->is_featured ? 'checked' : '' }}>
                          <span class="slider-btn round"></span>
                        </label>
                        <button type="button" class="btn info_btn" data-toggle="tooltip" data-placement="right" title="{{ config('adminlte.image_tooltip') }}">
                          <i class="fa fa-question-circle"></i>
                        </button>                         
                        @if($errors->has('is_featured'))
                          <div class="error">{{ $errors->first('is_featured') }}</div>
                        @endif
                      </div>
                      <div id="uploadPicture" class="edit_job_upload_picture">
                        <div class="profile-image">
                          <div id="preview-cropped-image">
                            <label class="label">
                              <?php 
                                $url = config('adminlte.website_url', '').'images/companyLogos/';
                                $filePath = $jobDetails->company_logo ? $url.$jobDetails->company_logo : config("adminlte.default_avatar");
                              ?>
                              <img id="profileImage" class="profile-image" src="{{ $filePath }}" alt="Profilbild">
                              <input type="file" class="sr-only" id="input" name="image" accept="image/jpeg, image/jpg, image/png, .svg">
                              <div class="error" id="image_error"></div>
                              <input type="hidden" id="logo_image" name="logo_image" value="">
                            </label>
                          </div>
                          <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                          </div>
                          <div class="alert" role="alert"></div>
                          <div class="modal fade" id="cropper-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="modalLabel"><img src="{{asset('assets/images/croper_image.svg')}}" alt="">Crop the image</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <div class="img-container">
                                    <img id="image" src="https://avatars0.githubusercontent.com/u/3456749">
                                  </div>
                                  <div class="row" id="actions" class="action_buttons">
                                    <div class=" col-12 docs-buttons">
                                      <div class="btn-group">
                                        <a class="btn btn-primary btn-sm" title="Upload New Image" onclick="document.getElementById('input').click();"><i class="fa fa-upload"></i></a>
                                        <button type="button" id="reset" class="btn btn-primary btn-sm action_button" title="Reset">
                                          <i class="fa fa-sync"></i>
                                        </button>
                                        <button type="button" id="zoomOut" class="btn btn-primary btn-sm action_button" title="Zoom Out">
                                          <i class="fa fa-search-minus"></i>
                                        </button>
                                        <button type="button" id="zoomIn" class="btn btn-primary btn-sm action_button" title="Zoom In">
                                          <i class="fa fa-search-plus"></i>
                                        </button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                                  <button type="button" class="btn btn-primary" id="crop">Upload</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>                      
                      </div>
                    </div>
                  </div>
                </div>

                <div class="title">
                  <h5>Other details</h5>
                  <hr/>
                </div>

                <div class="other_fields"> 
                  <div class="row">
                    

                    {{-- <div class="col-6">
                      <div class="form-group">
                        <label for="job_function">{{ __('adminlte::adminlte.function') }}</label>
                        <input type="text" name="job_function" class="form-control" id="job_function" value="{{ $jobDetails->job_function }}">
                        @if($errors->has('job_function'))
                          <div class="error">{{ $errors->first('job_function') }}</div>
                        @endif
                      </div>
                    </div> --}}

                    <div class="col-6">
                      <div class="form-group">
                        <label for="job_location_id">{{ __('adminlte::adminlte.region') }}<span class="text-danger"> *</span></label>
                        {{-- <select name="job_location_id" class="form-control" id="job_location_id">
                          <?php for($i=0; $i<count($jobLocations); $i++) { ?>
                            <option value="{{ $jobLocations[$i]->id }}" {{ ( $jobLocations[$i]->id == $jobDetails->job_location_id) ? 'selected' : '' }}>{{ $jobLocations[$i]->name }}</option>
                          <?php } ?>
                        </select> --}}
                        <input type="text" name="region" id="region" class="form-control" value="{{$jobDetails->region}}" readonly="">
                        {{-- @if($errors->has('job_location_id'))
                          <div class="error">{{ $errors->first('job_location_id') }}</div>
                        @endif --}}
                      </div>
                    </div>
                  {{-- </div>
                
                  <div class="row"> --}}
                    <input type="hidden" name="latitude" id="latitude" value="{{$jobDetails->latitude}}">
                    <input type="hidden" name="longitude" id="longitude" value="{{$jobDetails->longitude}}">
                    <div class="col-6">
                      <div class="form-group">
                        <label for="advert_days">{{ __('adminlte::adminlte.advert_days') }}<span class="text-danger"> *</span></label> (Expiring on {{\Carbon\Carbon::parse($jobDetails->expiring_at)->format('d/m/Y')}})
                        <input type="text" name="advert_days" class="form-control" id="advert_days" value="90 Days" disabled>
                        @if($errors->has('advert_days'))
                          <div class="error">{{ $errors->first('advert_days') }}</div>
                        @endif
                      </div>
                    </div>
                    {{-- {{dd($jobDetails->expiring_at)}} --}}
                    <div class="col-6">
                      <div class="form-group pb-3">
                        <label for="advert_days">{{ __('adminlte::adminlte.expiring_on') }}<span class="text-danger"> *</span></label>
                        <input type="text" name="expiring_on" class="form-control" value="{{\Carbon\Carbon::parse($jobDetails->expiring_at)->format('d/m/Y')}}" />
                        @if($errors->has('advert_days'))
                          <div class="error">{{ $errors->first('advert_days') }}</div>
                        @endif
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    
                    <div class="col-6">
                      <div class="form-group m-0">
                        <div class="completed_job_wrap">
                          <label for="is_complete_update">{{ __('adminlte::adminlte.is_complete_update') }}</label>
                          <div class="custom-check">
                            <input class="is_complete_update" type="checkbox" name="is_complete_update">                          
                            <span></span>
                          </div>                          
                        </div>
                        @if($errors->has('is_complete_update'))
                          <div class="error">{{ $errors->last('is_complete_update') }}</div>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>

              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="text" class="btn btn-primary" >{{ __('adminlte::adminlte.update_job') }}</button>
              </div>
            </form>
          </div>
        </div>
      </div>
  </div>
</div>
@endsection

@section('css')
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="https://fengyuanchen.github.io/cropperjs/css/cropper.css">
  <!-- <link rel="stylesheet" href="https://server3.rvtechnologies.in/which-vocation/html-pages/css/style.css"> -->
  <style>
    .information_fields { margin-bottom: 25px; }
    .address_fields { margin-top: 25px; margin-bottom: 25px; }
    .requirements_fields { margin-top: 25px; margin-bottom: 25px; }
    .type_fields { margin-top: 25px; margin-bottom: 25px; }
    .about_fields { margin-top: 25px; margin-bottom: 25px; }
    .other_fields { margin-top: 25px; }
    
    .switch { position: relative; display: inline-block; width: 60px; height: 34px; }
    .switch input { opacity: 0; width: 0; height: 0; }
    .slider-btn { position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: #ccc; -webkit-transition: .4s; transition: .4s; }
    .slider-btn:before { position: absolute; content: ""; height: 19px; width: 18px; left: 1px; bottom: 1px; background-color: white; -webkit-transition: .4s; transition: .4s; }
    input:checked + .slider-btn { background-color: #2d8427; right: -1px; position: absolute; }
    input:focus + .slider-btn { box-shadow: 0 0 1px #2d8427; right: -1px; position: absolute; }
    input:checked + .slider-btn:before { -webkit-transform: translateX(26px); -ms-transform: translateX(26px); transform: translateX(26px); }
    /* Rounded sliders */
    .slider-btn.round { border-radius: 34px; }
    .slider-btn.round:before { border-radius: 50%; }

    #uploadPicture { display: none };
    .label { cursor: pointer; }
    .modal-dialog { margin-top: 10rem; }
    .progress { display: none; margin-bottom: 1rem; }
    .img-container img { max-width: 100%; }
    .modal-backdrop { position: relative; }
    #profileImage { height: 150px; width: 200px; border-radius: 10px; object-fit: contain; background-color: #fbfbfb; border: 1px solid #343d49; padding: 10px; }
    .counter-wrappar { text-align: center; font-size: 13px; font-weight: 600; float: right; background-color: #e6e6e6; padding: 3px 0px; clear: both; border: 1px solid #cccccc; border-radius: 4px; width: 100px; top: 5px; position: relative; }
        .ui-autocomplete {
  position: absolute;
  top: 100%;
  left: 0;
  z-index: 1000;
  display: none;
  float: left;
  min-width: 160px;
  padding: 5px 0;
  margin: 2px 0 0;
  list-style: none;
  font-size: 14px;
  text-align: left;
  background-color: #ffffff;
  border: 1px solid #cccccc;
  border: 1px solid rgba(0, 0, 0, 0.15);
  border-radius: 4px;
  -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
  background-clip: padding-box;
}

.ui-autocomplete > li > div {
  display: block;
  padding: 3px 20px;
  clear: both;
  font-weight: normal;
  line-height: 1.42857143;
  color: #333333;
  white-space: nowrap;
}

.ui-state-hover,
.ui-state-active,
.ui-state-focus {
  text-decoration: none;
  color: #262626;
  background-color: #f5f5f5;
  cursor: pointer;
}

.ui-helper-hidden-accessible {
  border: 0;
  clip: rect(0 0 0 0);
  height: 1px;
  margin: -1px;
  overflow: hidden;
  padding: 0;
  position: absolute;
  width: 1px;
}
    </style>
@stop
@section('plugins.DateRangePicker', true)
@section('js')
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script type="text/javascript" src="https://fengyuanchen.github.io/cropperjs/js/cropper.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <script>
    $('body').on('keyup','textarea[name=job_description]',function() {
      $(this).parent().find('.counter-wrappar > span').text($(this).val().length);
    });

    function FormatCurrency(ctrl) {
        //Check if arrow keys are pressed - we want to allow navigation around textbox using arrow keys
        if (event.keyCode == 37 || event.keyCode == 38 || event.keyCode == 39 || event.keyCode == 40) {
            return;
        }

        var val = ctrl.value;

        val = val.replace(/,/g, "")
        ctrl.value = "";
        val += '';
        x = val.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';

        var rgx = /(\d+)(\d{3})/;

        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }

        ctrl.value = x1 + x2;
    }

    function CheckNumeric() {
        return event.keyCode >= 48 && event.keyCode <= 57 || event.keyCode == 46;
    }

    $(document).ready(function() {
      var today = new Date(); 

      $('input[name="expiring_on"]').daterangepicker({
        minDate:today,
        singleDatePicker: true,
        showDropdowns: true,
        minYear: 1901,
        maxYear: parseInt(moment().format('YYYY'),10),
        locale: {
            format: 'DD/MM/YYYY'
        }

      });
      // $('input[name=expiring_on]').daterangepicker();

      $('.counter-wrappar > span').text($("textarea[name=job_description]").val().length);
      if ($('#is_featured').is(':checked')) {
        $("#job_url").removeAttr('readonly');
        $("#uploadPicture").css('display', 'block');
      }
      else {
        $("#job_url").attr('readonly', 'true');
        $("#uploadPicture").css('display', 'none');
      }

      $("#skills").select2({
        tags: true,
        tokenSeparators: [',', ' ']
      })

      $('.qualification-multiselect').select2();
      $("#email").blur(function() {
        $.ajax({
          type:"GET",
          url:"{{ route('check_email') }}",
          data: {
            email: $(this).val(),
            table_name: 'users'
          },
          success: function(result) {
            if(result) {
              $("#email_error").html("This email is already registered.");
            }
            else {
              $("#email_error").html("");
            }
          }
        });
      });
      $.validator.addMethod("greaterThan", function (value, element, param) {
        var $otherElement = $(param);
        return parseFloat(value, 10) >= parseFloat($otherElement.val(), 10);
      });
      $("#city, #county").change(function() {
        if($(this).hasClass('city') && $(this).val() != "") {
          $("#county-error").hide();
        }
        else if($(this).val() == "") {
          $("#county-error").show();
        }
        if($(this).hasClass('county') && $(this).val() != "") {
          $("#city-error").hide();
        }
        else if($(this).val() == "") {
          $("#city-error").show();
        }
      });

      $('#editJobForm').validate({
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
          job_location_id: {
            required: true
          },
          /* job_url: {
            required: true
          }, */
          organization_id: {
            required: true
          },
          job_description:{
            required: true,
            maxlength: 1000
          },
          city: {
            required: '#county:blank'
          },
          county: {
            required: '#city:blank'
          },
          country: {
            required: true
          },
          salary_currency: {
            required: true,
          },
          "skills[]": {
            required: true,
          },
          experience_range_min: {
            number: true
          },
          package_range_from: {
            number: true
          },
          package_range_to: {
            number: true
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
          job_location_id: {
            required: "The Job Location field is required."
          },
          /* job_url: {
            required: "The Job URL field is required."
          }, */
          organization_id: {
            required: "The Company field is required."
          },
          job_description: {
            required: "The Job Description field is required.",
            maxlength: "Enter no more than 1000 characters"
          },
          city: {
            required: "The City / Town OR County is required."
          },
          county: {
            required: "The County OR City / Town is required."
          },
          country: {
            required: "The Country field is required."
          },
          salary_currency: {
            required: 'The Currency field is required.',
          },
          "skills[]": {
            required: 'The Skills field is required.',
          },
          experience_range_min: {
            number: "The Minimum Salary must be in numbers only."
          },
          package_range_from: {
            number: "The Maximum Salary must be in numbers only."
          },
          package_range_to: {
            number: "The Minimum Experience Required must be in numbers only."
          },
        }
      });
    });
  </script>

  <script>
    window.addEventListener('DOMContentLoaded', function () {
      var avatar = document.getElementById('profileImage');
      var image = document.getElementById('image');
      var input = document.getElementById('input');
      var $progress = $('.progress');
      var $progressBar = $('.progress-bar');
      var $alert = $('.alert');
      var $modal = $('#cropper-modal');
      var cropper;
      var uploadedImageURL;
      var options = {
        movable: true,
        zoomable: true,
        rotatable: true,
        scalable: false
      }

      $('[data-toggle="tooltip"]').tooltip();
      input.addEventListener('change', function (e) {
        var files = e.target.files;
        var done = function (url) {
          input.value = '';
          image.src = url;
          $alert.hide();
          $modal.modal('show');
        };
        var reader;
        var file;
        var url;

        if (files && files.length > 0) {
          file = files[0];
          // console.log(file);
          var fileName = file.name;
          var fileExtension = fileName.substr((fileName.lastIndexOf('.') + 1));
          console.log (fileExtension);
          if(fileExtension != "jpg" && fileExtension != "jpeg" && fileExtension != "png" && fileExtension != "JPG" && fileExtension != "JPEG" && fileExtension != "PNG" && fileExtension != "svg" && fileExtension != "SVG") {
            $("#image_error").html("Only .jpg .gif .png .svg files are allowed to upload.");
            return false;
          }
          else {
            if(file.size <= 2000000) {
              $("#image_error").html("");
              if (URL) {
                done(URL.createObjectURL(file));
                if(cropper) {
                  cropper.destroy();
                  cropper = new Cropper(image, options);
                }
              } else if (FileReader) {
                reader = new FileReader();
                reader.onload = function (e) {
                  done(reader.result);
                };
                reader.readAsDataURL(file);
              }
            }
            else {
              $("#image_error").html("The File must be less than or equal to 2 MB.");
              return false;
            }
          }
        }
      });

      $modal.on('shown.bs.modal', function () {
        cropper = new Cropper(image, options);
        $("#zoomIn").click(function() {
          cropper.zoom(0.1);
        });
        $("#zoomOut").click(function() {
          cropper.zoom(-0.1);
        });
        /* $("#rotateLeft").click(function() {
          cropper.rotate(-90);
        });
        $("#rotateRight").click(function() {
          cropper.rotate(90);
        }); */
        $("#reset").click(function() {
          cropper.reset();
        });
        /* $("#destroy").click(function() {
          cropper.destroy();
        }); */

      }).on('hidden.bs.modal', function () {
        cropper.destroy();
        cropper = null;
      });

      document.getElementById('crop').addEventListener('click', function () {
        var initialAvatarURL;
        var canvas;

        $modal.modal('hide');

        if (cropper) {
          canvas = cropper.getCroppedCanvas();
          initialAvatarURL = avatar.src;
          avatar.src = canvas.toDataURL();
          // console.log(avatar.src);
          $progress.show();
          $alert.removeClass('alert-success alert-warning');
          canvas.toBlob(function (blob) {
            var formData = new FormData();
            formData.append('avatar', blob, 'avatar.jpg');
            // $("#logo_image").attr('value', avatar.src);
            // setTimeout(() => {
            //   $(".progress").hide();
            // }, 500);
            $.ajax({
              url: "{{ route('upload_company_logo') }}",
              type: "POST",
              dataType: "JSON",
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              data: {
                logo_image: avatar.src,
                jobId: $("#JobId").val()
              },
              success: function (response) {
                console.log(response);
                if (response.success) {
                  $("#logo_image").attr('value', response.image);
                  setTimeout(() => {
                    $(".progress").hide();
                  }, 500);
                }
                else {
                  swal("Error!", "Something went wrong! Please try again.", "warning");
                }
              }
            });
          });
        }
      });
    });


$('body').on('change','select[name=job_industry_id]',function(){

    var job_industry_id = $(this).val();
    $.ajax('{{route('recruiter.get.qualification')}}', {
        method: 'POST',
        data:{
            job_industry_id: job_industry_id
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(res) {

            $('select[name="qualification_required[]"]').html(res);
            // $alert.show().addClass('alert-success').text('Upload success');


        }
    });

});
  </script>
  <script type="text/javascript">
    $(function() {


        $("#city").autocomplete({
            source: function(request, response) {
                jQuery.get("{{route('get.places')}}", {
                    query: request.term
                }, function(data) {
                  
                    response(data);
                });
            },
            select: function(event, ui) {
                console.log(ui.item);
                $('#county').val(ui.item.county);
                $('#country').val(ui.item.country);
                $('#region').val(ui.item.region);
                $('#latitude').val(ui.item.latitude);
                $('#longitude').val(ui.item.longitude);
                $('#region').val(ui.item.region);
            },
            minLength: 3

        }).data("ui-autocomplete")._renderItem = function(ul, item) {
            return $("<li></li>")
                .data("item.autocomplete", item)
                .append("<div>" + item.place + ", <strong>" + item.county + "</strong>" + ", <strong>" + item.country + "</strong>" + "</div>")
                .appendTo(ul);
        };
    });
</script>
@stop
