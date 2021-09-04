@extends('adminlte::page')

@section('title', 'Add Subject')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header alert d-flex justify-content-between align-items-center">
            <h3>{{ __('adminlte::adminlte.add_new') }}</h3>
            <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
          </div>
          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
            <form id="addJobseekerForm" method="post", action="{{ route('save_question') }}">
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

                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="name">{{ __('adminlte::adminlte.name') }}<span class="text-danger"> *</span></label>
                      <input type="text" name="name" class="form-control" id="name" maxlength="100">
                      @if($errors->has('name'))
                        <div class="error">{{ $errors->first('name') }}</div>
                      @endif
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="question_type">Question Type</label>
                      <select name="question_type" class="form-control">
                        <option value="1">Multiple</option>
                        <option value="2">Numeric</option>
                        <option value="3">String Matching</option>
                      </select>
                      @if($errors->has('question_type'))
                        <div class="error">{{ $errors->last('question_type') }}</div>
                      @endif
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="school_id">{{ __('adminlte::adminlte.school') }}<span class="text-danger"> *</span></label>
                      <select name="school_id" id="school_id" class="form-control">
                        <option value="">Select One</option>
                        @foreach ($school_list as $row)
                          <option value="{{ $row->id }}">{{ $row->name }}</option>
                        @endforeach
                      </select>
                      <div id ="email_error" class="error"></div>
                      @if($errors->has('school_id'))
                        <div class="error">{{ $errors->last('school_id') }}</div>
                      @endif
                    </div>
                  </div>


                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="course_id">{{ __('adminlte::adminlte.course_list') }}<span class="text-danger"> *</span></label>
                        <select name="course_id" id="course_id" class="form-control">
                          <option value="">Select One</option>
                          @foreach ($course_list as $row)
                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                          @endforeach
                        </select>
                        <div id ="email_error" class="error"></div>
                        @if($errors->has('course_id'))
                          <div class="error">{{ $errors->last('course_id') }}</div>
                        @endif
                      </div>
                  </div>

                </div>

                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="duration">Duration<span class="text-danger"> *</span></label>
                      <input type="text" name="duration" class="form-control" id="duration" maxlength="100">
                      @if($errors->has('duration'))
                        <div class="error">{{ $errors->last('duration') }}</div>
                      @endif
                    </div>
                  </div>
                  <!--div class="col-sm-6">
                    <div class="form-group">
                      <label for="starts_on">Starts On<span class="text-danger"> *</span></label>
                      <input type="time" name="starts_on" class="form-control" id="starts_on" maxlength="100">
                      @if($errors->has('starts_on'))
                        <div class="error">{{ $errors->last('starts_on') }}</div>
                      @endif
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="ends_on">Ends On<span class="text-danger"> *</span></label>
                      <input type="time" name="ends_on" class="form-control" id="ends_on" maxlength="100">
                      @if($errors->has('starts_on'))
                        <div class="error">{{ $errors->last('ends_on') }}</div>
                      @endif
                    </div>
                  </div-->
                </div>

                <div class="row">
                  <div class="col-sm-6">

                    <div class="form-group">
                      <label for="starts_on">Option A<span class="text-danger"> *</span></label>
                      <input type="text" name="option_1" class="form-control option_cust_width" maxlength="100">

                      @if($errors->has('starts_on'))
                        <div class="error">{{ $errors->last('starts_on') }}</div>
                      @endif
                    </div>
                    <input type="checkbox" value="1" class="form-control option_ans" name="is_correct_1" />
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="starts_on">Option B<span class="text-danger"> *</span></label>
                      <input type="text" name="option_2" class="form-control option_cust_width" maxlength="100">

                      @if($errors->has('starts_on'))
                        <div class="error">{{ $errors->last('starts_on') }}</div>
                      @endif
                    </div>
                      <input type="checkbox" value="1" class="form-control option_ans" name="is_correct_2" />
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="starts_on">Option C<span class="text-danger"> *</span></label>
                      <input type="text" name="option_3" class="form-control option_cust_width" maxlength="100">

                      @if($errors->has('starts_on'))
                        <div class="error">{{ $errors->last('starts_on') }}</div>
                      @endif
                    </div>
                    <input type="checkbox" class="form-control option_ans" name="is_correct_3" />
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="starts_on">Option D<span class="text-danger"> *</span></label>
                      <input type="text" name="option_4" class="form-control option_cust_width" maxlength="100">

                      @if($errors->has('starts_on'))
                        <div class="error">{{ $errors->last('starts_on') }}</div>
                      @endif
                    </div>
                    <input type="checkbox" class="form-control option_ans" name="is_correct_4" />
                  </div>
                </div>

              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="text" class="btn btn-primary">{{ __('adminlte::adminlte.save') }}</button>
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
      .option_cust_width{
        width:75%;
      }
      .option_ans {
          position: absolute;
          right: 50px;
          top: 36px;
          width: 11%;
          display: inline-block;
      }
  </style>
@stop

@section('js')
  <script>
    $(function(){
     $('#school_id').on('change', function(){
         var value = $(this).val();
         console.log(value);
             $.ajax({
               type:'get',
               dataType:'json',
                 url: "{{ route('get_courses_by_school') }}",
                 data: {
                   school_id : value,
                    "_token": $('meta[name="csrf-token"]').attr('content')
                 },
                 success: function(data) {
                   $('#course_id').html(data.course_sel);
                 }
             });
        });
    });


    $(document).ready(function() {
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
      $.validator.addMethod("regex", function(value, element, regexp) {
        var re = new RegExp(regexp);
        return this.optional(element) || re.test(value);
      }, "The Contact Number must be in numbers only.");
      $('#addJobseekerForm').validate({
        ignore: [],
        debug: false,
        rules: {
          duration : {
              required: true
          },
          name: {
            required: true
          },
          school_id: {
            required: true
          },
          price: {
            required: true
          },
          last_name: {
            required: true
          },
          email: {
            required: true,
            email: true
          },
          address: {
            required: true

          },
          password: {
            required: true,
            minlength: 8
          },
          confirm_password: {
            required: true,
            minlength: 8,
            equalTo : "#password"
          },
          phone: {
            regex: /^[\d ()+-]+$/,
            minlength: 7,
            maxlength: 15
          },
        },
        messages: {
          /* name: {
            required: "The Name field is required."
          }, */
          school_id :{
            required: "Select one school."
          },
          name: {
            required: "The Name field is required."
          },
          last_name: {
            required: "The Last Name field is required."
          },
          email: {
            required: "The Email field is required.",
            email: "Please enter a valid email address."
          },
          password: {
            required: "The Password field is required.",
            minlength: "Please enter at least 8 characters."
          },
          confirm_password: {
            required: "The password confirmation field is required.",
            minlength: "Please enter at least 8 characters.",
            equalTo : "The confirm password must match password."
          },
        }
      });
    });
  </script>
@stop
