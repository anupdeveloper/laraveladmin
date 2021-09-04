@extends('adminlte::page')

@section('title', 'Deleted Website Pages')

@section('content_header')
@stop

@section('content')
<div class="">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3>Deleted Website Pages</h3>
          </div>
          <div class="card-body">
            <table id="pages-list" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Title</th>
                  <th>Section</th>
                  @can('manage_website_pages_actions')<th>Actions</th>@endcan
                </tr>
              </thead>
              <tbody>
                <?php for ($i=0; $i < count($deletedWebsitePages); $i++) { ?>
                  <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $deletedWebsitePages[$i]->title }}</td>
                    <td>{{ $deletedWebsitePages[$i]->section }}</td>
                    @can('manage_website_pages_actions')
                      <td>
                        <a class="action-button delete-button" title="Restore" href="javascript:void(0)" data-id="{{ $deletedWebsitePages[$i]->id}}"><i class="text-danger fa fa-trash-alt"></i></a>
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
    $('#pages-list').DataTable( {
      columnDefs: [ {
        targets: 0,
        render: function ( data, type, row ) {
          return data.substr( 0, 2 );
        }
      }]
    });
  </script>
@stop
