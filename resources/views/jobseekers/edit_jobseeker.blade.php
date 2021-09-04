@extends('adminlte::page')

@section('title', 'Edit Jobseeker')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header alert d-flex justify-content-between align-items-center">
            <h3>{{ __('adminlte::adminlte.edit_jobseeker') }}</h3>
            <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
          </div>
          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
            <form id="editJobseekerForm" method="post", action="{{ route('update_jobseeker') }}">
              @csrf
              <div class="card-body form">
                <input type="hidden" name="id" class="form-control" id="id" value="{{ $jobseeker[0]->id }}">
                <div class="row">
                  <!-- <div class="col-12">
                    <div class="form-group">
                      <label for="name">Name<span class="text-danger"> *</span></label>
                      <input type="name" name="name" class="form-control" id="name" value="{{ $jobseeker[0]->name }}" maxlength="100">
                      <i class="fa fa-edit editable_field text-success"></i>
                      <i class="fa fa-times non_editable_field text-danger"></i>
                      @if($errors->has('name'))
                        <div class="error">{{ $errors->first('name') }}</div>
                      @endif
                    </div>
                  </div> -->
                  <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                    <div class="form-group">
                      <label for="first_name">{{ __('adminlte::adminlte.first_name') }}<span class="text-danger"> *</span></label>
                      <input type="text" name="first_name" class="form-control" id="first_name" value="{{ $jobseeker[0]->first_name }}" maxlength="100">
                      <!-- <i class="fa fa-edit editable_field text-success"></i>
                      <i class="fa fa-times non_editable_field text-danger"></i> -->
                      @if($errors->has('first_name'))
                        <div class="error">{{ $errors->first('first_name') }}</div>
                      @endif
                    </div>
                  </div>
                  <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                    <div class="form-group">
                      <label for="last_name">{{ __('adminlte::adminlte.last_name') }}<span class="text-danger"> *</span></label>
                      <input type="text" name="last_name" class="form-control" id="last_name" value="{{ $jobseeker[0]->last_name }}" maxlength="100">
                      <!-- <i class="fa fa-edit editable_field text-success"></i>
                      <i class="fa fa-times non_editable_field text-danger"></i> -->
                      @if($errors->has('last_name'))
                        <div class="error">{{ $errors->first('last_name') }}</div>
                      @endif
                    </div>
                  </div>
                  <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                    <div class="form-group">
                      <label for="email">{{ __('adminlte::adminlte.email') }}<span class="text-danger"> *</span></label>
                      <input type="text" name="email" class="form-control" id="email" value="{{ $jobseeker[0]->email }}" readonly maxlength="100">
                      <!-- <i class="fa fa-edit editable_field text-success"></i>
                      <i class="fa fa-times non_editable_field text-danger"></i> -->
                      @if($errors->has('email'))
                        <div class="error">{{ $errors->first('email') }}</div>
                      @endif
                    </div>
                  </div>
                  <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                    <div class="form-group">
                      <label for="phone_number">{{ __('adminlte::adminlte.contact_number') }}</label>
                      <input id="jquery-intl-phone" type="tel" name="phone_number" class="form-control" id="phone_number" value="{{ $jobseeker[0]->phone_number ? $jobseeker[0]->phone_number : '+44' }}" maxlength="13">
                      <!-- <i class="fa fa-edit editable_field text-success"></i>
                      <i class="fa fa-times non_editable_field text-danger"></i> -->
                      @if($errors->has('phone_number'))
                        <div class="error">{{ $errors->first('phone_number') }}</div>
                      @endif
                    </div>
                  </div>
                  <div class="col-md-6 col-lg-6 col-xl-6 col-12">
                    <div class="form-group radio">
                      <div class="job_alerts">
                        <label>{{ __('adminlte::adminlte.job_alerts') }}</label>
                        <label class="switch">
                            <input type="checkbox" {{($jobseeker[0]->is_job_alert_enabled)?'checked':''}}>
                            <span class="slider round"></span>
                        </label>
                        <i {{($jobseeker[0]->is_job_alert_enabled)?'style=display:inline':''}} class="fas fa-fw fa-cog open-job-alert-modal" style="display: none;"></i>    
                                      
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
                    $job_alert = \App\Models\JobAlert::where('user_id',$jobseeker[0]->id)->first();
                    
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
  <script>
    $("select.multiple").select2();
    $(document).ready(function() {
      /* $(".non_editable_field").hide();
      $('input').prop('disabled', true);
      $(".editable_field").click(function() {
        $(this).hide();
        $(this).siblings('input').prop('disabled', false);
        $(this).siblings(".non_editable_field").show();
      });
      $(".non_editable_field").click(function() {
        $(this).hide();
        $(this).siblings('input').prop('disabled', true);
        $(".editable_field").show();
      }); */
      $.validator.addMethod("regex", function(value, element, regexp) {
        var re = new RegExp(regexp);
        return this.optional(element) || re.test(value);
      }, "The Contact Number must be in numbers only.");
      $('#editJobseekerForm').validate({
        ignore: [],
        debug: false,
        rules: {
          name: {
            required: true
          },
          first_name: {
            required: true
          },
          last_name: {
            required: true
          },
          email: {
            required: true,
            email: true,
          },
          phone_number: {
            regex: /^[\d ()+-]+$/,
            minlength: 7,
            maxlength: 15
          },
        },
        messages: {
          name: {
            required: "The Name field is required."
          },
          first_name: {
            required: "The First Name field is required."
          },
          last_name: {
            required: "The Last Name field is required."
          },
          email: {
            required: "The Email field is required.",
            email: "Please enter a valid email"
          },
        }
      });
    });


    $('body').on('click','.job_alerts input[type=checkbox]',function(){

        if($(this).is(':checked')){
            
            $('.job_alerts .open-job-alert-modal').show();

        }else{

            $('.job_alerts .open-job-alert-modal').hide();
        }

        var url = '{{route('toggle.job.alert')}}';
        var job_seeker_id = $('#id').val();
        $.ajax({
            type: "POST",
            url: url,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{
                job_seeker_id: job_seeker_id
            },
            success: function(response){
                
            }
        });
    });

    $('body').on('click','.open-job-alert-modal', function(){
        $('#job_alerts_modal').modal('show');
    });


    (function() {
        var empty = true;
        $('form input[type=text],form input[type=number]').keyup(function() {
            
            $('form input[type=text]').each(function() {
                console.log($(this).val());
                if ($(this).val() != '') {
                    empty = false;
                }
            });

            $('form input[type=number]').each(function() {
                console.log($(this).val());
                if ($(this).val() != '') {
                    empty = false;
                }
            });

            $('form select.multiple').each(function() {
                console.log($(this).val());
                if ($(this).val() != '') {
                    empty = false;
                }
            });

            $('form select.single-select').each(function() {
                console.log($(this).val());
                if ($(this).val() != null) {
                    empty = false;
                }
            });
            if (empty) {
                $('.submit-job-alert').attr('disabled', 'disabled');
            } else {
                $('.submit-job-alert').removeAttr('disabled');
            }
            empty = true;
        });

        $('form select').change(function() {
            
            $('form input[type=text]').each(function() {
                console.log($(this).val());
                if ($(this).val() != '') {
                    empty = false;
                }
            });

            $('form input[type=number]').each(function() {
                console.log($(this).val());
                if ($(this).val() != '') {
                    empty = false;
                }
            });
            
            $('form select.multiple').each(function() {
                console.log($(this).val());
                if ($(this).val() != '') {
                    empty = false;
                }
            });

            $('form select.single-select').each(function() {
                console.log($(this).val());
                if ($(this).val() != null) {
                    empty = false;
                }
            });
            if (empty) {
                $('.submit-job-alert').attr('disabled', 'disabled');
            } else {
                $('.submit-job-alert').removeAttr('disabled');
            }
           empty = true;
        })
        console.log(empty);
    })()


    $('body').on('click','.submit-job-alert',function(e){
        e.preventDefault();
        var data = $('#job_alert_form').serialize();
        var url = '{{route('store.job.alert',$jobseeker[0]->id)}}';
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response){
                console.log(response);

                if (response.status == true) {
                    console.log('here');
                    $('#job_alert_form').hide();
                    $('#job_alerts_modal').find('.success-modal').show();
                }
            }
        });
    });

    $('body').on('click','#job_alerts_modal .close', function(){
        $('#job_alert_form').show();
        $('#job_alerts_modal').find('.success-modal').hide();
    });

    $('body').on('click','#job_alerts_modal',function(e){
        
        if(e.target.id == 'job_alerts_modal'){
            $('#job_alert_form').show();
            $('#job_alerts_modal').find('.success-modal').hide();
        }
    });
  </script>
@stop
