@extends('adminlte::page')

@section('title', 'Customer Information')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header alert d-flex justify-content-between align-items-center">
          <h3>{{ __('adminlte::adminlte.customer_information') }}</h3>
          <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
        </div>                
        <div class="card-body">
          @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
          @endif
          <?php
            $websiteImagesPath = config("adminlte.website_url").'images/companyLogos/';
            $logo = $viewCustomer->logo != null ? $websiteImagesPath.$viewCustomer->logo : config("adminlte.default_avatar");
          ?>
          <form class="form_wrap customers-management-view">
            <div class="row">
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>Company Logo</label><br/>
                  <div id="preview-cropped-image" class="">
                  <?php 
                    $url = config('adminlte.website_url', '').'images/companyLogos/';
                    $filePath = $viewCustomer->logo ? $url.$viewCustomer->logo : config("adminlte.default_avatar");
                  ?>
                  <img id="profileImage" class="profile-image" src="{{ $filePath }}" alt="{{ $viewCustomer->name }} Logo">
                </label>
                </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.company_name') }}</label>
                  <input class="form-control" placeholder="{{ $viewCustomer->name }}" readonly>
                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.company_or_consultants_email') }}</label>
                  <input class="form-control" placeholder="{{ $viewCustomer->email }}" readonly>
                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.contact_number') }}</label>
                  <input class="form-control" placeholder="{{ $viewCustomer->contact_number ? $viewCustomer->contact_number : '' }}" readonly>
                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.vat_number') }}</label>
                  <input class="form-control" placeholder="{{ $viewCustomer->vat_number ? $viewCustomer->vat_number : '' }}" readonly>
                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.company_domain_url') }}</label>
                  <input class="form-control" placeholder="{{ $viewCustomer->url ? $viewCustomer->url : '' }}" readonly>
                </div>
              </div>
              <!-- <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.company_domain') }}</label>
                  <input class="form-control" placeholder="{{ $viewCustomer->domain ? $viewCustomer->domain : '' }}" readonly>
                </div>
              </div> -->
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.address') }}</label>
                  <input class="form-control" placeholder="{{ $viewCustomer->address ? $viewCustomer->address : '' }}" readonly>
                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.city') }}</label>
                  <input class="form-control" placeholder="{{ $viewCustomer->city ? $viewCustomer->city : '' }}" readonly>
                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.county') }}</label>
                  <input class="form-control" placeholder="{{ $viewCustomer->county ? $viewCustomer->county : '' }}" readonly>
                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.state') }}</label>
                  <input class="form-control" placeholder="{{ $viewCustomer->state ? $viewCustomer->state : '' }}" readonly>
                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.country') }}</label>
                  <input class="form-control" placeholder="{{ $viewCustomer->country ? $viewCustomer->country : '' }}" readonly>
                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.zip') }}</label>
                  <input class="form-control" placeholder="{{ $viewCustomer->pincode ? $viewCustomer->pincode : '' }}" readonly>
                </div>
              </div>
              <!-- <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>Location</label>
                  <input class="form-control" readonly>
                </div>
              </div> -->
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.whitelist_status') }}
                    <!-- <a href="../whitelist/{{$viewCustomer->id}}" title="Whitelist" class="pl-2"><i class="text-success fa fa-check-circle"></i></a>
                    <a href="../reject/{{$viewCustomer->id}}" title="Reject"><i class="text-danger fa fa-times-circle" style="margin-left:5px;"></i></a> -->
                  </label>
                  <?php $whitelistStatus;
                  if($viewCustomer->is_whitelisted == 0) {
                    $whitelistStatus = "Pending";
                  }
                  elseif($viewCustomer->is_whitelisted == 1) {
                    $whitelistStatus = "Whitelisted";
                  }
                  elseif($viewCustomer->is_whitelisted == 2) {
                    $whitelistStatus = "Rejected";
                  } ?>
                  <input class="form-control" placeholder="{{ $whitelistStatus }}" readonly>
                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.created_by') }}</label>
                  @if($creator != null)
                    <input class="form-control" placeholder="{{ $creator != null && $creator->first_name ? $creator->first_name.' '.$creator->last_name : $creator->email }}" readonly>
                  @else
                    <input class="form-control" readonly>
                  @endif
                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.created_date') }}</label>
                  <input class="form-control" placeholder="{{ $viewCustomer->created_at ? date('d/m/y', strtotime($viewCustomer->created_at)) : '' }}" readonly>
                </div>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                <div class="form-group">
                  <label>{{ __('adminlte::adminlte.last_updated_date') }}</label>
                  <input class="form-control" placeholder="{{ $viewCustomer->updated_at ? date('d/m/y', strtotime($viewCustomer->updated_at)) : '' }}" readonly>
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
<style>
  #profileImage {
    height: 150px;
    width: 200px;
    border-radius: 10px;
    object-fit: contain;
    background-color: #fbfbfb;
    border: 1px solid #343d49;
    padding: 10px;
  }
</style>
@stop

@section('js')
@stop
