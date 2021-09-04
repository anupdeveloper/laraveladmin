@extends('adminlte::page')

@section('title', 'Edit Customer')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header alert d-flex justify-content-between align-items-center">
            <h3>Edit Customer</h3>
            <a class="btn col-sm-1 btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
          </div>
          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
            <form id="addCustomerForm" method="post", action="{{ route('update_customer') }}">
              @csrf
              <div class="card-body form">
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
                <input type="hidden" name="id" id="customer_id" value="{{ $customer->id }}">
                <!-- INFORMATION FIELDS -->
                <div class="information_fields">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="name">Company Name<span class="text-danger"> *</span></label>
                        <input type="text" name="name" class="form-control" id="name" value="{{ $customer->name }}" maxlength="100">
                        @if($errors->has('name'))
                          <div class="error">{{ $errors->first('name') }}</div>
                        @endif
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="email">Company Or Consultants Email<span class="text-danger"> *</span></label>
                        <input type="text" name="email" class="form-control" id="email" value="{{ $customer->email }}" maxlength="100">
                        <div id ="email_error" class="error"></div>
                        @if($errors->has('email'))
                          <div class="error">{{ $errors->first('email') }}</div>
                        @endif
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="contact_number">Contact Number<span class="text-danger"> *</span></label>
                        <input type="text" name="contact_number" class="form-control" id="contact_number" value="{{ $customer->contact_number }}" maxlength="13">
                        @if($errors->has('contact_number'))
                          <div class="error">{{ $errors->first('contact_number') }}</div>
                        @endif
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="vat_number">VAT Number (Optional)</label>
                        <input type="text" name="vat_number" class="form-control" id="vat_number" value="{{ $customer->vat_number }}" maxlength="100">
                        @if($errors->has('vat_number'))
                          <div class="error">{{ $errors->first('vat_number') }}</div>
                        @endif
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label for="url">Company Domain URL<span class="text-danger"> *</span></label>
                        <input type="text" name="url" class="form-control" id="url" value="{{ $customer->url }}" maxlength="100">
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
                        <label for="address">Address<span class="text-danger"> *</span></label>
                        <input type="text" name="address" class="form-control" id="autocomplete" value="{{ $customer->address }}" maxlength="100">
                        @if($errors->has('address'))
                          <div class="error">{{ $errors->first('address') }}</div>
                        @endif
                      </div>
                    </div>
                  
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="city">City<span class="text-danger"> *</span></label>
                        <input class="form-control" list="cities" name="city" id="city" value="{{ $customer->city }}" placeholder="Start to enter City/ Town">
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
                        <label for="state">State</label>
                        <input type="text" name="state" class="form-control" id="state" value="{{ $customer->state }}" maxlength="100">
                        @if($errors->has('state'))
                          <div class="error">{{ $errors->first('state') }}</div>
                        @endif
                      </div>
                    </div>
                  
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="pincode">Zipcode<span class="text-danger"> *</span></label>
                        <input type="text" name="pincode" class="form-control" id="pincode" value="{{ $customer->pincode }}" maxlength="7">
                        @if($errors->has('pincode'))
                          <div class="error">{{ $errors->first('pincode') }}</div>
                        @endif
                      </div>
                    </div>
                  </div>
                      
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="county">County</label>
                        <input class="form-control" list="counties" name="county" id="county" placeholder="Start to enter County" value="{{ $customer->county }}">
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
                          <label for="country">Country<span class="text-danger"> *</span></label>
                          <select name="country" class="form-control" id="country" >
                            <option value="" hidden>Select Country</option>
                            @for($i=0; $i < count($countries); $i++)
                              <option value="{{ $countries[$i]->name }}" {{ ( $countries[$i]->name == $customer->country) ? 'selected' : '' }}>{{ $countries[$i]->name }}</option>
                            @endfor
                          </select>
                          @if($errors->has('country'))
                            <div class="error">{{ $errors->first('country') }}</div>
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
                <button id="submitButton" class="btn btn-primary">Update</button>
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
      $("#email").blur(function() {
        $.ajax({
          type:"GET",
          url:"{{ route('check_email') }}",
          data: {
            email: $(this).val(),
            id: $("#customer_id").val(),
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
            required: true
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
          /* state: {
            required: true
          },
          county: {
            required: true
          }, */
        },
        messages: {
          name: {
            required: "The Company Name field is required."
          },
          email: {
            required: "The Company Name field is required.",
          },
          contact_number: {
            required: "The Contact Number field is required."
          },
          url: {
            required: "The Domain URL field is required.",
            url: "The Company Domain URL must be valid."
          },
          address: {
            required: "The Address field is required."
          },
          city: {
            required: "The City field is required."
          },
          pincode: {
            required: "The Zipcode field is required.",
            maxlength: "The Zipcode must be of maximum 6 characters."
          },
          country: {
            required: "The Country field is required."
          },
          /* state: {
            required: "The State field is required."
          },
          county: {
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
