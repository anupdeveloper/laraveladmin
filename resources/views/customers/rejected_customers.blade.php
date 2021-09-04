@extends('adminlte::page')

@section('title', 'Rejected Customers')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header alert d-flex justify-content-between align-items-center">
            <h3>{{ __('adminlte::adminlte.rejected_customers') }}</h3>
            <a class="btn btn-sm btn-success invisible" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
          </div>           
          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
            <!-- <a class="btn btn-sm btn-success float-right" href="{{ route('add_customer') }}">Add New Customer</a> -->
            <table style="width:100%" id="rejected-customers-list" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th class="display-none"></th>
                  <!-- <th>Logo</th> -->
                  <th>{{ __('adminlte::adminlte.name') }}</th>
                  <th>{{ __('adminlte::adminlte.email') }}</th>
                  <th>{{ __('adminlte::adminlte.contact_number') }}</th>
                  @can('manage_rejected_customers')<th>{{ __('adminlte::adminlte.actions') }}</th>@endcan
                </tr>
              </thead>
              <tbody>
                <?php for ($i=0; $i < count($rejectedCustomersList); $i++) {
                  $websiteImagesPath = config('adminlte.website_url').'companyLogos/';
                  $defaultImage = config('adminlte.default_avatar');
                  $logo = $rejectedCustomersList[$i]->logo != null ? $websiteImagesPath.$rejectedCustomersList[$i]->logo : $defaultImage;
                  ?>
                <tr>
                  <th class="display-none"></th>
                  <!-- <td><img src="{{ $logo }}" alt="{{ $rejectedCustomersList[$i]->name }}"></td> -->
                  <td>{{ $rejectedCustomersList[$i]->name }}</td>
                  <td>{{ $rejectedCustomersList[$i]->email }}</td>
                  <td>{{ $rejectedCustomersList[$i]->contact_number ? $rejectedCustomersList[$i]->contact_number : '' }}</td>
                  @can('manage_rejected_customers')
                    <td>
                      @can('view_rejected_customer')
                        <a href="rejected/view/{{$rejectedCustomersList[$i]->id}}"><i class="text-info fa fa-eye"></i></a>
                      @endcan
                      @can('whitelist_rejected_customer')
                        <a href="whitelist/{{$rejectedCustomersList[$i]->id}}" title="Whitelist"><i class="text-success fa fa-check-circle"></i></a>
                      @endcan
                      @can('edit_rejected_customer')
                        <a href="rejected/edit/{{$rejectedCustomersList[$i]->id}}" title="Edit"><i class="text-warning fa fa-edit"></i></a>
                      @endcan
                      @can('delete_rejected_customer')
                        <a class="action-button delete-button" title="Delete" href="javascript:void(0)" data-id="{{ $rejectedCustomersList[$i]->id}}"><i class="text-danger fa fa-trash-alt"></i></a>
                      @endcan
                    </td>
                  @endcan
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
  </div>
</div>
@endsection

@section('css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
@stop

@section('js')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#rejected-customers-list').DataTable( {
        columnDefs: [ {
          targets: 0,
          render: function ( data, type, row ) {
            return data.substr( 0, 2 );
          }
        }]
      });
    });
    
    $('.delete-button').click(function(e) {
      var id = $(this).attr('data-id');
      var obj = $(this);
      console.log("ID - ", id);
      console.log("obj - ", obj);
      swal({
        title: "Are you sure?",
        text: "Are you sure you want to move this Customer to the Recycle Bin?",
        type: "warning",
        showCancelButton: true,
      }, function(willDelete) {
        if (willDelete) {
          $.ajax({
            url: "{{ route('delete_customer') }}",
            type: 'post',
            data: {
              id: id
            },
            dataType: "JSON",
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
              window.location.reload();
              /* console.log("response", response);
              obj.parent().parent().remove(); */
            }
          });
        }
      });
    });
  </script>
@stop
