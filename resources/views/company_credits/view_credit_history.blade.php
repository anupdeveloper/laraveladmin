@extends('adminlte::page')

@section('title', 'Credit History Information')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header alert d-flex justify-content-between align-items-center">
          <h3>{{ __('adminlte::adminlte.credits_history_information') }}</h3>
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
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.company_name') }}</label>
                  <?php $company = \App\Models\Organization::where('id', $viewCreditHistory->organization_id)->get(); ?>
                  <input class="form-control" placeholder="{{ $company[0]->name }}" readonly maxlength="100">
                </div>
              </div>
              
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.amount') }}</label>
                  <input class="form-control" placeholder="{{ $viewCreditHistory->credits ? $viewCreditHistory->credits : '0.00' }}" readonly>
                </div>
              </div>
              
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.added_by') }}</label>
                  @if($recruiter != null)
                    <!-- <a class="recruiter-view-link" href="{{ route('view_recruiter', [ 'id' => $recruiter->id ]) }}"> --><input class="form-control" placeholder="{{ $recruiter->first_name ? $recruiter->first_name.' '.$recruiter->last_name : $recruiter->email }}" disabled><!-- </a> -->
                    @elseif($admin != null)
                      <input class="form-control" placeholder="{{ $admin->name ? $admin->name : $admin->email }}" disabled>
                    @else
                    <input class="form-control" readonly>
                  @endif
                </div>
              </div>
              
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.transaction_type') }}</label>
                  <input class="form-control" placeholder="{{ $viewCreditHistory->txn_type ? ucfirst($viewCreditHistory->txn_type) : '0.00' }}" readonly>
                </div>
              </div>
              
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.credit_type') }}</label>
                  <input class="form-control" placeholder="{{ $viewCreditHistory->credit_type ? ucfirst($viewCreditHistory->credit_type) : '0.00' }}" readonly>
                </div>
              </div>
              
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.added_on') }}</label>
                  <input class="form-control" placeholder="{{ $viewCreditHistory->created_at ? date('d/m/y', strtotime($viewCreditHistory->created_at)) : '' }}" readonly>
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
