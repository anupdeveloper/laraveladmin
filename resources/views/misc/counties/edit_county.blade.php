@extends('adminlte::page')

@section('title', 'Edit County')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header alert d-flex justify-content-between align-items-center">
            <h3>{{ __('adminlte::adminlte.edit_county') }}</h3>
            <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
          </div>
          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif

            <form id="editCountyForm" method="post" action="{{ route('update_county') }}">
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
                    <div class="col-6">
                      <div class="form-group">
                        <label for="county">{{ __('adminlte::adminlte.county_name') }}<span class="text-danger"> *</span></label>
                        <input type="hidden" name="id" id="id" value="{{ $county->id }}">
                        <input type="text" name="county" class="form-control" id="county" value="{{ $county->county }}" maxlength="100">
                        <div id ="function_error" class="error"></div>
                        @if($errors->has('county'))
                          <div class="error">{{ $errors->first('county') }}</div>
                        @endif
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="country">{{ __('adminlte::adminlte.country') }}<span class="text-danger"> *</span></label>
                        <input type="text" name="country" class="form-control" id="country" value="{{ $county->country }}" maxlength="100">
                        <!-- <select name="country" class="form-control" id="country">
                        @foreach($countries as $country)
                          <option value="{{ $country->name }}" {{ $country->name == $county->country ? 'selected' : '' }}>{{ $country->name }}</option>
                        @endforeach
                        </select> -->
                        <div id ="function_error" class="error"></div>
                        @if($errors->has('country'))
                          <div class="error">{{ $errors->first('country') }}</div>
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
@stop

@section('js')
  <script>
    $(document).ready(function() {
      $('#editCountyForm').validate({
        ignore: [],
        debug: false,
        rules: {
          county: {
            required: true
          },
          country: {
            required: true
          },
        },
        messages: {
          county: {
            required: "The County Name field is required."
          },
          country: {
            required: "The Country field is required."
          },
        }
      });
    });
  </script>
@stop
