@extends('adminlte::page')

@section('title', 'Company Credits')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header alert d-flex justify-content-between align-items-center">
            <h3>{{ __('adminlte::adminlte.company_credits') }}</h3>
            @can('add_company_credit')<a class="btn btn-sm btn-success" href="{{ route('add_company_credit') }}">{{ __('adminlte::adminlte.add_company_credit') }}</a>@endcan
          </div>           
          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
            <table style="width:100%" id="companyCreditsList" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th class="display-none"></th>
                  <th>{{ __('adminlte::adminlte.company_name') }}</th>
                  <th>{{ __('adminlte::adminlte.credits_available') }}</th>
                  @can('view_company_credit')<th>{{ __('adminlte::adminlte.actions') }}</th>@endcan
                </tr>
              </thead>
              <tbody>
                @for ($i=0; $i < count($companyCreditsList); $i++)
                <tr>
                  <th class="display-none"></th>
                  <td>
                    <?php
                      $company = \App\Models\Organization::find($companyCreditsList[$i]->organization_id);
                    ?>
                    {{ $company->name }}
                  </td>
                  <td>{{ $companyCreditsList[$i]->total_paid_credits+$companyCreditsList[$i]->trial_credits }}</td>
                  @can('view_company_credit')
                    <td>
                    @can('view_company_credit')
                      <a class="action-button" title="View" href="{{ route( 'view_company_credit', [ 'id' => $companyCreditsList[$i]->id ] ) }}"><i class="text-info fa fa-eye"></i></a>
                    @endcan
                    </td>
                  @endcan
                </tr>
                @endfor
              </tbody>
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
      $('#companyCreditsList').DataTable( {
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
