@extends('adminlte::page')

@section('title', 'Website Pages')

@section('content_header')
@stop

@section('content')
<div class="">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header alert d-flex justify-content-between align-items-center">
            <h3>Website Pages</h3>
            {{-- @can('add_website_page')<a class="btn btn-success" href="{{ route('add_website_page') }}">Create Website Page</a>@endcan --}}
          </div>
          <div class="card-body">
            <table style="width:100%" id="pages-list" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th class="display-none"></th>
                  <th>Title</th>
                  <!-- <th>Section</th>
                  <th>Status</th> -->
                  @can('manage_website_pages_actions')<th>Actions</th>@endcan
                </tr>
              </thead>
              <tbody>
                <?php for ($i=0; $i < count($websitePagesList); $i++) { ?>
                  <tr>
                    <td class="display-none"></td>
                    <td>{{ $websitePagesList[$i]->title }}</td>
                    <!-- <td>{{ $websitePagesList[$i]->section }}</td>
                    <td class="{{ $websitePagesList[$i]->status == 'active' ? 'text-success' : 'text-danger' }}">{{ $websitePagesList[$i]->status == 'active' ? "Active" : "Inactive" }}</td> -->
                    @can('manage_website_pages_actions')
                      <td>
                        @can('view_website_page')
                          <a href="{{ route('view_website_page', ['id' => $websitePagesList[$i]->id]) }}" title="View"><i class="text-info fa fa-eye"></i></a>
                        @endcan
                        @can('edit_website_page')
                          <a href="{{ route('edit_website_page', ['id' => $websitePagesList[$i]->id]) }}" title="Edit"><i class="text-warning fa fa-edit"></i></a>
                        @endcan
                        {{-- @can('delete_website_page')
                          <a class="action-button delete-button" title="Delete" href="javascript:void(0)" data-id="{{ $websitePagesList[$i]->id}}"><i class="text-danger fa fa-trash-alt"></i></a>
                        @endcan --}}
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
