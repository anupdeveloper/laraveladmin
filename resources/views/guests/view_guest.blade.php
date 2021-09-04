@extends('adminlte::page')

@section('title', 'Guest Information')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header alert d-flex justify-content-between align-items-center">
          <h3>{{ __('adminlte::adminlte.guest_information') }}</h3>
          <!-- <a class="btn btn-sm btn-success" href="{{ route('guests_list') }}">Back to Guests</a>
          <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">Back to Prevous Page</a> -->
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
              <div class="col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.email') }}</label>
                  <input class="form-control" placeholder="{{ $guest->email }}" readonly>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.created_date') }}</label>
                  <input class="form-control" placeholder="{{ $guest->created_at ? date('d/m/y', strtotime($guest->created_at)) : '' }}" readonly>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.view_resume') }}</label><br><br>
                  <?php
                    $defaultPath = config('adminlte.website_url').'images/';
                    $resumePath = config('adminlte.website_url').'guest_resume/';
                    $extension = explode('.', $guest->resume)[1]; ?>
                    @if($extension == 'pdf')
                      <a target="_blank" href="{{ $resumePath.$guest->resume }}">
                        <img style="width:60px;" class="attached-pdf" src="{{ $defaultPath.'pdf_logo.jpeg' }}">
                      </a>
                    @elseif($extension == 'doc')
                      <a target="_blank" href="{{ $resumePath.$guest->resume }}">
                        <img style="width:60px;" class="attached-doc" src="{{ $defaultPath.'doc_logo.jpeg' }}">
                      </a>
                    @endif
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
@stop

@section('js')
@stop
