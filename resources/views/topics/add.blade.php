@extends('adminlte::page')

@section('title', 'Add Jobseeker')

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
            <form id="addJobseekerForm" method="post", action="{{ route('save_course') }}">
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
                      <label for="desc">{{ __('adminlte::adminlte.desc') }}</label>
                      <input type="text" name="desc" class="form-control" id="descdesc" maxlength="100">
                      @if($errors->has('desc'))
                        <div class="error">{{ $errors->last('desc') }}</div>
                      @endif
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="school_id">{{ __('adminlte::adminlte.school') }}<span class="text-danger"> *</span></label>
                      <select name="school_id" class="form-control">
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
                      <label for="price">{{ __('adminlte::adminlte.price') }}</label>
                      <input name="price" class="form-control" id="price" value="" maxlength="13">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="duration">{{ __('adminlte::adminlte.duration') }}<span class="text-danger"> *</span></label>
                      <input type="text" name="duration" class="form-control" id="duration" maxlength="100">
                      @if($errors->has('address'))
                        <div class="error">{{ $errors->last('duration') }}</div>
                      @endif
                    </div>
                  </div>

                  <!--div class="col-sm-6">
                    <div class="form-group">
                      <label for="confirm_password">{{ __('adminlte::adminlte.confirm_password') }}<span class="text-danger"> *</span></label>
                      <input type="password" name="confirm_password" class="form-control" id="confirm_password" maxlength="100">
                      @if($errors->has('confirm_password'))
                        <div class="error">{{ $errors->last('confirm_password') }}</div>
                      @endif
                    </div>
                  </div-->
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
@stop

@section('js')
  <script>
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
