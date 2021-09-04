@extends('adminlte::page')

@section('title', 'Add Skill')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header alert d-flex justify-content-between align-items-center">
            <h3>{{ __('adminlte::adminlte.add_skill') }}</h3>
            <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
          </div>
          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
            <form id="addSkillForm" method="post" action="{{ route('save_skill') }}">
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
                        <label for="name">{{ __('adminlte::adminlte.name') }}<span class="text-danger"> *</span></label>
                        <input type="text" name="name" class="form-control" id="name" maxlength="100">
                        <div id ="industry_error" class="error"></div>
                        @if($errors->has('name'))
                          <div class="error">{{ $errors->first('name') }}</div>
                        @endif
                      </div>
                    </div>
                    
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
                        <label for="description">Skill Description<span class="text-danger"> *</span></label>
                        <textarea id="description" name="description" maxlength="1000"></textarea>
                        @if($errors->has('description'))
                          <div class="error">{{ $errors->last('description') }}</div>
                        @endif
                      </div>
                    </div> -->
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
      $("#name").blur(function() {
        $.ajax({
          type:"GET",
          url:"{{ route('check_if_exists') }}",
          data: {
            name: $(this).val(),
            table_name: 'skills'
          },
          success: function(result) {
            if(result) {
              $("#industry_error").html("This Skill is already added.");
            }
            else {
              $("#industry_error").html("");
            }
          }
        });
      });
      $('#addSkillForm').validate({
        ignore: [],
        debug: false,
        rules: {
          name: {
            required: true
          },
          status: {
            required: true
          },
          /* description:{
            required: function() {
              CKEDITOR.instances.description.updateElement();
            },
            minlength:10
          }, */
        },
        messages: {
          name: {
            required: "The Skill Name field is required."
          },
          status: {
            required: "The Status field is required."
          },
          /* description: {
            required: "The Skill Description field is required.",
            minlength: "Minimum Length must be 10"
          }, */
        }
      });
    });
  </script>
@stop
