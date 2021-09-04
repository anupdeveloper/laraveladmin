@extends('adminlte::page')

@section('title', 'Published Jobs')

@section('content_header')
@stop

@section('content')
<div style="display: none;" class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header alert d-flex justify-content-between align-items-center">
            <h3>{{ __('adminlte::adminlte.published_jobs') }}</h3>
            <a class="btn btn-sm btn-success invisible" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
          </div>           
          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
            <!-- <a class="btn btn-sm btn-success float-right" href="{{ route('add_job') }}">{{ __('adminlte::adminlte.add_new_job') }}</a> -->
            <table style="width:100%" id="jobsList" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th class="display-none"></th>
                  <th>{{ __('adminlte::adminlte.reference_number') }}</th>
                  <th>{{ __('adminlte::adminlte.job_title') }}</th>
                  <th>{{ __('adminlte::adminlte.status') }}</th>
                  <th>{{ __('adminlte::adminlte.company') }}</th>
                  <th>{{ __('adminlte::adminlte.created_by') }}</th>
                  <th>{{ __('adminlte::adminlte.expiry_date') }}</th>
                  <th>{{ __('adminlte::adminlte.no_of_redirections') }}</th>
                  @can('manage_jobs_actions')<th>{{ __('adminlte::adminlte.actions') }}</th>@endcan
                </tr>
              </thead>
              <tbody>
                <?php for ($i=0; $i < count($jobsList); $i++) { 
                  $organisation = \App\Models\Organization::find($jobsList[$i]->organization_id);
                  $recruiter = \App\Models\Recruiter::find($jobsList[$i]->recruiter_id);
                ?>
                <tr class="{{ $jobsList[$i]->is_featured ? 'free-advert' : '' }}">
                  <th class="display-none"></th>
                  <td>{{ $jobsList[$i]->job_ref_number }}</td>
                  <td>{{ $jobsList[$i]->job_title }}</td>
                  <td class="{{ $jobsList[$i]->status == 'open' ? 'text-success' : 'text-danger' }}">
                    {{ $jobsList[$i]->status == 'open' ? 'Open' : 'Closed' }}
                    @if($jobsList[$i]->is_featured)
                      <br/><small class="text-dark">(FREE)</small>
                    @endif
                  </td>
                  <td>{{ $organisation ? $organisation->name : '' }}</td>
                  <td>
                    @if($recruiter)
                      <a href="{{ route('view_recruiter', [ 'id' => $recruiter->id ]) }}">
                        {{ $recruiter->first_name ? $recruiter->first_name.' '.$recruiter->last_name : $recruiter->email }}
                      <a>
                    @endif
                  </td>
                  <td>{{ $jobsList[$i]->expiring_at ? date('d/m/y', strtotime($jobsList[$i]->expiring_at)) : '' }}</td>
                  <td>{{ \App\Models\JobApplication::where('job_id', $jobsList[$i]->id)->get()->count() }}</td>
                  @can('manage_jobs_actions')
                    <td>
                      @can('view_job')
                        <a class="action-button" title="View" href="view/{{$jobsList[$i]->id}}"><i class="text-info fa fa-eye"></i></a>
                      @endcan
                      @can('edit_job')
                        <a class="action-button" title="Edit" href="edit/{{$jobsList[$i]->id}}"><i class="text-warning fa fa-edit"></i></a>
                      @endcan
                      @can('suspend_job')
                        <a class="action-button" title="Suspend" href="{{ route('suspend_job', ['id' => $jobsList[$i]->id]) }}"><i class="text-primary fa fa-exclamation-circle"></i></a>
                      @endcan
                      @can('delete_job')
                        <a class="action-button delete-button" title="Delete" href="javascript:void(0)" data-id="{{ $jobsList[$i]->id}}"><i class="text-danger fa fa-trash-alt"></i></a>
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

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header alert d-flex justify-content-between align-items-center">
                    <h3>{{ __('adminlte::adminlte.published_jobs') }}</h3>
                    <a class="btn btn-sm btn-success invisible" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
                    <a href="" class="show-advance-options">Advance Options <i class="fa fa-caret-down"></i></a>
                </div>           
                <div class="card-body">
                    <div class="text-right mb-3">
                        {{-- <div class="advance-options" style="display: none;">
                            <div class="title">
                                <h5><i class="fa fa-filter mr-1"></i>Apply Search Filter</h5>
                            </div>
                            <div class="left_option">
                                <div class="left_inner">
                                    <h6>Select Date Range</h6>
                                    <i class="fas fa-calendar-alt mr-2"></i>
                                    <div class="button_input_wrap">
                                        <input type="text" name="date_range" class="form-control" autocomplete="off">
                                        <div class="apply_reset_btn">
                                            <button class="btn btn-primary apply apply-filter mr-1"><i class="fas fa-paper-plane mr-2"></i>Apply</button>
                                            <button class="btn btn-primary reset-button"><i class="fas fa-sync-alt mr-2"></i>Reset</button>                          
                                        </div>
                                    </div>
                                </div>
                                <div class="advance_options_btn" style="">
                                    <button class="btn btn-primary export-as-csv"><i class="fas fa-share mr-2"></i>Export as CSV</button>
                                    <button class="btn btn-primary export-bulk-invoices"><i class="fas fa-download mr-2"></i>Download bulk invoices</button>                                            
                                </div>
                            </div>
                        </div> --}}
                        <div class="advance-options" style="display: none;">
                            <div class="title">
                                <h5><i class="fa fa-filter mr-1"></i>Apply Search Filter</h5>
                            </div>
                            <div class="left_option">
                                <div class="left_inner">
                                    <h6>Select Job Type</h6>
                                    <i class="fa fa-suitcase mr-2"></i>
                                    <div class="button_input_wrap">
                                        <div>
                                            <select name="job_type" class="form-control">
                                                <option selected="" disabled="">Select Job Type</option>
                                                <option value="featured">Featured</option>
                                                <option value="non_featured">Non Featured</option>
                                            </select>
                                            <select name="job_status" class="form-control">
                                                <option selected="" disabled="">Select Job status</option>
                                                <option value="expired">Expired</option>
                                                <option value="open">Open</option>
                                                <option value="unpublished">Unpublished</option>
                                            </select>
                                        </div>
                                        <div class="apply_reset_btn">
                                            <button class="btn btn-primary apply apply-filter mr-1"><i class="fa fa-paper-plane mr-2"></i>Apply</button>
                                            <button class="btn btn-primary reset-button"><i class="fa fa-refresh mr-2"></i>Reset</button>                          
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table style="width:100%" id="jobsList" class="table table-bordered table-hover yajra-datatable">
                        <thead>
                            <tr>
                                
                                <th>{{ __('adminlte::adminlte.reference_number') }}</th>
                                <th>{{ __('adminlte::adminlte.job_title') }}</th>
                                <th>{{ __('adminlte::adminlte.status') }}</th>
                                <th>{{ __('adminlte::adminlte.company') }}</th>
                                <th>{{ __('adminlte::adminlte.created_by') }}</th>
                                <th>{{ __('adminlte::adminlte.expiry_date') }}</th>
                                <th>{{ __('adminlte::adminlte.no_of_redirections') }}</th>
                                @can('manage_jobs_actions')
                                <th>{{ __('adminlte::adminlte.actions') }}</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            
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
  <style>
    .free-advert { background-color: #c9e8d3 !important; }
    .free-advert:hover { background-color: #dae8df !important; }
  </style>
@stop

@section('js')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#jobsList').DataTable( {
        columnDefs: [ {
          targets: 0,
          render: function ( data, type, row ) {
            return data.substr( 0, 2 );
          }
        }]
      });

        var table;

        function build_datatable(job_type='',job_status='') {
            console.log(job_type);
            table = $('.yajra-datatable').DataTable({
                "columnDefs": [
                    { "width": "50px", "targets": "_all" }
                ],
                responsive: true,
                aaSorting: [],
                processing: true,
                serverSide: true,
                ajax: {
                    url:"{{ route('datatable.get.published.job') }}", 
                  type: 'GET',
                  data: {
                    job_type:job_type,
                    job_status:job_status
                  }  
                },
                columns: [
                    // {data: 'id', name: 'id'},
                    {data: 'job_ref_number', name: 'job_ref_number'},
                    {data: 'job_title', name: 'job_title'},
                    // {data: 'job_type', name: 'job_type'},
                    {data: 'status', name: 'status'},
                    {data: 'company_name', name: 'company_name'},
                    {data: 'recruiter_name', name: 'recruiter_name'},
                    {data: 'expiring_at', name: 'expiring_at'},
                    {data: 'application_count', name: 'application_count'},
                    {
                        data: 'action', 
                        name: 'action', 
                        orderable: true, 
                        searchable: true
                    },
                ],
                language: {
                "processing": "<div class='datatable-loader-processing'><div class='loader-img'></div></div>"
                },
            });
        } 

        build_datatable();

        $('body').on('click','.show-advance-options',function(e){
            e.preventDefault();
            $('.advance-options-wrap').slideToggle();
        });

        $('body').on('click','.apply-filter',function(){
            $('.yajra-datatable').DataTable().destroy();
            build_datatable($('select[name="job_type"]').val(),$('select[name="job_status"]').val());
            
        });

        $('body').on('click','.reset-button',function(){
            $('select[name="job_type"]').val('');
            $('.yajra-datatable').DataTable().destroy();
            build_datatable();
        })
    });

    $('body').on('click','.show-advance-options',function(e){
        e.preventDefault();
        $('.advance-options').slideToggle();
    });
    $('body').on('click','.delete-button',function(){

    
    // $('.delete-button').click(function(e) {
      var id = $(this).attr('data-id');
      var obj = $(this);
      // console.log({id});
      swal({
        title: "Are you sure?",
        text: "Are you sure you want to move this Job to the Recycle Bin?",
        type: "warning",
        showCancelButton: true,
      }, function(willDelete) {
        if (willDelete) {
          $.ajax({
            url: "{{ route('delete_job') }}",
            type: 'post',
            data: {
              id: id
            },
            dataType: "JSON",
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
              console.log("Response", response);
              if(response.success == 1) {
                window.location.reload();
                /* console.log("response", response);
                obj.parent().parent().remove(); */
              }
              else {
                console.log("FALSE");
                setTimeout(() => {
                alert("Something went wrong! Please try again.");
                }, 500);
                // swal("Error!", "Something went wrong! Please try again.", "error");
                // swal("Something went wrong! Please try again.");
              }
            }
          });
        } 
      });
    });
  </script>
@stop
