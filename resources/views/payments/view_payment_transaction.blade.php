@extends('adminlte::page')

@section('title', 'Payment Transaction Information')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header alert d-flex justify-content-between align-items-center">
          <h3>{{ __('adminlte::adminlte.payment_transaction_information') }}</h3>
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
                  @if($organization != null)
                    <input class="form-control" placeholder="{{ $organization->name ? $organization->name : '' }}" readonly>
                  @else
                    <input class="form-control" placeholder="" readonly>
                  @endif
                </div>
              </div>
              
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.recruiter_name') }}</label>
                  <input class="form-control" placeholder="{{ $recruiter->name ? $recruiter->name : $recruiter->email }}" readonly>
                </div>
              </div>
              
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.amount') }}</label>
                  <input class="form-control" placeholder="£{{ $paymentTransaction->amount ? $paymentTransaction->amount : '0.00' }}" readonly>
                </div>
              </div>
              
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.transaction_id') }}</label>
                  <input class="form-control" placeholder="{{ $paymentTransaction->txn_id ? $paymentTransaction->txn_id : '' }}" readonly>
                </div>
              </div>
              
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.status') }}</label>
                  <input class="form-control" placeholder="{{ $paymentTransaction->status ? ucfirst($paymentTransaction->status) : '' }}" readonly>
                </div>
              </div>
              
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.payment_date') }}</label>
                  <input class="form-control" placeholder="{{ $paymentTransaction->created_at ? date('d/m/y', strtotime($paymentTransaction->created_at)) : '' }}" readonly>
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
