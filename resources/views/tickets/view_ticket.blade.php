@extends('adminlte::page')

@section('title', 'Ticket messages')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header alert d-flex justify-content-between align-items-center">
          <h3>{{ __('adminlte::adminlte.ticket_messages') }}</h3>
          <a class="btn btn-sm btn-success" href="{{ route('tickets_list') }}">{{ __('adminlte::adminlte.back') }}</a>
        </div>        
        <div class="card-body">
          @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
          @endif

            <div id="form_wrap_main" class="">
              <div class="">
                <div class="row">           
                  <div class="col-12">
                    <div class="subject_wraper">
                      <div class="request_id">
                        <label>Request#{{ $ticket->id }}</label>
                      </div>
                      <div class="subject">
                        <label>{{ $ticket->subject }}</label>
                      </div>                      
                    </div>
                    <div class="form_wrap message_wraper">
                      <?php  for ($i=0; $i < count($ticketMessages); $i++) {  ?>
                      <div class="message_box {{ $ticketMessages[$i]->sent_by == 'admin' ? 'right' : 'left' }}">
                        <div class="messages_inner_wrap">
                          <div class="profile">
                            <div class="user_img">
                              <?php
                                $publicPath = config('adminlte.website_url');
                                $logoPath = $publicPath.'images/companyLogos/';
                                $defaultProfileImage = config("adminlte.default_avatar");
                              ?>
                              @if($ticketMessages[$i]->sent_by == 'admin')
                                <img src="{{ $defaultProfileImage }}" alt="">
                              @else
                                <img src="{{ $organizationLogo ? $logoPath.$organizationLogo : $defaultProfileImage }}" alt="">
                              @endif
                            </div>
                          </div>
                          <div class="message">
                            <p>{{ $ticketMessages[$i]->message_text }}</p>
                            <div class="">
                              <div class="box_wrap">
                                <?php if($ticketMessages[$i]->attachment_file) {
                                  $destinationPath = config('adminlte.website_url').'ticket_images/';
                                  $extension = explode('.', $ticketMessages[$i]->attachment_file)[1];
                                ?>
                                  @if($extension == 'pdf')
                                    <a target="_blank" href="{{ $destinationPath.$ticketMessages[$i]->attachment_file }}">
                                      <img class="attached-pdf" src="{{ $destinationPath.'pdf_logo.jpeg' }}">
                                      {{ $ticketMessages[$i]->attachment_file }}
                                    </a>
                                  @elseif($extension == 'doc')
                                    <a target="_blank" href="{{ $destinationPath.$ticketMessages[$i]->attachment_file }}">
                                      <img class="attached-doc" src="{{ $destinationPath.'doc_logo.jpeg' }}">
                                      {{ $ticketMessages[$i]->attachment_file }}
                                    </a>
                                  @else
                                    <a target="_blank" href="{{ $destinationPath.$ticketMessages[$i]->attachment_file }}">
                                      <img class="attached-image" src="{{ $destinationPath.$ticketMessages[$i]->attachment_file }}">
                                    </a>
                                  @endif
                                <?php } ?>
                              </div>
                            </div>                          
                          </div>
                        </div>
                        <div class="user_detail">
                          <?php $recruiterName = $recruiter->first_name ? $recruiter->first_name.' '.$recruiter->last_name : $recruiter->email; ?>
                          @if($ticketMessages[$i]->sent_by == 'admin')
                            <label class="name">{{ $superAdmin[0]->name }}</label>
                          @else
                            <a href="{{ route('view_recruiter', ['id' => $recruiter->id ]) }}"><label class="name">{{ $recruiterName }}</label></a>
                          @endif
                          <label class="time_date">{{ $ticketMessages[$i]->created_at ? date('d/m/y', strtotime($ticketMessages[$i]->created_at)) : '' }}</label>
                        </div>                        
                      </div>
                      <?php } ?>
                    </div>
                    @can('reply_ticket')
                      <form action="{{ route('reply_on_ticket') }}" method="post" id="replyForm" enctype="multipart/form-data">
                        <div class="message_reply">
                          <div class="form-group">
                            <label>Message</label>
                            <textarea id="message_text" name="message_text" class="form-control" maxlength="200"></textarea>
                            <div class="counter-wrappar">
                              <span>0</span> /
                              200
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="help_wrap">
                              <label>Attachment</label>
                              <button type="button" class="btn info_btn" data-toggle="tooltip" data-placement="right" title="" data-original-title="{{ config('adminlte.docs_tooltip') }}">
                              <i class="fa fa-question-circle"></i>
                              </button>
                            </div>
                            <div class="file_upload_wrap upload-file" file-name="Upload File">
                              <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                              <input type="file" name="attachment_file" id="attachment_file" accept=".jpg, .jpeg, .gif, .png, .svg, .doc, .docx, .xls, .xlsx, .pdf"/>
                            </div>
                            <div title="Remove File" class="delete-file text-danger" id="delete-file"><i class="fa fa-trash-alt"></i></div>
                            <div class="error" id="image_error"></div>                          
                          </div>
                          <button type="submit">Reply</button>                              
                        </div>
                      </form>
                    @endcan
                  </div>
                </div>
              </div>
            </div>
          
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('css')
<style>
  .delete-file {
    border-radius: 50px;
    padding: 5px 15px;
    font-size: 12px;
    font-weight: 700;
    display: none;
    width: fit-content;
    position: relative;
    left: 20px;
    top: -10px;
  }
  .delete-file:hover {
    cursor: pointer;
  }
  .message_reply .upload-file:after {
    content: attr(file-name);
  }
  img.attached-pdf, img.attached-doc {
    border: 0px none !important;
    width: 30px !important;
    height: 30px !important;
  }
  .counter-wrappar { text-align: center; font-size: 13px; font-weight: 600; float: right; background-color: #e6e6e6; padding: 3px 0px; clear: both; border: 1px solid #cccccc; border-radius: 4px; width: 100px; top: 5px; position: relative; }
</style>
@stop

@section('js')
  <script>
    $('body').on('keyup','textarea[name=message_text]',function() {
      $(this).parent().find('.counter-wrappar > span').text($(this).val().length);
    });
    $('body').on('change','input[name=attachment_file]',function(){
      $(this).parent().attr('file-name', $(this)[0].files[0].name);
    });
    $(document).ready(function() {
      var input = document.getElementById('attachment_file');
      $(input).change(function (e) {
        $("#delete-file").show();
        $("#delete-file").click(function() {
          $('input[name=attachment_file]').val('');
          $('input[name=attachment_file]').parent().attr('file-name','Upload File');
          $("#delete-file").hide();
        });
        /* var files = e.target.files;
        if (files && files.length > 0) {
          file = files[0];
          var fileName = file.name;
          var fileExtension = fileName.substr((fileName.lastIndexOf('.') + 1));
          console.log (fileExtension);
          if(fileExtension != "jpg" &&fileExtension != "JPG" &&
             fileExtension != "jpeg" &&fileExtension != "JPEG" &&
             fileExtension != "gif" &&fileExtension != "GIF" &&
             fileExtension != "png" &&fileExtension != "PNG" &&
             fileExtension != "doc" && fileExtension != "DOC" && 
             fileExtension != "docx" && fileExtension != "DOCX" && 
             fileExtension != "xls" && fileExtension != "XLS" &&  
             fileExtension != "xlsx" && fileExtension != "XLSX" &&
             fileExtension != "pdf" && fileExtension != "PDF" &&
             fileExtension != "svg" && fileExtension != "SVG"
            ) {
            $("#image_error").html("Only .jpg .gif .png .svg .doc .docx .xls .xlsx .ods .pdf files are allowed to upload.");
            return false;
          }
          else {
            if(file.size <= 2000000) {
              $("#image_error").html("");
            }
            else {
              $("#image_error").html("The File must be less than or equal to 2 MB.");
              return false;
            }
          }
        } */
      });
      $.validator.addMethod('filesize', function (value, element, param) {
        return this.optional(element) || (element.files[0].size <= param)
      }, 'File size must be less than 2 MB');
      $.validator.addMethod("extension", function (value, element, param) {
        param = typeof param === "string" ? param.replace(/,/g, '|') : "jpg|jpe?g|gif|png|svg|doc|docx|xls|xlsx|ods|pdf";
        return this.optional(element) || value.match(new RegExp(".(" + param + ")$", "i"));
      }, "Only .jpg .gif .png .svg .doc .docx .xls .xlsx .ods .pdf files are allowed to upload.");
      $('#replyForm').validate({
        ignore: [],
        debug: false,
        rules: {
          message_text: {
            required: true
          },
          attachment_file: {
            accept: false,
            filesize: 2000000,
            extension: "jpg|gif|png|svg|doc|docx|xls|xlsx|ods|pdf"
          }
        },
        messages: {
          message_text: {
            required: "The Message field is required."
          },
          attachment_file: {
            extension: "Only .jpg .gif .png .svg .doc .docx .xls .xlsx .ods .pdf files are allowed to upload."
          }
        }
      });
    });
  </script>
  <script>
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })
  </script>
@stop
