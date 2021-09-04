@extends('adminlte::page')

@section('title', 'County Information')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header alert d-flex justify-content-between align-items-center">
            <h3>County Details</h3>
            <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
          </div>
          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
            
            <form class="form_wrap">
              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label>{{ __('adminlte::adminlte.county_name') }}</label>
                    <input class="form-control" placeholder="{{ $county->county }}" readonly>
                  </div>
                </div>
                
                <div class="col-6">
                  <div class="form-group">
                    <label>{{ __('adminlte::adminlte.country') }}</label>
                    <input class="form-control" placeholder="{{ $county->country }}" readonly>
                  </div>
                </div>
                
                <div class="col-6">
                  <div class="form-group">
                    <label>{{ __('adminlte::adminlte.created_date') }}</label>
                    <input class="form-control" placeholder="{{ $county->created_at ? date('d/m/y', strtotime($county->created_at)) : '' }}" readonly>
                  </div>
                </div>
                
                <div class="col-6">
                  <div class="form-group">
                    <label>{{ __('adminlte::adminlte.last_updated_date') }}</label>
                    <input class="form-control" placeholder="{{ $county->updated_at ? date('d/m/y', strtotime($county->updated_at)) : '' }}" readonly>
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