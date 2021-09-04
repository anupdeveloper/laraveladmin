@extends('adminlte::page')

@section('title', 'Contact Us Details')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <a class="btn btn-sm btn-success back-button" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
            <h3>Contact Us Details</h3>
          </div>
          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
            <?php 
              if($contactUsMessage->user_id != null) {
                $user = \App\Models\User::find($contactUsMessage->user_id);
                $username = $user->first_name ? $user->first_name.' '.$user->last_name : $user->email;
                $userType = 'Jobseeker';
              }
              else if($contactUsMessage->recruiter_id != null) {
                $user = \App\Models\Recruiter::find($contactUsMessage->recruiter_id);
                $username = $user->first_name ? $user->first_name.' '.$user->last_name : $user->email;
                $userType = 'Recruiter';
              }
              else { 
                $username = "";
                $userType = 'Guest';
              }

              $url = config('adminlte.website_url', '').'contactUsFiles/';
              $destinationPath = config('adminlte.admin_url').'images/';
              $filePath = $contactUsMessage->file ? $url.$contactUsMessage->file : '';
              if($contactUsMessage->file != null) {
                $extension = explode('.', $contactUsMessage->file)[1];
              }
              else {
                $extension = '';
              }
              ?>
            <form class="form_wrap">
              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label>Name</label>
                    <input class="form-control" placeholder="{{ $contactUsMessage->name }}" readonly>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label>Email</label>
                    <input class="form-control" placeholder="{{ $contactUsMessage->email }}" readonly>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label>Contact Number</label>
                    <input class="form-control" placeholder="{{ $contactUsMessage->contact_number }}" readonly>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label>Subject</label>
                    <input class="form-control" placeholder="{{ $contactUsMessage->subject }}" readonly>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label>Message</label>
                    <div style="background-color: #efefef; padding: 15px; border-radius: 5px;">{!! $contactUsMessage->message !!}<div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label>Created Date</label>
                    <input class="form-control" placeholder="{{ date('d/m/y', strtotime($contactUsMessage->created_at)) }}" readonly>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                    @if($extension == 'pdf')
                      <label>Uploafded File</label><br>
                      <a target="_blank" href="{{ $filePath }}">
                        <img style="width:50px;" class="attached-pdf" src="{{ $destinationPath.'adobe-pdf-icon.svg' }}">
                      </a>
                    @elseif($extension == 'doc' || $extension == 'doxc')
                      <label>Uploafded File</label><br>
                      <a target="_blank" href="{{ $filePath }}">
                        <img style="width:50px;" class="attached-doc" src="{{ $destinationPath.'wordfile.png' }}">
                      </a>
                    @elseif($extension == 'xls' || $extension == 'ods')
                      <label>Uploafded File</label><br>
                      <a target="_blank" href="{{ $filePath }}">
                        <img style="width:50px;" class="attached-doc" src="{{ $destinationPath.'xls.jpeg' }}">
                      </a>
                    @elseif($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png' || $extension == 'gif')
                      <label>Uploafded File</label><br>
                      <a target="_blank" href="{{ $filePath }}">
                        <img style="width:50px;" class="attached-image" src="{{ $filePath }}">
                      </a>
                    @elseif($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png' || $extension == 'gif')
                      <label>Uploafded File</label><br>
                      <a target="_blank" href="{{ $filePath }}">
                        <img style="width:50px;" class="attached-image" src="{{ $filePath }}">
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