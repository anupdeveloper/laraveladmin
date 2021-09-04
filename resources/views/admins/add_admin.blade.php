@extends('adminlte::page')

@section('title', 'Add Admin')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header alert d-flex justify-content-between align-items-center">
            <h3>{{ __('adminlte::adminlte.add_admin') }}</h3>
            <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
          </div>
          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
            <form id="addAdminForm" method="post", action="{{ route('save_admin') }}">
              @csrf
              <div class="card-body">                
                <div class="row">

                  <div class="col-12">
                    <div class="form-group">
                      <label for="name">{{ __('adminlte::adminlte.name') }}<span class="text-danger"> *</span></label>
                      <input type="text" name="name" class="form-control" id="name" maxlength="100">
                      @if($errors->has('name'))
                        <div class="error">{{ $errors->first('name') }}</div>
                      @endif
                    </div>
                  </div>

                <div class="col-6">
                  <div class="form-group">
                    <label for="email">{{ __('adminlte::adminlte.email') }}<span class="text-danger"> *</span></label>
                    <input type="text" name="email" class="form-control" id="email" placeholder="Ex: emaple@whichvocation.com" maxlength="100">
                    <div id ="email_error" class="error"></div>
                    @if($errors->has('email'))
                      <div class="error">{{ $errors->last('email') }}</div>
                    @endif
                  </div>
                </div>

                <div class="col-6">
                  <div class="form-group">
                    <label for="role_id">{{ __('adminlte::adminlte.role') }}<span class="text-danger"> *</span></label>
                    <select name="role_id" class="form-control" id="role_id">
                      <option value="" hidden>{{ __('adminlte::adminlte.select_role') }}</option>
                      <?php for ($i=0; $i < count($roles); $i++) { ?> 
                        <option value="{{ $roles[$i]->id }}">{{ $roles[$i]->name }}</option>
                      <?php } ?>
                    </select>
                    @if($errors->has('role_id'))
                      <div class="error">{{ $errors->last('role_id') }}</div>
                    @endif
                  </div>
                </div>

                <div class="col-6">
                  <div class="form-group">
                    <label for="password">{{ __('adminlte::adminlte.password') }}<span class="text-danger"> *</span></label>
                    <input type="password" name="password" class="form-control" id="password" maxlength="100">
                    @if($errors->has('password'))
                      <div class="error">{{ $errors->last('password') }}</div>
                    @endif
                  </div>
                </div>

                <div class="col-6">
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
            table_name: 'admins'
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
      $('#addAdminForm').validate({
        ignore: [],
        debug: false,
        rules: {
          name: {
            required: true
          },
          email: {
            required: true,
            email: true
          },
          role_id: {
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
          name: {
            required: "The Name field is required."
          },
          email: {
            required: "The Email field is required.",
            email: "Please enter a valid Email"
          },
          role_id: {
            required: "The Role field is required."
          },
          password: {
            required: "The Password field is required.",
            minlength: "Minimum length should be 8"
          },
          confirm_password: {
            required: "The Confirm Password field is required.",
            minlength: "Minimum length should be 8",
            equalTo : "The Confirm Password must be equal to Password."
          },
        }
      });
    });
  </script>
@stop
