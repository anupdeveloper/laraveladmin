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
            <h3>{{ __('adminlte::adminlte.add_jobseeker') }}</h3>
            <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
          </div>
          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
            <form id="addJobseekerForm" method="post", action="save">
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
                      <label for="first_name">{{ __('adminlte::adminlte.first_name') }}<span class="text-danger"> *</span></label>
                      <input type="text" name="first_name" class="form-control" id="first_name" maxlength="100">
                      @if($errors->has('first_name'))
                        <div class="error">{{ $errors->first('first_name') }}</div>
                      @endif
                    </div>
                  </div>
                    
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="last_name">{{ __('adminlte::adminlte.last_name') }}<span class="text-danger"> *</span></label>
                      <input type="text" name="last_name" class="form-control" id="last_name" maxlength="100">
                      @if($errors->has('last_name'))
                        <div class="error">{{ $errors->last('last_name') }}</div>
                      @endif
                    </div>
                  </div>
                </div>
                
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="email">{{ __('adminlte::adminlte.email') }}<span class="text-danger"> *</span></label>
                      <input type="text" name="email" class="form-control" id="email" placeholder="Ex: emaple@whichvocation.com" maxlength="100">
                      <div id ="email_error" class="error"></div>
                      @if($errors->has('email'))
                        <div class="error">{{ $errors->last('email') }}</div>
                      @endif
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="phone_number">{{ __('adminlte::adminlte.contact_number') }}</label>
                      <input id="jquery-intl-phone" type="tel" name="phone_number" class="form-control" id="phone_number" value="+44" maxlength="13">
                        <input type="hidden" name="country_code" value="+44">
                    </div>
                  </div>
                </div>
                    
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="password">{{ __('adminlte::adminlte.password') }}<span class="text-danger"> *</span></label>
                      <input type="password" name="password" class="form-control" id="password" maxlength="100">
                      @if($errors->has('password'))
                        <div class="error">{{ $errors->last('password') }}</div>
                      @endif
                    </div>
                  </div>
                  
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="confirm_password">{{ __('adminlte::adminlte.confirm_password') }}<span class="text-danger"> *</span></label>
                      <input type="password" name="confirm_password" class="form-control" id="confirm_password" maxlength="100">
                      @if($errors->has('confirm_password'))
                        <div class="error">{{ $errors->last('confirm_password') }}</div>
                      @endif
                    </div>
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
          first_name: {
            required: true
          },
          last_name: {
            required: true
          },
          email: {
            required: true,
            email: true
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
          phone_number: {
            regex: /^[\d ()+-]+$/,
            minlength: 7,
            maxlength: 15
          },
        },
        messages: {
          /* name: {
            required: "The Name field is required."
          }, */
          first_name: {
            required: "The First Name field is required."
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
