@extends('adminlte::page')

@section('title', 'Recruiters')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header alert d-flex justify-content-between align-items-center">
            <h3>{{ __('adminlte::adminlte.recruiters') }}</h3>
            <!-- @can('add_recruiter')<a class="btn btn-sm btn-success" href="{{ route('add_recruiter') }}">{{ __('adminlte::adminlte.add_new_recruiter') }}</a>@endcan -->
          </div>          
          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
            <table style="width:100%" id="recruiters-list" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th class="display-none"></th>
                  <th>{{ __('adminlte::adminlte.email') }}</th>
                  <th>{{ __('adminlte::adminlte.company') }}</th>
                  <th>{{ __('adminlte::adminlte.last_login_at') }}</th>
                  <th>{{ __('adminlte::adminlte.created_at') }}</th>
                  @can('manage_recruiters_actions')<th>{{ __('adminlte::adminlte.actions') }}</th>@endcan
                </tr>
              </thead>
              <tbody>
                <?php for ($i=0; $i < count(is_countable($recruitersList) ? $recruitersList : []); $i++) {
                  $organisation = \App\Models\Organization::where('id', $recruitersList[$i]->organization_id)->get();
                  ?>
                <tr>
                  <th class="display-none"></th>
                  <td>{{ $recruitersList[$i]->email }}</td>
                  <td>{{ count($organisation) > 0 ? $organisation[0]->name : '' }}</td>
                  <td>{{ $recruitersList[$i]->last_logged_in_at ? date('d/m/y', strtotime($recruitersList[$i]->last_logged_in_at)) : '' }}</td>
                  <td>{{ $recruitersList[$i]->created_at ? date('d/m/y', strtotime($recruitersList[$i]->created_at)) : '' }}</td>
                  @can('manage_recruiters_actions')
                    <td>
                      @can('view_recruiter')
                        <a href="view/{{$recruitersList[$i]->id}}" title="View"><i class="text-info fa fa-eye"></i></a>
                      @endcan
                      @can('edit_recruiter')
                        <a title="Edit" href="edit/{{$recruitersList[$i]->id}}"><i class="text-warning fa fa-edit"></i></a>
                      @endcan
                      @can('delete_recruiter')
                        <a class="action-button delete-button" title="Delete" href="javascript:void(0)" data-id="{{ $recruitersList[$i]->id}}"><i class="text-danger fa fa-trash-alt"></i></a>
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
      $('#recruiters-list').DataTable( {
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
        text: "Are you sure you want to move this Recruiter to the Recycle Bin?",
        type: "warning",
        showCancelButton: true,
      }, function(willDelete) {
        if (willDelete) {
          $.ajax({
            url: "{{ route('delete_recruiter') }}",
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
