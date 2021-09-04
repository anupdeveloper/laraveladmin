@extends('adminlte::page')

@section('title', 'Credits History')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header alert d-flex justify-content-between align-items-center">
            <h3>{{ __('adminlte::adminlte.credits_history') }}</h3>
            <a class="btn btn-sm btn-success invisible" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
          </div>           
          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
            <table style="width:100%" id="creditsHistory" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th class="display-none"></th>
                  <th>{{ __('adminlte::adminlte.transaction_type') }}</th>
                  <th>{{ __('adminlte::adminlte.credits') }}</th>
                  <th>{{ __('adminlte::adminlte.credit_type') }}</th>
                  <th>{{ __('adminlte::adminlte.company_name') }}</th>
                  <th>{{ __('adminlte::adminlte.added_by') }}</th>
                  <th>{{ __('adminlte::adminlte.actions') }}</th>
                </tr>
              </thead>
              <tbody>
                @for ($i=0; $i < count($creditsHistory); $i++)
                <tr>
                  <th class="display-none"></th>
                  <td class="{{ $creditsHistory[$i]->txn_type == 'debit' ? 'text-danger' : 'text-success'}}">{{ ucfirst($creditsHistory[$i]->txn_type) }}</td>
                  <td>{{ $creditsHistory[$i]->credits }}</td>
                  <td>{{ ucfirst($creditsHistory[$i]->credit_type) }}</td>
                  <td>
                    <?php
                      $company = \App\Models\Organization::find($creditsHistory[$i]->organization_id);
                      $creditDetails = \App\Models\OrganizationCreditDetail::find($creditsHistory[$i]->id);
                      $recruiter = null;
                      $admin = null;
                      if($creditDetails->recruiter_id != null) {
                        $recruiter = \App\Models\Recruiter::find($creditDetails->recruiter_id);
                      }
                      else if($creditDetails->admin_id != null) {
                        $admin = \App\Models\Admin::find(\Auth::id());
                      }
                    ?>
                    {{ $company->name }}
                  </td>
                  <td>
                    @if($recruiter != null)
                      <a href="{{ route('view_recruiter', [ 'id' => $recruiter->id ]) }}">{{ $recruiter->first_name ? $recruiter->first_name.' '.$recruiter->last_name : $recruiter->email }}</a>
                    @elseif($admin != null)
                      {{ $admin->name }}
                    @endif
                  </td>
                  <td>
                    <a class="action-button" title="View" href="{{ route( 'view_credit_history', [ 'id' => $creditsHistory[$i]->id ] ) }}"><i class="text-info fa fa-eye"></i></a>
                  </td>
                </tr>
                @endfor
              </tbody>
              <tfoot>
                <tr>
                  <th class="display-none"></th>
                  <th>{{ __('adminlte::adminlte.transaction_type') }}</th>
                  <th>{{ __('adminlte::adminlte.credits') }}</th>
                  <th>{{ __('adminlte::adminlte.credit_type') }}</th>
                  <th>{{ __('adminlte::adminlte.company_name') }}</th>
                  <th>{{ __('adminlte::adminlte.added_by') }}</th>
                  <th>{{ __('adminlte::adminlte.actions') }}</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
  </div>
</div>
@endsection

@section('css')
@stop

@section('js')
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#creditsHistory').DataTable( {
        columnDefs: [ {
          targets: 0,
          render: function ( data, type, row ) {
            return data.substr( 0, 2 );
          }
        }]
      });
    });
  </script>
@stop
