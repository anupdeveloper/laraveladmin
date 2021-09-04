@extends('adminlte::page')

@section('title', 'Edit Recruiter')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header alert d-flex justify-content-between align-items-center">
            <h3>{{ __('adminlte::adminlte.edit_recruiter') }}</h3>
            <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
          </div>
          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
            <form id="editRecruiterForm" method="post", action="{{ route('update_recruiter') }}">
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
                <input type="hidden" name="id" value="{{ $recruiter->id }}">
                <!-- Form Fields -->
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="first_name">{{ __('adminlte::adminlte.first_name') }}<span class="text-danger"> *</span></label>
                      <input type="text" name="first_name" class="form-control" id="first_name" value="{{ $recruiter->first_name }}" maxlength="100">
                      @if($errors->has('first_name'))
                        <div class="error">{{ $errors->first('first_name') }}</div>
                      @endif
                    </div>
                  </div>
                
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="last_name">{{ __('adminlte::adminlte.last_name') }}<span class="text-danger"> *</span></label>
                      <input type="text" name="last_name" class="form-control" id="last_name" value="{{ $recruiter->last_name }}" maxlength="100">
                      @if($errors->has('last_name'))
                        <div class="error">{{ $errors->last('last_name') }}</div>
                      @endif
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="phone_number">{{ __('adminlte::adminlte.contact_number') }}</label>
                      <input id="jquery-intl-phone" type="tel" name="phone_number" class="form-control" id="phone_number" value="{{ $recruiter->phone_number ? $recruiter->phone_number : '+44' }}" maxlength="13">
                        <input type="hidden" name="country_code" value="{{ $recruiter->country_code }}">
                    </div>
                  </div>
                  
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="email">{{ __('adminlte::adminlte.email') }}<span class="text-danger"> *</span></label>
                      <input type="text" name="email" class="form-control" id="email" value="{{ $recruiter->email }}" readonly maxlength="100">
                      @if($errors->has('email'))
                        <div class="error">{{ $errors->last('email') }}</div>
                      @endif
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="organization_id">{{ __('adminlte::adminlte.company') }}<span class="text-danger"> *</span></label>
                      <input type="text" class="form-control" name="organization_id" id="organization_id" value="{{ $organization->name }}" readonly>
                      @if($errors->has('organization_id'))
                        <div class="error">{{ $errors->first('organization_id') }}</div>
                      @endif
                    </div>
                  </div>
                </div>
                <!-- /Form Fields -->

              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ __('adminlte::adminlte.update') }}</button>
              </div>              
            </div>
              <!-- /.card-body -->
            </form>
          </div>
        </div>
      </div>
  </div>
</div>
@endsection

@section('css')
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
  <script>
    $(document).ready(function() {
      $.validator.addMethod("regex", function(value, element, regexp) {
        var re = new RegExp(regexp);
        return this.optional(element) || re.test(value);
      }, "The Contact Number must be in numbers only.");
      $('#editRecruiterForm').validate({
        ignore: [],
        debug: false,
        rules: {
          organization_id: {
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
          organization_id: {
            required: "The Company field is required."
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
  </script>
@stop
