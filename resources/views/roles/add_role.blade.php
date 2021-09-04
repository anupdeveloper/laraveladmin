@extends('adminlte::page')

@section('title', 'Add Role')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header">
          <a class="btn btn-sm btn-success back-button" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
            <h3>{{ __('adminlte::adminlte.add_role') }}</h3>
          </div>
          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
            <form id="addRoleForm" method="post", action="{{ route('save_role') }}">
              @csrf
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="role_name">{{ __('adminlte::adminlte.name') }}</label>
                      <input type="text" name="role_name" class="form-control" id="role_name" maxlength="100">
                      @if($errors->has('role_name'))
                        <div class="error">{{ $errors->first('role_name') }}</div>
                      @endif
                    </div>
                  </div>
                </div>

              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{ __('adminlte::adminlte.save') }}</button>
              </div>
            </form>
          </div>
        </div>
      </div>
  </div>
</div>
@endsection

@section('css')
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <style>
    strong.list-text {
      position: relative;
      left: -8px;
      top: -3px;
    }
    span.list-text {
      position: relative;
      left: -8px;
      top: -3px;
    }
  </style>
@stop

@section('js')
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script>
    $(document).ready(function() {
      $("#full_access").click(function() {
        $("input[type=checkbox]").prop('checked', this.checked)
      })
      $("#customer_permissions").click(function() {
        $(".customerscheckBox").prop('checked', this.checked)
      })
      $("#recruiter_permissions").click(function() {
        $(".recruiterscheckBox").prop('checked', this.checked)
      })
      $("#jobseeker_permissions").click(function() {
        $(".jobseekerscheckBox").prop('checked', this.checked)
      })
      $("#admins_permissions").click(function() {
        $(".adminscheckBox").prop('checked', this.checked)
      })
      $("#jobs_permissions").click(function() {
        $(".jobscheckBox").prop('checked', this.checked)
      })
      $("#job_history_permissions").click(function() {
        $(".jobHistorycheckBox").prop('checked', this.checked)
      })
      $("#credits_permissions").click(function() {
        $(".companyCreditscheckBox").prop('checked', this.checked)
      })
      $("#credits_history_permissions").click(function() {
        $(".companyCreditsHistorycheckBox").prop('checked', this.checked)
      })
      $("#payments_permissions").click(function() {
        $(".paymentTransactionscheckBox").prop('checked', this.checked)
      })
      $("#tickets_permissions").click(function() {
        $(".ticketscheckBox").prop('checked', this.checked)
      })
      $("#job_industries_permissions").click(function() {
        $(".jobIndustriescheckBox").prop('checked', this.checked)
      })
      $("#job_locations_permissions").click(function() {
        $(".jobLocationscheckBox").prop('checked', this.checked)
      })
      $("#skills_permissions").click(function() {
        $(".skillscheckBox").prop('checked', this.checked)
      })
      $("#cities_permissions").click(function() {
        $(".citiescheckBox").prop('checked', this.checked)
      })
      $("#counties_permissions").click(function() {
        $(".countiescheckBox").prop('checked', this.checked)
      })
      $("#restore_permissions").click(function() {
        $(".restorecheckBox").prop('checked', this.checked)
      })
      
      $('#addRoleForm').validate({
        ignore: [],
        debug: false,
        rules: {
          role_name: {
            required: true
          },
          permissions:{
            required: true
          }
        },
        messages: {
          role_name: {
            required: "The Role Name field is required."
          },
          permissions: {
            required: "The Permission field is required.",
          }
        }
      });
    });
  </script>
@stop
