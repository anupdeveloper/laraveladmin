@extends('adminlte::page')

@section('title', 'Add Company Credit')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header alert d-flex justify-content-between align-items-center">
            <h3>{{ __('adminlte::adminlte.add_company_credit') }}</h3>
            <a class="btn btn-sm btn-success" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
          </div>
          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
            <form id="addCompanyCreditForm" method="post" action="{{ route('save_company_credit') }}">
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

                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="total_paid_credits">{{ __('adminlte::adminlte.credit_amount') }}<span class="text-danger"> *</span></label>
                        <input type="text" name="total_paid_credits" class="form-control" id="total_paid_credits" maxlength="100">
                        <div id ="function_error" class="error"></div>
                        @if($errors->has('total_paid_credits'))
                          <div class="error">{{ $errors->first('total_paid_credits') }}</div>
                        @endif
                      </div>
                    </div>
                    
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="organization_id">{{ __('adminlte::adminlte.company') }}<span class="text-danger"> *</span></label>
                        <select name="organization_id" class="form-control" id="organization_id">
                          <option value="" hidden>{{ __('adminlte::adminlte.select_company') }}</option>
                          @for ($i=0; $i < count($organizations); $i++) {  ?>
                            <option value="{{ $organizations[$i]->id }}">{{ $organizations[$i]->name }}</option>
                          @endfor
                        </select>
                        <div id ="function_error" class="error"></div>
                        @if($errors->has('organization_id'))
                          <div class="error">{{ $errors->first('organization_id') }}</div>
                        @endif
                      </div>
                    </div>
                  </div>
                
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="credit_type">{{ __('adminlte::adminlte.credit_type') }}<span class="text-danger"> *</span></label>
                        <input type="hidden" name="txn_type" value="credit">
                        <select name="credit_type" class="form-control" id="credit_type">
                          <option value="" hidden>{{ __('adminlte::adminlte.select_credit_type') }}</option>
                          <option value="free">Free</option>
                          <option value="paid">Paid</option>
                        </select>
                        <div id ="function_error" class="error"></div>
                        @if($errors->has('credit_type'))
                          <div class="error">{{ $errors->first('credit_type') }}</div>
                        @endif
                      </div>
                    </div>
                  </div>

              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="text" class="btn btn-primary" >{{ __('adminlte::adminlte.save') }}</button>
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
  <script>
    $(document).ready(function() {
      $('#addCompanyCreditForm').validate({
        ignore: [],
        debug: false,
        rules: {
          total_paid_credits: {
            required: true,
            number: true
          },
          credit_type: {
            required: true
          },
          organization_id: {
            required: true
          },
        },
        messages: {
          total_paid_credits: {
            required: "The Credit Amount field is required.",
            number: "The Credit Amount must be in numbers only."
          },
          credit_type: {
            required: "The Credit Type field is required."
          },
          organization_id: {
            required: "The Company field is required."
          },
        }
      });
    });
  </script>
@stop
