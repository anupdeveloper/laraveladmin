@extends('adminlte::page')

@section('title', 'Edit Mobile Content')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <a class="btn btn-sm btn-success back-button" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
            <h3>Edit Mobile Content</h3>
          </div>
          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
            <form id="editContentForm" method="post" action="{{ route('update_mobile_page') }}">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="page_title">Title</label>
                  <input type="hidden" name="id" value="{{ $pageContent->id }}" readonly>
                  <input type="title" name="title" class="form-control" id="page_title" value="{{ $pageContent->title }}" readonly>
                  @if($errors->has('title'))
                    <div class="error">{{ $errors->first('title') }}</div>
                  @endif
                </div>
                <div class="form-group">
                  <label for="section">Section</label>
                  <select name="section" class="form-control" id="section" disabled>
                    @foreach($pageSections as $pageSection)
                      <option value="{{ $pageSection->slug }}" {{ $pageContent->section == $pageSection->slug ? 'selected' : '' }}>{{ $pageSection->title }}</option>
                    @endforeach
                  </select>
                  @if($errors->has('section'))
                    <div class="error">{{ $errors->first('section') }}</div>
                  @endif
                </div>
                <label for="content">Page Content</label>
                <textarea id="content" name="content">{{ $pageContent->content }}</textarea>
                <div class="form-group mb-0">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="content" class="custom-control-input">
                  @if($errors->has('content'))
                    <div class="error">{{ $errors->first('content') }}</div>
                  @endif
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
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
      // content
      CKEDITOR.replace( 'content', {
        customConfig : 'config.js',
        toolbar : 'simple'
      })
      $('#editContentForm').validate({
        ignore: [],
        debug: false,
        rules: {
          title: {
            required: true
          },
          content:{
            required: function() {
              CKEDITOR.instances.content.updateElement();
            },
            minlength:10
          }
        },
        messages: {
          title: {
            required: "The Page Title field is required."
          },
          content: {
            required: "The Page Content field is required.",
            minlength: "Minimum Length must be 10"
          }
        }
      });
    });
  </script>
@stop
