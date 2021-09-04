@extends('adminlte::page')

@section('title', 'Add Teacher')

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
            <form id="addJobseekerForm" method="post", action="{{ route('save_teacher') }}">
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
                      <label for="first_name">First Name</label>
                      <input type="text" name="first_name" class="form-control" id="first_name" maxlength="100">
                      @if($errors->has('first_name'))
                        <div class="error">{{ $errors->first('first_name') }}</div>
                      @endif
                    </div>
                  </div>
                </div>



                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="first_name">Last Name</label>
                      <input type="text" name="last_name" class="form-control" id="last_name" maxlength="100">
                      @if($errors->has('first_name'))
                        <div class="error">{{ $errors->first('first_name') }}</div>
                      @endif
                    </div>
                  </div>


                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="email">Email<span class="text-danger"> *</span></label>
                      <input type="text" name="email" class="form-control" id="email" maxlength="100">
                      @if($errors->has('email'))
                        <div class="error">{{ $errors->first('email') }}</div>
                      @endif
                    </div>
                  </div>


                </div>

                <div class="row">
                  
                  <div class="col-sm-6">
                  <div class="form-group radio">
                    <div class="job_alerts">
                      <label>Email Verified</label>
                      <label class="switch">
                          <input name="email_verified" type="checkbox" }}>
                          <span class="slider round"></span>
                      </label>


                    </div>
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

@stop
