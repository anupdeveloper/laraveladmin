@extends('adminlte::page')

@section('title', 'Mobile Page Content')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <a class="btn btn-sm btn-success back-button" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
            <h3>Mobile Page Content</h3>
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
                    <label>Title</label>
                    <input class="form-control" placeholder="{{ $pageContent->title }}" readonly>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label>View</label>
                    <input class="form-control" placeholder="{{ ucfirst($pageContent->device_type) }}" readonly>
                  </div>
                </div>
              </div>
              
              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label>Added By</label>
                    <input class="form-control" placeholder="{{ $addedBy->first_name.' '.$addedBy->last_name }}" readonly>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label>Updated By</label>
                    <input class="form-control" placeholder="{{ $updatedBy->first_name.' '.$updatedBy->last_name }}" readonly>
                  </div>
                </div>
              </div>
              
              <div class="row">
              </div>
              
              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label>Last Updated</label>
                    <input class="form-control" placeholder="{{ date('d/m/y', strtotime($pageContent->last_updated_at)) }}" readonly>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label>Created Date</label>
                    <input class="form-control" placeholder="{{ date('d/m/y', strtotime($pageContent->created_at)) }}" readonly>
                  </div>
                </div>
              </div>
              
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label>Updated Date</label>
                    <input class="form-control" placeholder="{{ date('d/m/y', strtotime($pageContent->updated_at)) }}" readonly>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label>Content</label>
                    <div style="background-color: #efefef; padding: 15px; border-radius: 5px;">{!! $pageContent->content !!}<div>
                  </div>
                </div>
              </div>
              
              <div class="row">
              </div>
            </form>
          </div>
        </div>
      </div>
  </div>
</div>
@endsection