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
            <h3>{{ __('adminlte::adminlte.edit_customer') }}</h3>
            <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
          </div>
          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif

            <form class="form customers-management" id="updateProfileForm">
              @csrf
              <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 col-12">
                  <div class="form-group">
                    <div class="profile-image">
                      <div id="preview-cropped-image" class="">
                        <div class="help_wrap">
                          <label>Company Logo</label>
                          <button type="button" class="btn info_btn" data-toggle="tooltip" data-placement="right" title="" data-original-title="{{ config('adminlte.image_tooltip') }}">
                          <i class="fa fa-question-circle"></i>
                          </button>
                        </div>
                        <label class="label">
                          <?php 
                            $url = config('adminlte.website_url', '').'images/companyLogos/';
                            $filePath = $customer->logo ? $url.$customer->logo : config("adminlte.default_avatar");
                          ?>
                          <img id="profileImage" class="profile-image" src="{{ $filePath }}" alt="Profilbild">
                          <input type="file" class="sr-only" id="input_logo_image" name="logo_image" accept=".jpg, .svg, .png">
                          <div class="error" id="image_error"></div>
                        </label>
                      </div>
                      <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                      </div>
                      <div class="alert" role="alert"></div>
                        <div class="modal fade" id="logo-cropper-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="modalLabel"><img src="{{asset('assets/images/croper_image.svg')}}" alt="">Crop the image</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <div class="img-container">
                                  <img id="logo_image" src="https://avatars0.githubusercontent.com/u/3456749">
                                </div>
                                <div class="row" id="actions" class="action_buttons">
                                  <div class=" col-12 docs-buttons">
                                    <div class="btn-group">
                                      <a class="btn btn-primary btn-sm" title="Upload New Image" onclick="document.getElementById('input').click();"><i class="fa fa-upload"></i></a>
                                      <button type="button" id="reset" class="btn btn-primary btn-sm action_button" title="Reset">
                                        <i class="fa fa-sync"></i>
                                      </button>
                                      <button type="button" id="zoomOut" class="btn btn-primary btn-sm action_button" title="Zoom Out">
                                        <i class="fa fa-search-minus"></i>
                                      </button>
                                      <button type="button" id="zoomIn" class="btn btn-primary btn-sm action_button" title="Zoom In">
                                        <i class="fa fa-search-plus"></i>
                                      </button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-primary" id="crop">Upload</button>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                  </div>
                </div>
                
              </div>
            </form>
            
            <form id="editCustomerForm" method="post", action="{{ route('update_customer') }}">
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
                <input type="hidden" name="from_page" id="from_page" value="{{ $from_page }}">
                <!-- INFORMATION FIELDS -->
                <div class="">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="name">{{ __('adminlte::adminlte.company_name') }}<span class="text-danger"> *</span></label>
                        <input type="text" name="name" class="form-control" id="name" value="{{ $customer->name }}" maxlength="100" readonly>
                        @if($errors->has('name'))
                          <div class="error">{{ $errors->first('name') }}</div>
                        @endif
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="email">{{ __('adminlte::adminlte.company_or_consultants_email') }}<span class="text-danger"> *</span></label>
                        <input type="text" name="email" class="form-control" id="email" value="{{ $customer->email }}" readonly maxlength="100">
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
                        <label for="contact_number">{{ __('adminlte::adminlte.contact_number') }}<span class="text-danger"> *</span></label>
                        <input id="jquery-intl-phone" type="tel" class="form-control" name="contact_number" maxlength="13" value="{{ $customer->contact_number }}">
                        @if($errors->has('contact_number'))
                          <div class="error">{{ $errors->first('contact_number') }}</div>
                        @endif
                        <input type="hidden" name="country_code" value="{{ $customer->country_code ? $customer->country_code : '+44' }}">
                      </div>
                    </div>

                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="vat_number">{{ __('adminlte::adminlte.vat_number') }}</label>
                          <input type="text" name="vat_number" class="form-control" id="vat_number" value="{{ $customer->vat_number }}" maxlength="100">
                          @if($errors->has('vat_number'))
                            <div class="error">{{ $errors->first('vat_number') }}</div>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="url">{{ __('adminlte::adminlte.company_domain_url') }}<span class="text-danger"> *</span></label>
                        <input type="text" name="url" class="form-control" id="url" value="{{ $customer->url }}" maxlength="100" readonly>
                        @if($errors->has('url'))
                          <div class="error">{{ $errors->first('url') }}</div>
                        @endif
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="address">{{ __('adminlte::adminlte.address') }}<span class="text-danger"> *</span></label>
                        <input type="text" name="address" class="form-control" id="autocomplete" value="{{ $customer->address }}" maxlength="100">
                        @if($errors->has('address'))
                          <div class="error">{{ $errors->first('address') }}</div>
                        @endif
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="city">{{ __('adminlte::adminlte.city') }}<span class="text-danger"> *</span></label>
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
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="county">{{ __('adminlte::adminlte.county') }}</label>
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
                  </div>
                      
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="state">{{ __('adminlte::adminlte.state') }}<span class="text-danger"> *</span></label>
                        <input type="text" name="state" class="form-control" id="state" value="{{ $customer->state }}" maxlength="100">
                        @if($errors->has('state'))
                          <div class="error">{{ $errors->first('state') }}</div>
                        @endif
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                          <label for="country">{{ __('adminlte::adminlte.country') }}<span class="text-danger"> *</span></label>
                          <select name="country" class="form-control" id="country" >
                            <option value="" hidden>{{ __('adminlte::adminlte.select_country') }}</option>
                            @for($i=0; $i < count($countries); $i++)
                              <option value="{{ $countries[$i]['name'] }}" {{ ( $countries[$i]['name'] == $customer->country) ? 'selected' : '' }}>{{ $countries[$i]['name'] }}</option>
                            @endfor
                          </select>
                          @if($errors->has('country'))
                            <div class="error">{{ $errors->first('country') }}</div>
                          @endif
                        </div>
                    </div>
                  </div>
                      
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="pincode">{{ __('adminlte::adminlte.zip') }}<span class="text-danger"> *</span></label>
                        <input type="text" name="pincode" class="form-control" id="pincode" value="{{ $customer->pincode }}" maxlength="7">
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
                <button id="submitButton" class="btn btn-primary">{{ __('adminlte::adminlte.update') }}</button>
              </div>
            </form>
          </div>
        </div>
      </div>
  </div>
</div>
@endsection

@section('css')
  <link rel="stylesheet" type="text/css" href="https://fengyuanchen.github.io/cropperjs/css/cropper.css">
  <style>
    .information_fields { margin-bottom: 30px; }
    .address_fields { margin-top: 30px; }
    li.country { display: none; }
    li.divider { display: none; }
    li.country.preferred { display: block; }

    .label { cursor: pointer; }
    .modal-dialog { margin-top: 10rem; }
    .progress { display: none; margin-bottom: 1rem; }
    .img-container img { max-width: 100%; }
    .modal-backdrop { position: relative; }
    #profileImage { height: 150px; width: 200px; border-radius: 10px; object-fit: contain; background-color: #fbfbfb; border: 1px solid #343d49; padding: 10px; }
    /* #updateProfileForm { display:none } */
  </style>
@stop

@section('js')
  <script type="text/javascript" src="https://fengyuanchen.github.io/cropperjs/js/cropper.js"></script>
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
      var editCustomerForm = $( "#editCustomerForm" );
      $.validator.addMethod("regex", function(value, element, regexp) {
        var re = new RegExp(regexp);
        return this.optional(element) || re.test(value);
      }, "The Contact Number must be in numbers only.");
      editCustomerForm.validate({
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
            maxlength: 7
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
            required: "The Zip / Postcode field is required."
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

<script>
  window.addEventListener('DOMContentLoaded', function () {
    var avatar = document.getElementById('profileImage');
    var image = document.getElementById('logo_image');
    var input = document.getElementById('input_logo_image');
    console.log(avatar)
    var $progress = $('.progress');
    var $progressBar = $('.progress-bar');
    var $alert = $('.alert');
    var $modal = $('#logo-cropper-modal');
    var cropper;
    var uploadedImageURL;
    var options = {
      movable: true,
      zoomable: true,
      rotatable: true,
      scalable: false
    }

    $('[data-toggle="tooltip"]').tooltip();
    input.addEventListener('change', function (e) {
      var files = e.target.files;
      var done = function (url) {
        input.value = '';
        image.src = url;
        $alert.hide();
        $modal.modal('show');
      };
      var reader;
      var file;
      var url;

      if (files && files.length > 0) {
        file = files[0];
        var fileName = file.name;
        var fileExtension = fileName.substr((fileName.lastIndexOf('.') + 1));
        console.log (fileExtension);
        if(fileExtension != "jpg" && fileExtension != "jpeg" && fileExtension != "png" && fileExtension != "JPG" && fileExtension != "JPEG" && fileExtension != "PNG" && fileExtension != "svg" && fileExtension != "SVG") {
          $("#image_error").html("Only .jpg .svg .png files are allowed to upload.");
          return false;
        }
        else {
          if(file.size <= 2000000) {
            $("#image_error").html("");
            if (URL) {
              done(URL.createObjectURL(file));
              if(cropper) {
                cropper.destroy();
                cropper = new Cropper(image, options);
              }
            } else if (FileReader) {
              reader = new FileReader();
              reader.onload = function (e) {
                done(reader.result);
              };
              reader.readAsDataURL(file);
            }
          }
          else {
            $("#image_error").html("The File must be less than or equal to 2 MB.");
            return false;
          }
        }     
      }
    });

    $modal.on('shown.bs.modal', function () {
      cropper = new Cropper(image, options);
      $("#zoomIn").click(function() {
        cropper.zoom(0.1);
      });
      $("#zoomOut").click(function() {
        cropper.zoom(-0.1);
      });
      $("#reset").click(function() {
        cropper.reset();
      });

    }).on('hidden.bs.modal', function () {
      cropper.destroy();
      cropper = null;
    });

    document.getElementById('crop').addEventListener('click', function () {
      var initialAvatarURL;
      var canvas;

      $modal.modal('hide');

      if (cropper) {
        canvas = cropper.getCroppedCanvas();
        initialAvatarURL = avatar.src;
        avatar.src = canvas.toDataURL();
        console.log(avatar.src);
        $progress.show();
        $alert.removeClass('alert-success alert-warning');
        canvas.toBlob(function (blob) {
          var formData = new FormData();
          formData.append('avatar', blob, 'avatar.jpg');
          $.ajax({
            url: "{{ route('upload_logo_image') }}",
            type: "POST",
            dataType: "JSON",
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
              logo_image: avatar.src,
              companyId: $("#customer_id").val()
            },
            success: function (response) {
              if (response.success) {
                window.location.reload();
              }
              else {
                swal("Error!", "Something went wrong! Please try again.", "warning");
              }
            }
          });
        });
      }
    });
  });
</script>
@stop
