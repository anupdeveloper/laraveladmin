@extends('adminlte::page')

@section('title', 'Feedback Details')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <a class="btn btn-sm btn-success back-button" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
            <h3>Feedback Details</h3>
          </div>
          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
            <?php 
              if($feedback->user_id != null) {
                $user = \App\Models\User::find($feedback->user_id);
                $username = $user->first_name ? $user->first_name.' '.$user->last_name : $user->email;
                $userType = 'Jobseeker';
              }
              else if($feedback->recruiter_id != null) {
                $user = \App\Models\Recruiter::find($feedback->recruiter_id);
                $username = $user->first_name ? $user->first_name.' '.$user->last_name : $user->email;
                $userType = 'Recruiter';
              }
              else { 
                $username = "";
                $userType = 'Guest';
              }

              $url = config('adminlte.website_url', '').'feedbackFiles/';
              $destinationPath = config('adminlte.admin_url').'images/';
              $filePath = $feedback->file ? $url.$feedback->file : '';
              if($feedback->file != null) {
                $extension = explode('.', $feedback->file)[1];
              }
              else {
                $extension = '';
              }
              ?>
            <form class="form_wrap">
              <div class="row">              
                <div class="col-12">
                  <div class="form-group">
                    <label>Rating</label>
                    <input type="hidden" id="rating" value="{{ $feedback->rating }}">
                    <div>
                      <i class="fa fa-star text-grey" id="1" aria-hidden="true"></i>
                      <i class="fa fa-star text-grey" id="2" aria-hidden="true"></i>
                      <i class="fa fa-star text-grey" id="3" aria-hidden="true"></i>
                      <i class="fa fa-star text-grey" id="4"  aria-hidden="true"></i>
                      <i class="fa fa-star text-grey" id="5"  aria-hidden="true"></i>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label>Email</label>
                    <input class="form-control" placeholder="{{ $feedback->email }}" readonly>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label>Message</label>
                    <div style="background-color: #efefef; padding: 15px; border-radius: 5px;">{!! $feedback->message !!}<div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label>Created Date</label>
                    <input class="form-control" placeholder="{{ date('d/m/y', strtotime($feedback->created_at)) }}" readonly>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-12">
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


@section('js')
  <script>
    $(document).ready(function() {
      var rating = $("#rating").val();
      for (let i = 1; i <= 5; ++i) {
        if(rating >= i) {
          console.log(i);
          console.log(rating);
          $("#"+i).removeClass('text-grey');
          $("#"+i).addClass('text-warning');
        }
      }
    });
  </script>
@stop