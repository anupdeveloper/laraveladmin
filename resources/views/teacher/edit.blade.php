@extends('adminlte::page')

@section('title', 'Edit Teacher')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header alert d-flex justify-content-between align-items-center">
            <h3>Teacher Details</h3>
            <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
          </div>
          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
            <form id="editJobseekerForm" method="post", action="{{ route('update_teacher') }}">
              @csrf

              <div class="card-body form">
                  @if ($errors->any())
                    <div class="alert alert-warning">
                      <ul>
                        @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                        @endforeach
                      </ul>
                    </div>
                  @endif
                <input type="hidden" name="id" class="form-control" id="id" value="{{ $list[0]->id }}">
                <div class="row">
                  <!-- <div class="col-12">
                    <div class="form-group">
                      <label for="name">Name<span class="text-danger"> *</span></label>
                      <input type="name" name="name" class="form-control" id="name" value="{{ $list[0]->name }}" maxlength="100">
                      <i class="fa fa-edit editable_field text-success"></i>
                      <i class="fa fa-times non_editable_field text-danger"></i>
                      @if($errors->has('name'))
                        <div class="error">{{ $errors->first('name') }}</div>
                      @endif
                    </div>
                  </div> -->
                  <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                    <div class="form-group">
                      <label for="name">{{ __('adminlte::adminlte.name') }}<span class="text-danger"> *</span></label>
                      <input type="text" name="name" class="form-control" id="name" value="{{ $list[0]->name }}" maxlength="100">
                      <!-- <i class="fa fa-edit editable_field text-success"></i>
                      <i class="fa fa-times non_editable_field text-danger"></i> -->
                      @if($errors->has('name'))
                        <div class="error">{{ $errors->first('name') }}</div>
                      @endif
                    </div>
                  </div>
                  <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                    <div class="form-group">
                      <label for="email">Email<span class="text-danger"> *</span></label>
                      <input type="text" name="email" class="form-control" id="email" value="{{ $list[0]->email }}" maxlength="100">
                      <!-- <i class="fa fa-edit editable_field text-success"></i>
                      <i class="fa fa-times non_editable_field text-danger"></i> -->
                      @if($errors->has('email'))
                        <div class="error">{{ $errors->first('email') }}</div>
                      @endif
                    </div>
                  </div>
                  <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                    <div class="form-group">
                      <label for="first_name">{{ __('adminlte::adminlte.first_name') }}<span class="text-danger"> *</span></label>
                      <input type="text" name="first_name" class="form-control" id="first_name" value="{{ $list[0]->first_name }}" maxlength="100">
                      <!-- <i class="fa fa-edit editable_field text-success"></i>
                      <i class="fa fa-times non_editable_field text-danger"></i> -->
                      @if($errors->has('first_name'))
                        <div class="error">{{ $errors->first('first_name') }}</div>
                      @endif
                    </div>
                  </div>

                  <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                    <div class="form-group">
                      <label for="last_name">Last Name<span class="text-danger"> *</span></label>
                      <input type="text" name="last_name" class="form-control" id="last_name" value="{{ $list[0]->last_name }}" maxlength="100">
                      <!-- <i class="fa fa-edit editable_field text-success"></i>
                      <i class="fa fa-times non_editable_field text-danger"></i> -->
                      @if($errors->has('last_name'))
                        <div class="error">{{ $errors->first('last_name') }}</div>
                      @endif
                    </div>
                  </div>


                  <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                    <div class="form-group radio">
                      <div class="job_alerts">
                        <label>Email Verified</label>
                        <label class="switch">
                            <input name="email_verified" type="checkbox" {{($list[0]->is_email_verified)?'checked':''}}>
                            <span class="slider round"></span>
                        </label>


                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ __('adminlte::adminlte.update') }}</button>
              </div>
            </form>
          </div>
        </div>
      </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="job_alerts_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            <form class="modal-body text-left" id="job_alert_form">
                <h3>Job Alert Settings</h3>

                @php
                    $job_alert = \App\Models\JobAlert::where('user_id',$list[0]->id)->first();

                @endphp

                <div class="row">
                    <div class="col-12">
                        <div class="form-group pt-2">
                            <label><img src="{{asset('assets/images/Vocation.png')}}" alt="">Keyword</label>
                            <input type="text" class="form-control" autofocus="" placeholder="Keyword" name="keywords" value="{{@$job_alert->keywords}}">
                        </div>
                    </div>
                    <div class="col-12">
                        @php
                            $cities = \App\Models\City::select(\DB::raw('city as name'))->get();
                            $country = \App\Models\County::select(\DB::raw('county as name'))->get();

                            $places = $cities->union($country);

                            // in_array(needle, haystack)

                            $selected_locations = explode(',',@$job_alert->locations);


                        @endphp
                        <div class="form-group">
                            <label><img src="{{asset('assets/images/where.png')}}" alt="">Location</label>
                            <select class="form-control multiple" name="locations[]"  multiple="" name="locations[]">

                                @foreach($places as $place)
                                    <option {{in_array($place->name, $selected_locations)?'selected':''}}>{{$place->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        @php
                            $job_distance = \App\Models\Dropdown::where('name','job_distance')->get();
                        @endphp
                        <div class="form-group">
                            <label><img src="{{asset('assets/images/distance.png')}}" alt="">Distance</label>
                            <select class="form-control single-select" name="distance">
                                <option selected="" disabled="" value="">Distance</option>
                                @foreach($job_distance as $key => $value)

                                <option {{(@$job_alert->distance == $value->slug)?'selected':''}} value="{{$value->slug}}">{{$value->value}}</option>

                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label><img src="https://server3.rvtechnologies.in/which-vocation/v2/web/public/assets/images/Salary.png" alt="">
                            Salary</label>
                            <div class="row">
                                <div class="col-6">
                                    <input type="number" name="min_salary" class="form-control" placeholder="Minimun Salary" value="{{@$job_alert->min_salary}}">
                                </div>
                                <div class="col-6">
                                    <input type="number" name="max_salary" class="form-control"  placeholder="Maximum Salary" value="{{@$job_alert->max_salary}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        @php
                            $job_types = \App\Models\Dropdown::where('name','job_type')->get();

                            $selected_job_types = explode(',',@$job_alert->job_types);
                        @endphp
                        <div class="form-group">
                            <label><img src="{{asset('assets/images/job-type.png')}}" alt="">Job Type</label>
                            <select class="form-control multiple" multiple="" name="job_types[]">
                                @foreach($job_types as $key => $value)
                                    <option {{in_array($value->slug, $selected_job_types)?'selected':''}} value="{{$value->slug}}">
                                        {{$value->value}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        @php
                            $job_posted = \App\Models\Dropdown::where('name','job_posted')->get();
                            // dd($job_posted);
                        @endphp
                        <div class="form-group">
                            <label><img src="{{asset('assets/images/job-type.png')}}" alt="">Job Type</label>
                            <select class="form-control "  name="job_posted">
                                <option selected="" disabled="">Select Posted</option>

                                @foreach($job_posted as $key => $value)

                                <option {{(@$job_alert->job_posted == $value->slug)?'selected':''}} value="{{$value->slug}}">{{$value->value}}</option>

                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary submit-job-alert" disabled="disabled">Submit</button>
                    </div>
                </div>
            </form>
            <div class="modal-body success-modal" style="text-align: center;display: none;">
                <img style="width:100px;" src="http://server3.rvtechnologies.in/which-vocation/html-pages/images/Thankyou.svg" alt="">
                <h2>Thank you!</h2>
                <p>Your job alert settings has been saved successfully.</p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <style>
    .editable_field {
      position: relative;
      top: -25px;
      right: 10px;
      float: right;
    }
    .non_editable_field {
      position: relative;
      top: -25px;
      right: 10px;
      float: right;
    }
  </style>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

@stop
