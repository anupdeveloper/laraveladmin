@extends('adminlte::page')

@section('title', 'Add Job Qualification')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header alert d-flex justify-content-between align-items-center">
            <h3>Add Job Qualification</h3>
            <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
          </div>
          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
            <form id="addJobQualficationForm" method="post" action="{{ route('save_job_qualification') }}">
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
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="job_industry_id">{{ __('adminlte::adminlte.job_industry') }}<span class="text-danger"> *</span></label>
                        <select name="job_industry_id" class="form-control" id="job_industry_id">
                          @foreach($jobIndustries as $jobIndustry)
                            <option value="{{ $jobIndustry->id }}">{{ $jobIndustry->name }}</option>
                          @endforeach
                        </select>
                        <div id ="industry_error" class="error"></div>
                        @if($errors->has('job_industry_id'))
                          <div class="error">{{ $errors->first('job_industry_id') }}</div>
                        @endif
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="name">{{ __('adminlte::adminlte.name') }}<span class="text-danger"> *</span></label>
                        <input type="text" name="name" class="form-control" id="name" maxlength="100">
                        <div id ="industry_error" class="error"></div>
                        @if($errors->has('name'))
                          <div class="error">{{ $errors->first('name') }}</div>
                        @endif
                      </div>
                    </div>
                  </div>
                    
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="status">{{ __('adminlte::adminlte.status') }}<span class="text-danger"> *</span></label>
                        <select name="status" class="form-control" id="status">
                          <option value="1">{{ __('adminlte::adminlte.active') }}</option>
                          <option value="0">{{ __('adminlte::adminlte.inactive') }}</option>
                        </select>
                        @if($errors->has('status'))
                          <div class="error">{{ $errors->first('status') }}</div>
                        @endif
                      </div>
                    </div>
                    
                    <!-- <div class="col-sm-12">
                      <div class="form-group">
                        <label for="description">Job Industry Description<span class="text-danger"> *</span></label>
                        <textarea id="description" name="description" maxlength="1000"></textarea>
                        @if($errors->has('description'))
                          <div class="error">{{ $errors->last('description') }}</div>
                        @endif
                      </div>
                    </div>
                  </div> -->
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
  <style>
    .information_fields { margin-bottom: 30px; }
    .address_fields { margin-top: 30px; }
  </style>
@stop

@section('js')
  <script>
    $(document).ready(function() {
      CKEDITOR.replace( 'description', {
        customConfig : 'config.js',
        toolbar : 'simple'
      });
      $('#addJobQualficationForm').validate({
        ignore: [],
        debug: false,
        rules: {
          job_industry_id: {
            required: true
          },
          name: {
            required: true
          },
          status: {
            required: true
          },
        },
        messages: {
          job_industry_id: {
            required: "The Job Industry field is required."
          },
          name: {
            required: "The Job Qualification Name field is required."
          },
          status: {
            required: "The Status field is required."
          },
        }
      });
    });
  </script>
@stop
