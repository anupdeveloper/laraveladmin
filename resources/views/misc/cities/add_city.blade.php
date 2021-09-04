@extends('adminlte::page')

@section('title', 'Add City')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header alert d-flex justify-content-between align-items-center">
            <h3>{{ __('adminlte::adminlte.add_city') }}</h3>
            <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
          </div>
          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif

            <form id="addCityForm" method="post" action="{{ route('save_city') }}">
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
                    <div class="col-12">
                      <div class="form-group">
                        <label for="city">{{ __('adminlte::adminlte.city_name') }}<span class="text-danger"> *</span></label>
                        <input type="text" name="city" class="form-control" id="city" maxlength="100">
                        <div id ="function_error" class="error"></div>
                        @if($errors->has('city'))
                          <div class="error">{{ $errors->first('city') }}</div>
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
      $('#addCityForm').validate({
        ignore: [],
        debug: false,
        rules: {
          city: {
            required: true
          },
          status: {
            required: true
          },
        },
        messages: {
          city: {
            required: "The City Name field is required."
          },
          status: {
            required: "The Status field is required."
          },
        }
      });
    });
  </script>
@stop
