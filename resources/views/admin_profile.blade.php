@extends('adminlte::page')

@section('title', 'My Profile')

@section('content_header')
  <a class="btn btn-sm btn-success back-button" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
  <h1>My Profile</h1>
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">{{ __('Edit Profile') }}</div>
        <div class="card-body">
          @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
          @endif

          <form id="updateProfileForm" method="post" action="{{ route('update_profile') }}">
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
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="name">{{ __('adminlte::adminlte.name') }}<span class="text-danger"> *</span></label>
                  <input type="hidden" name="id" value="{{ $userDetails->id }}">
                  <input type="text" name="name" class="form-control" id="name" value="{{ $userDetails->name }}" maxlength="100">
                  @if($errors->has('name'))
                    <div class="error">{{ $errors->first('name') }}</div>
                  @endif
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">{{ __('adminlte::adminlte.update') }}</button>
                  </div>
                </div>
              </div>
            </div>
          </form>

        </div>
      </div>

      <!-- Change Password Section -->

      <div class="card">
        <div class="card-header">{{ __('Change Password') }}</div>
        <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
          @endif

          <form id="changePasswordForm" method="post" action="{{ route('change_password') }}">
            @csrf
            <input type="hidden" name="id" value="{{ $userDetails->id }}">
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
            </div>
            <div class="row">
              <div class="col-sm-12">

                <div class="form-group">
                  <label for="old_password">{{ __('adminlte::adminlte.old_password') }}<span class="text-danger"> *</span></label>
                  <input type="password" name="old_password" class="form-control" id="old_password" maxlength="100">
                  @if($errors->has('old_password'))
                    <div class="error">{{ $errors->first('old_password') }}</div>
                  @endif
                  <div class="error" id="old_password_error"></div>
                </div>

                <div class="form-group">
                  <label for="password">{{ __('adminlte::adminlte.new_password') }}<span class="text-danger"> *</span></label>
                  <input type="password" name="password" class="form-control" id="password" maxlength="100">
                  @if($errors->has('password'))
                    <div class="error">{{ $errors->first('password') }}</div>
                  @endif
                  <div class="error" id="password_error"></div>
                </div>

                <div class="form-group">
                  <label for="confirm_password">{{ __('adminlte::adminlte.confirm_password') }}<span class="text-danger"> *</span></label>
                  <input type="password" name="confirm_password" class="form-control" id="confirm_password" maxlength="100">
                  @if($errors->has('confirm_password'))
                    <div class="error">{{ $errors->first('confirm_password') }}</div>
                  @endif
                </div>
                
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">{{ __('adminlte::adminlte.update') }}</button>
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
  <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
  <script>
    $(document).ready(function() {
      $("#old_password").blur(function() {
        $.ajax({
          type:"POST",
          url:"{{ route('check_password') }}",
          data: {
            password: $("#old_password").val(),
            password_type: 'old',
            _token: '{{csrf_token()}}'
          },
          success: function(result) {
            console.log(result);
            if(result) {
              $("#old_password_error").html("The Old Password is not correct.");
            }
            else {
              $("#old_password_error").html("");
            }
          }
        });
      });
      $("#password").blur(function() {
        $.ajax({
          type:"POST",
          url:"{{ route('check_password') }}",
          data: {
            password: $("#password").val(),
            password_type: 'new',
            _token: '{{csrf_token()}}'
          },
          success: function(result) {
            console.log(result);
            if(result) {
              $("#password_error").html("The New Password must be different from Old Password.");
            }
            else {
              $("#password_error").html("");
            }
          }
        });
      });
      $("#updateProfileForm").validate({
        rules: {
          name: {
            required: true
          }
        },
        messages: {
          name: {
            required: 'The Name field is required.'
          }
        }
      });
      $("#changePasswordForm").validate({
        rules: {
          old_password: {
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
        },
        messages: {
          old_password: {
            required: "The Old Password field is required."
          },
          password: {
            required: "The New Password field is required.",
            minlength: "Minimum length should be 8"
          },
          confirm_password: {
            required: "The Confirm Password field is required.",
            minlength: "Minimum length should be 8",
            equalTo : "The Confirm Password must be equal to Password."
          },
        }
      });
    })
  </script>
@stop
