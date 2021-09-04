@extends('adminlte::page')

@section('title', 'Add Customer')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
        <div class="card-header alert d-flex justify-content-between align-items-center">
          <a class="btn btn-sm btn-success back-button" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
            <h3>{{ __('adminlte::adminlte.add_customer') }}</h3>
          </div>
          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
            <form id="addCustomerForm" method="post", action="{{ route('save_customer') }}">
              @csrf
              <div class="card-body">
                @if ($errors->any())
                  <div class="alert alert-warning">
                    <ul>
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                @endif
                
                <!-- Form Fields -->
                
                <!-- INFORMATION FIELDS -->
                <div class="information_fields">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="name">{{ __('adminlte::adminlte.company_name') }}<span class="text-danger"> *</span></label>
                        <input type="text" name="name" class="form-control" id="name" maxlength="100">
                        @if($errors->has('name'))
                          <div class="error">{{ $errors->first('name') }}</div>
                        @endif
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="email">{{ __('adminlte::adminlte.company_or_consultants_email') }}<span class="text-danger"> *</span></label>
                        <input type="text" name="email" class="form-control" id="email" placeholder="Ex: emaple@whichvocation.com" maxlength="100">
                        <div id ="email_error" class="error"></div>
                        @if($errors->has('email'))
                          <div class="error">{{ $errors->first('email') }}</div>
                        @endif
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <!-- <div class="col-sm-6">
                      <div class="form-group">
                        <label for="contact_number">Contact Number<span class="text-danger"> *</span></label>
                        <input type="text" name="contact_number" class="form-control" id="contact_number" maxlength="100">
                        @if($errors->has('contact_number'))
                          <div class="error">{{ $errors->first('contact_number') }}</div>
                        @endif
                      </div>
                    </div> -->
                    <div class="col-md-6">
                      <div class="form-group mb-4 pb-md-3 pr-md-2 pb-2 pr-0">
                        <label class="required"><img src="{{asset('assets/images/contact.png')}}" alt="">{{ __('adminlte::adminlte.contact_number') }}</label>
                        <input id="jquery-intl-phone" type="tel" class="form-control" name="contact_number" value="+44" maxlength="13">
                        @if($errors->has('contact_number'))
                          <div class="error">{{ $errors->first('contact_number') }}</div>
                        @endif
                        <input type="hidden" name="country_code" value="44">
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="vat_number">{{ __('adminlte::adminlte.vat_number') }} ({{ __('adminlte::adminlte.optional') }})</label>
                        <input type="text" name="vat_number" class="form-control" id="vat_number" maxlength="100">
                        @if($errors->has('vat_number'))
                          <div class="error">{{ $errors->first('vat_number') }}</div>
                        @endif
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label for="url">{{ __('adminlte::adminlte.company_domain_url') }}<span class="text-danger"> *</span></label>
                        <input type="text" name="url" class="form-control" id="url" placeholder="Ex: http(s)://whichvocation.com OR http(s)://www.whichvocation.com" maxlength="100">
                        @if($errors->has('url'))
                          <div class="error">{{ $errors->first('url') }}</div>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /INFORMATION FIELDS -->
                <hr/>
                <!-- ADDRESS FIELDS -->
                <div class="address_fields">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="address">{{ __('adminlte::adminlte.address') }}<span class="text-danger"> *</span></label>
                        <input type="text" name="address" class="form-control" id="autocomplete" maxlength="100">
                        @if($errors->has('address'))
                          <div class="error">{{ $errors->first('address') }}</div>
                        @endif
                      </div>
                    </div>
                  
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="city">{{ __('adminlte::adminlte.city') }}<span class="text-danger"> *</span></label>
                        <input class="form-control" list="cities" name="city" id="city" placeholder="Start to enter City/ Town">
                        <datalist id="cities">
                          <?php for($i=0; $i<count($cities); $i++) { ?>
                            <option value="{{ $cities[$i]->city }}" {{ $cities[$i]->city == 'United Kingdom' ? 'selected' : '' }}>{{ $cities[$i]->city }}</option>
                          <?php } ?>
                        </datalist>
                        @if($errors->has('city'))
                          <div class="error">{{ $errors->first('city') }}</div>
                        @endif
                      </div>
                    </div>
                  </div>
                      
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="county">{{ __('adminlte::adminlte.county') }}</label>
                        <input class="form-control" list="counties" name="county" id="county" placeholder="Start to enter County">
                        <datalist id="counties">
                          <?php for($i=0; $i<count($counties); $i++) { ?>
                            <option value="{{ $counties[$i]->county }}" {{ $counties[$i]->county == 'United Kingdom' ? 'selected' : '' }}>{{ $counties[$i]->county }}</option>
                          <?php } ?>
                        </datalist>
                        @if($errors->has('county'))
                          <div class="error">{{ $errors->first('county') }}</div>
                        @endif
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="state">{{ __('adminlte::adminlte.state') }}<span class="text-danger"> *</span></label>
                        <input type="text" name="state" class="form-control" id="state" maxlength="100">
                        @if($errors->has('state'))
                          <div class="error">{{ $errors->first('state') }}</div>
                        @endif
                      </div>
                    </div>
                  </div>
                      
                  <div class="row">
                  
                    <div class="col-sm-6">
                      <div class="form-group">
                          <label for="country">{{ __('adminlte::adminlte.country') }}<span class="text-danger"> *</span></label>
                          <select name="country" class="form-control" id="country" >
                            <option value="" hidden>Select Country</option>
                            <?php for($i=0; $i<count($countries); $i++) { ?>
                              <option value="{{ $countries[$i]['name'] }}" {{ $countries[$i]['name'] == 'United Kingdom' ? 'selected' : '' }}>{{ $countries[$i]['name'] }}</option>
                            <?php } ?>
                          </select>
                          @if($errors->has('country'))
                            <div class="error">{{ $errors->first('country') }}</div>
                          @endif
                        </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="pincode">{{ __('adminlte::adminlte.zip') }}<span class="text-danger"> *</span></label>
                        <input type="text" name="pincode" class="form-control" id="pincode" maxlength="7">
                        @if($errors->has('pincode'))
                          <div class="error">{{ $errors->first('pincode') }}</div>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /ADDRESS FIELDS -->

                <!-- Form Fields -->

              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button id="submitButton" class="btn btn-primary">{{ __('adminlte::adminlte.save') }}</button>
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
    .information_fields { margin-bottom: 30px; }
    .address_fields { margin-top: 30px; }
  </style>
@stop

@section('js')
  <script>
    $(document).ready(function() {
      $( "input[name=contact_number]" ).focus(function() {
          $('input[name=country_code]').val($('.country-list .country.active').data('dial-code'));
       });
      $("#email").blur(function() {
        $.ajax({
          type:"GET",
          url:"{{ route('check_email') }}",
          data: {
            email: $(this).val(),
            table_name: 'organizations'
          },
          success: function(result) {
            if(result) {
              $("#email_error").html("This email is already registered.");
            }
            else {
              $("#email_error").html("");
            }
          }
        });
      });
      $.validator.addMethod("regex", function(value, element, regexp) {
        var re = new RegExp(regexp);
        return this.optional(element) || re.test(value);
      }, "The Contact Number must be in numbers only.");
      var addCustomerForm = $( "#addCustomerForm" );
      addCustomerForm.validate({
        ignore: [],
        debug: false,
        rules: {
          name: {
            required: true
          },
          email: {
            required: true,
          },
          contact_number: {
            required: true,
            regex: /^[\d ()+-]+$/,
            minlength: 7,
            maxlength: 15
          },
          url: {
            required: true,
            url: true
          },
          address: {
            required: true
          },
          city: {
            required: true
          },
          pincode: {
            required: true,
            maxlength: 6
          },
          country: {
            required: true
          },
          state: {
            required: true
          },
          /* county: {
            required: true
          }, */
        },
        messages: {
          name: {
            required: "The Company Name field is required."
          },
          email: {
            required: "The Company Or Consultants Email field is required.",
          },
          contact_number: {
            required: "The Contact Number field is required."
          },
          url: {
            required: "The Company Domain URL field is required.",
            url: "The Company Domain URL must be valid."
          },
          address: {
            required: "The Address field is required."
          },
          city: {
            required: "The City / Town field is required."
          },
          pincode: {
            required: "The Zip / Postcode field is required.",
            maxlength: "The Zip / Postcode must be of maximum 6 characters."
          },
          country: {
            required: "The Country field is required."
          },
          state: {
            required: "The State field is required."
          },
          /* county: {
            required: "The County field is required."
          }, */
        },
        onkeyup: false,
        onblur: true
      });
    });
  </script>
  <!-- <script>
    var autocomplete = new google.maps.places.Autocomplete(
      document.getElementById("autocomplete")
    );
    autocomplete.addListener('place_changed', function(e) {
      var place = autocomplete.getPlace();
      var lat = place.geometry.location.lat();
      var lng = place.geometry.location.lng();

      var postal_code = '';
      var country = '';
      var city = '';
      var county = '';
      var state = '';
      for (var i = 0; i < place.address_components.length; i++) {
        if(place.address_components[i].types.indexOf("postal_code") != -1) {
          postal_code = place.address_components[i].long_name;
        }
        if(place.address_components[i].types.indexOf("country") != -1) {
          country = place.address_components[i].long_name;
        }
        if(place.address_components[i].types.indexOf("locality") != -1) {
          city = place.address_components[i].long_name;
        }
        if(place.address_components[i].types.indexOf("sublocality_level_1") != -1) {
          county = place.address_components[i].long_name;
        }
        if(place.address_components[i].types.indexOf("administrative_area_level_1") != -1) {
          state = place.address_components[i].long_name;
        }
        console.log(place.address_components[i].types);
        console.log(place.address_components[i].long_name);
        console.log('=========');
      }
      document.getElementById('city').value = city;
      document.getElementById('state').value = state;
      document.getElementById('pincode').value = postal_code;
      document.getElementById('county').value = county;
      document.getElementById('country').value = country;
    });
  </script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCKW4P7mmbMBCf48mhUTBKvpHfLDhPgP1c&libraries=places" async defer></script> -->
@stop
