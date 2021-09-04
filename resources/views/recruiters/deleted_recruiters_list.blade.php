@extends('adminlte::page')

@section('title', 'Deleted Recruiters')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header alert d-flex justify-content-between align-items-center">
            <h3>{{ __('adminlte::adminlte.deleted_recruiters') }}</h3>
            <a class="btn btn-sm btn-success invisible" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
          </div>           
          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
            <table style="width:100%" id="deleted-recruiters-list" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th class="display-none"></th>
                  <th>{{ __('adminlte::adminlte.email') }}</th>
                  <th>{{ __('adminlte::adminlte.name') }}</th>
                  <th>{{ __('adminlte::adminlte.contact_number') }}</th>
                  <th>{{ __('adminlte::adminlte.company') }}</th>
                  @can('manage_recycle_bin_recruiters')
                    <th>{{ __('adminlte::adminlte.actions') }}</th>
                  @endcan
                </tr>
              </thead>
              <tbody>
                <?php for ($i=0; $i < count(is_countable($deletedRecruiters)?$deletedRecruiters:[]); $i++) {
                  $organisation = \App\Models\Organization::where('id', $deletedRecruiters[$i]->organization_id)->withTrashed()->first();
                  ?>
                <tr>
                  <th class="display-none"></th>
                  <td>{{ $deletedRecruiters[$i]->email }}</td>
                  <td>{{ $deletedRecruiters[$i]->name }}</td>
                  <td>{{ $deletedRecruiters[$i]->phone_number ? $deletedRecruiters[$i]->phone_number : '' }}</td>
                  <td>{{ $organisation->name ? $organisation->name : '' }}</td>
                  @can('manage_recycle_bin_recruiters')
                    <td>
                      <!-- <a href="{{ route( 'view_recruiter', [ 'id' => $deletedRecruiters[$i]->id ] ) }}" title="View"><i class="text-info fa fa-eye"></i></a> -->
                      @can('restore_recruiters')
                        <a class="action-button restore-button" title="Delete" href="javascript:void(0)" data-id="{{ $deletedRecruiters[$i]->id}}"><i class="text-success fa fa-undo"></i></a>
                      @endcan
                      @can('permanent_delete_recruiters')
                        <a class="action-button remove-button" title="Permanent Delete" href="javascript:void(0)" data-id="{{ $deletedRecruiters[$i]->id}}"><i class="text-danger fa fa-trash"></i></a>
                      @endcan
                    </td>
                  @endcan
                </tr>
                <?php } ?>
              </tbody>
              <tfoot>
                <tr>
                  <th class="display-none"></th>
                  <th>{{ __('adminlte::adminlte.name') }}</th>
                  <th>{{ __('adminlte::adminlte.email') }}</th>
                  <th>{{ __('adminlte::adminlte.contact_number') }}</th>
                  <th>{{ __('adminlte::adminlte.company') }}</th>
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
@stop

@section('js')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#deleted-recruiters-list').DataTable( {
        columnDefs: [ {
          targets: 0,
          render: function ( data, type, row ) {
            return data.substr( 0, 2 );
          }
        }]
      });
    });
    
    $('.restore-button').click(function(e) {
      var id = $(this).attr('data-id');
      var obj = $(this);
      console.log("ID - ", id);
      console.log("obj - ", obj);
      swal({
        title: "Are you sure?",
        text: "Are you sure you want to restore the Recruiter?",
        type: "warning",
        showCancelButton: true,
      }, function(willDelete) {
        if (willDelete) {
          $.ajax({
            url: "{{ route('restore_recruiter') }}",
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

    $('.remove-button').click(function(e) {
      var id = $(this).attr('data-id');
      var obj = $(this);
      swal({
        title: "Are you sure?",
        text: "Are you sure you want to Permanently Delete this Record?",
        type: "warning",
        showCancelButton: true,
      }, function(willDelete) {
        if (willDelete) {
          $.ajax({
            url: "{{ route('permanent_delete_recruiter') }}",
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
