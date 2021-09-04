@extends('adminlte::page')

@section('title', 'Counties')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header alert d-flex justify-content-between align-items-center">
            <h3>Counties</h3>
            @can('add_county')<a class="btn btn-sm btn-success" href="{{ route('add_county') }}">{{ __('adminlte::adminlte.add_new_county') }}</a>@endcan
          </div>            
          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
            <table style="width:100%" id="countiesList" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th class="display-none"></th>
                  <th>{{ __('adminlte::adminlte.name') }}</th>
                  <th>{{ __('adminlte::adminlte.country') }}</th>
                  @can('manage_counties_actions')<th>{{ __('adminlte::adminlte.actions') }}</th>@endcan
                </tr>
              </thead>
              <tbody>
                @for($i=0; $i < count($countiesList); $i++)
                  <tr>
                    <th class="display-none"></th>
                    <td>{{ $countiesList[$i]->county }}</td>
                    <td>{{ $countiesList[$i]->country }}</td>
                    @can('manage_counties_actions')
                      <td>
                        @can('view_county')
                          <a class="action-button" title="View" href="view/{{$countiesList[$i]->id}}"><i class="text-info fa fa-eye"></i></a>
                        @endcan
                        @can('edit_county')
                          <a class="action-button" title="Edit" href="edit/{{$countiesList[$i]->id}}"><i class="text-warning fa fa-edit"></i></a>
                        @endcan
                        @can('delete_county')
                          <a class="action-button delete-button" title="Delete" href="javascript:void(0)" data-id="{{ $countiesList[$i]->id}}"><i class="text-danger fa fa-trash-alt"></i></a>
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
@stop

@section('js')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#countiesList').DataTable( {
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
      swal({
        title: "Are you sure?",
        text: "Are you sure you want to move this County to the Recycle Bin?",
        type: "warning",
        showCancelButton: true,
      }, function(willDelete) {
        if (willDelete) {
          $.ajax({
            url: "{{ route('delete_county') }}",
            type: 'post',
            data: {
              id: id
            },
            dataType: "JSON",
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
              if(response.success == 1) {
                window.location.reload();
              }
              else {
                console.log(response);
                setTimeout(() => {
                  swal("Warning!", response.message, "warning");
                }, 500);
              }
            }
          });
        } 
      });
    });
  </script>
@stop
