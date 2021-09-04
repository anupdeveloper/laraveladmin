@extends('adminlte::page')

@section('title', 'Contact Messages')

@section('content_header')
@stop

@section('content')
<div class="">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header alert d-flex justify-content-between align-items-center">
            <h3>Contact Messages</h3>
          </div>
          <div class="card-body">
            <table style="width:100%" id="pages-list" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th class="display-none"></th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Contact Number</th>
                  <th>Subject</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php for ($i=0; $i < count($contactUsMessagesList); $i++) { ?>
                  <tr>
                    <td class="display-none"></td>
                    <td>{{ $contactUsMessagesList[$i]->name }}</td>
                    <td>{{ $contactUsMessagesList[$i]->email }}</td>
                    <td>{{ $contactUsMessagesList[$i]->contact_number }}</td>
                    <td>{{ $contactUsMessagesList[$i]->subject }}</td>
                    <td>
                      <a href="{{ route('view_contact_us_message', ['id' => $contactUsMessagesList[$i]->id]) }}" title="View"><i class="text-info fa fa-eye"></i></a>
                    </td>
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
