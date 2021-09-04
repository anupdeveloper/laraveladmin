@extends('adminlte::page')

@section('title', 'Feedbacks')

@section('content_header')
@stop

@section('content')
<div class="">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header alert d-flex justify-content-between align-items-center">
            <h3>Feedbacks</h3>
          </div>
          <div class="card-body">
            <table style="width:100%" id="pages-list" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th class="display-none"></th>
                  <th>Rating</th>
                  <th>Email</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php for ($i=0; $i < count($feedbacksList); $i++) {
                  $user = null;
                  $userType = null;
                  $username = null;
                  if($feedbacksList[$i]->user_id != null) {
                    $user = \App\Models\User::find($feedbacksList[$i]->user_id);
                    $username = $user->first_name.' '.$user->last_name;
                    $userType = 'Jobseeker';
                  }
                  else if($feedbacksList[$i]->recruiter_id != null) {
                    $user = \App\Models\Recruiter::find($feedbacksList[$i]->recruiter_id);
                    $username = $user->first_name.' '.$user->last_name;
                    $userType = 'Recruiter';
                  }
                  else { 
                    $username = "";
                    $userType = 'Guest';
                  }
                  ?>
                  <tr>
                    <td class="display-none"></td>
                    <td>
                      <span style="display:none">{{ $feedbacksList[$i]->rating }}</span>
                      <input type="hidden" class="rating" id="rating_{{ $feedbacksList[$i]->rating }}" value="{{ $feedbacksList[$i]->rating }}">
                      <div>
                        <i class="fa fa-star text-grey" id="1_{{ $feedbacksList[$i]->rating }}" aria-hidden="true"></i>
                        <i class="fa fa-star text-grey" id="2_{{ $feedbacksList[$i]->rating }}" aria-hidden="true"></i>
                        <i class="fa fa-star text-grey" id="3_{{ $feedbacksList[$i]->rating }}" aria-hidden="true"></i>
                        <i class="fa fa-star text-grey" id="4_{{ $feedbacksList[$i]->rating }}"  aria-hidden="true"></i>
                        <i class="fa fa-star text-grey" id="5_{{ $feedbacksList[$i]->rating }}"  aria-hidden="true"></i>
                      </div>
                    </td>
                    <td>{{ $feedbacksList[$i]->email }}</td>
                      <td>
                        <a href="{{ route('view_feedback', ['id' => $feedbacksList[$i]->id]) }}" title="View"><i class="text-info fa fa-eye"></i></a>
                      </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
  </div>
</div>
@endsection

@section('css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
@stop

@section('js')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script>
    $('#pages-list').DataTable( {
      columnDefs: [ {
        targets: 0,
        render: function ( data, type, row ) {
          return data.substr( 0, 2 );
        }
      }]
    });

    var ratingEl = document.getElementsByClassName('rating');
    var rating;
    for (let i = 0; i < ratingEl.length; i++) {
      const element = ratingEl[i];
      rating = $(element).val();
      for(let i = 1; i <= 5; ++i) {
        if(rating >= i) {
          $("#"+i+"_"+rating).removeClass('text-grey');
          $("#"+i+"_"+rating).addClass('text-warning');
        }
      }
    }
  </script>
@stop
