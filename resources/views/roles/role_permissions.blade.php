@extends('adminlte::page')

@section('title', 'Role Permissions')

@section('content_header')
@stop

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header alert d-flex justify-content-between align-items-center">
          <a class="btn btn-sm btn-success back-button" href="{{ url()->previous() }}">{{ __('adminlte::adminlte.back') }}</a>
            <h3>{{ __('adminlte::adminlte.role_permissions') }}</h3>
          </div>
          <div class="card-body pb-3">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
            <form id="addRoleForm" method="post", action="{{ route('save_permissions') }}">
              @csrf
              <div class="card-body">
                <div class="role-name">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label for="role_name">{{ __('adminlte::adminlte.role_name') }}</label>
                        <input type="hidden" name="role_id" id="role_id">
                        <select name="role_name" class="form-control" id="role_name">
                            <option value="" hidden>Select Role</option>
                          @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                          @endforeach
                        </select>
                        @if($errors->has('role_name'))
                          <div class="error">{{ $errors->first('role_name') }}</div>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="role-permissions" id="role-permissions">
                  <label for="permissions[]" class="label">{{ __('adminlte::adminlte.permissions') }}</label>
                  <label id="permissions[]-error" class="error" for="permissions[]" style="font-weight: 400 !important;"></label>
                  <br>
                  @if($errors->has('permissions'))
                    <div class="error">{{ $errors->first('permissions') }}</div>
                  @endif

                  <div class="custom_check_wrap">
                    <div class="custom-check">
                      <input type="checkbox" id="full_access" class="">
                      <span></span>       
                    </div>
                    <strong>FULL ACCESS</strong>                     
                  </div> 
                  <div class="title">
                    <h5>Customers Management</h5>
                    <hr/>
                  </div>

                  <div class="permissions-section">
                    <div class="row ">
                      <div class="col-4">
                        <div class="form-group">
                          <div class="permissions-section-inner-sec">
                            <p class="headings"><strong class="list-text">Pending</strong></p>
                            <div class="custom_check_wrap">
                              <div class="custom-check">
                                  <input type="checkbox" id="pending_customer_permissions" class="ckbCheckAll"> 
                                  <span></span>                             
                              </div>
                              <strong class="list-text">Select All</strong>
                            </div>
                            
                            <div id="checkBoxes">
                              @foreach($pendingCustomersPermissions as $permission)
                                <div class="custom_check_wrap">
                                  <div class="custom-check">
                                    <input type="checkbox" class="checkBoxClass pendingCustomerscheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                    <span></span>                                
                                  </div>
                                  <label class="mb-0">{{ $permission->name }}</label>
                                </div>
                              @endforeach
                            </div>                            
                          </div>
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="form-group">
                          <div class="permissions-section-inner-sec">
                            <p class="headings"><strong class="list-text">Whitelisted</strong></p>
                            <div class="custom_check_wrap">
                              <div class="custom-check">
                                  <input type="checkbox" id="whitelisted_customer_permissions" class="ckbCheckAll">
                                  <span></span>                              
                              </div>
                              <strong class="list-text">Select All</strong>
                            </div>
                            <div id="checkBoxes">
                              @foreach($whitelistedCustomersPermissions as $permission)
                                <div class="custom_check_wrap">
                                  <div class="custom-check">
                                    <input type="checkbox" class="checkBoxClass whitelistedCustomerscheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                    <span></span>
                                  </div>
                                  <label class="mb-0">{{ $permission->name }}</label>
                                </div>
                              @endforeach
                            </div>
                          </div>  
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="form-group">
                          <div class="permissions-section-inner-sec">
                            <p class="headings"><strong class="list-text">Rejected</strong></p>
                            <div class="custom_check_wrap">
                              <div class="custom-check">
                                  <input type="checkbox" id="rejected_customer_permissions" class="ckbCheckAll">
                                  <span></span>                              
                              </div>
                              <strong class="list-text">Select All</strong>                            
                            </div>
                            <div id="checkBoxes">
                              @foreach($rejectedCustomersPermissions as $permission)
                                <div class="custom_check_wrap">
                                  <div class="custom-check">
                                    <input type="checkbox" class="checkBoxClass rejectedCustomerscheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                    <span></span>                                  
                                  </div>
                                  <label class="mb-0">{{ $permission->name }}</label>
                                </div>
                              @endforeach
                          </div>  
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="title">
                    <h5>Users Management</h5>
                    <hr/>
                  </div>

                  <div class="row permissions-section">
                    <div class="col-4">
                      <div class="form-group">
                        <div class="permissions-section-inner-sec">
                          <p class="headings"><strong class="list-text">Jobseekers</strong></p>
                          <div class="custom_check_wrap">
                            <div class="custom-check">
                              <input type="checkbox" id="jobseeker_permissions" class="ckbCheckAll">
                              <span></span>
                            </div>
                              <strong class="list-text">Select All</strong>
                          </div>
                          <div id="checkBoxes">
                            @foreach($jobseekersPermissions as $permission)
                              <div class="custom_check_wrap">
                                <div class="custom-check">
                                  <input type="checkbox" class="checkBoxClass jobseekerscheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                  <span></span>
                                </div>
                                  <label class="mb-0">{{ $permission->name }}</label>
                              </div>
                            @endforeach
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group">
                        <div class="permissions-section-inner-sec">
                          <p class="headings"><strong class="list-text">Guests</strong></p>
                          <div class="custom_check_wrap">
                            <div class="custom-check">
                              <input type="checkbox" id="guest_permissions" class="ckbCheckAll">
                              <span></span>
                            </div>
                              <strong class="list-text">Select All</strong>
                          </div>
                          <div id="checkBoxes">
                            @foreach($guestsPermissions as $permission)
                              <div class="custom_check_wrap">
                                <div class="custom-check">
                                  <input type="checkbox" class="checkBoxClass guestscheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                  <span></span>
                                </div>
                                  <label class="mb-0">{{ $permission->name }}</label>
                              </div>
                            @endforeach
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group">
                        <div class="permissions-section-inner-sec">
                          <p class="headings"><strong class="list-text">Recruiters</strong></p>
                          <div class="custom_check_wrap">
                            <div class="custom-check">
                              <input type="checkbox" id="recruiter_permissions" class="ckbCheckAll">
                              <span></span>
                            </div>
                              <strong class="list-text">Select All</strong>
                          </div>
                          <div id="checkBoxes">
                            @foreach($recruitersPermissions as $permission)
                              <div class="custom_check_wrap">
                                <div class="custom-check">
                                   <input type="checkbox" class="checkBoxClass recruiterscheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                   <span></span>
                                </div>
                                <label class="mb-0">{{ $permission->name }}</label>
                              </div>
                            @endforeach
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group">
                        <div class="permissions-section-inner-sec">
                          <p class="headings"><strong class="list-text">Admins</strong></p>
                          <div class="custom_check_wrap">
                            <div class="custom-check">
                              <input type="checkbox" id="admins_permissions" class="ckbCheckAll">
                              <span></span>
                            </div>
                              <strong class="list-text">Select All</strong>
                          </div>
                          <div id="checkBoxes">
                            @foreach($adminsPermissions as $permission)
                              <div class="custom_check_wrap">
                                <div class="custom-check">
                                  <input type="checkbox" class="checkBoxClass adminscheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                  <span></span>
                                </div>
                                <label class="mb-0">{{ $permission->name }}</label>
                              </div>
                            @endforeach
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="title">
                    <h5>Jobs Management</h5>
                    <hr/>
                  </div>

                  <div class="permissions-section">
                    <div class="row">
                      <div class="col-4">
                        <div class="form-group">
                          <div class="permissions-section-inner-sec">
                            <p class="headings"><strong class="list-text">Jobs Published</strong></p>
                            <div class="custom_check_wrap">
                              <div class="custom-check">
                                <input type="checkbox" id="jobs_permissions" style="height: 15px;width: 50px;" class="ckbCheckAll">
                                <span></span>
                              </div>
                                <strong class="list-text">Select All</strong>
                            </div>
                            <div id="checkBoxes">
                              @foreach($jobsPermissions as $permission)
                                <div class="custom_check_wrap">
                                  <div class="custom-check">
                                    <input type="checkbox" class="checkBoxClass jobscheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                    <span></span>
                                  </div>
                                  <label class="mb-0">{{ $permission->name }}</label>
                                </div>
                              @endforeach
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-4">
                        <div class="form-group">
                          <div class="permissions-section-inner-sec">
                            <p class="headings"><strong class="list-text">Jobs Suspended</strong></p>
                            <div class="custom_check_wrap">
                              <div class="custom-check">
                                <input type="checkbox" id="suspended_jobs_permissions" class="ckbCheckAll">
                                <span></span>
                              </div>
                                <strong class="list-text">Select All</strong>
                            </div>
                            <div id="checkBoxes">
                              @foreach($suspendedJobsPermissions as $permission)
                                <div class="custom_check_wrap">
                                  <div class="custom-check">
                                    <input type="checkbox" class="checkBoxClass suspendedJobscheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                    <span></span>
                                  </div>
                                  <label class="mb-0">{{ $permission->name }}</label>
                                </div>
                              @endforeach
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-4">
                        <div class="form-group">
                          <div class="permissions-section-inner-sec">
                            <p class="headings"><strong class="list-text">Jobs Applications</strong></p>
                            <div class="custom_check_wrap">
                              <div class="custom-check">
                                <input type="checkbox" id="job_applications_permissions" style="height: 15px;width: 50px;" class="ckbCheckAll">
                                <span></span>
                              </div>
                                <strong class="list-text">Select All</strong>
                            </div>
                            <div id="checkBoxes">
                              @foreach($jobApplicationsPermissions as $permission)
                                <div class="custom_check_wrap">
                                  <div class="custom-check">
                                    <input type="checkbox" class="checkBoxClass jobApplicationscheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                    <span></span>  
                                  </div>
                                  <label class="mb-0">{{ $permission->name }}</label>
                                </div>
                              @endforeach
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-4">
                        <div class="form-group">
                          <div class="permissions-section-inner-sec">
                            <p class="headings"><strong class="list-text">Jobs Bookmarked</strong></p>
                            <div class="custom_check_wrap">
                              <div class="custom-check">
                                <input type="checkbox" id="job_bookmarks_permissions" style="height: 15px;width: 50px;" class="ckbCheckAll">
                                <span></span>
                              </div>
                                <strong class="list-text">Select All</strong>
                            </div>
                            <div id="checkBoxes">
                              @foreach($jobBookmarksPermissions as $permission)
                                <div class="custom_check_wrap">
                                  <div class="custom-check">
                                    <input type="checkbox" class="checkBoxClass jobBookmarkscheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                    <span></span>  
                                  </div>
                                  <label class="mb-0">{{ $permission->name }}</label>
                                </div>
                              @endforeach
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="form-group">
                          <div class="permissions-section-inner-sec">
                            <p class="headings"><strong class="list-text">Jobs Reported</strong></p>
                            <div class="custom_check_wrap">
                              <div class="custom-check">
                                <input type="checkbox" id="reported_jobs_permissions" style="height: 15px;width: 50px;" class="ckbCheckAll">
                                <span></span>
                              </div>
                                <strong class="list-text">Select All</strong>
                            </div>
                            <div id="checkBoxes">
                              @foreach($reportedJobsPermissions as $permission)
                                <div class="custom_check_wrap">
                                  <div class="custom-check">
                                    <input type="checkbox" class="checkBoxClass reportedJobscheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                    <span></span>  
                                  </div>
                                  <label class="mb-0">{{ $permission->name }}</label>
                                </div>
                              @endforeach
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-4">
                        <div class="form-group">
                          <div class="permissions-section-inner-sec">
                            <p class="headings"><strong class="list-text">Jobs Viewed</strong></p>
                            <div class="custom_check_wrap">
                              <div class="custom-check">
                                <input type="checkbox" id="viewed_jobs_permissions" style="height: 15px;width: 50px;" class="ckbCheckAll">
                                <span></span>
                              </div>
                                <strong class="list-text">Select All</strong>
                            </div>
                            <div id="checkBoxes">
                              @foreach($viewedJobsPermissions as $permission)
                                <div class="custom_check_wrap">
                                  <div class="custom-check">
                                    <input type="checkbox" class="checkBoxClass viewedJobscheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                    <span></span>  
                                  </div>
                                  <label class="mb-0">{{ $permission->name }}</label>
                                </div>
                              @endforeach
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-4">
                        <div class="form-group">
                          <div class="permissions-section-inner-sec">
                            <p class="headings"><strong class="list-text">Jobs History / Templates</strong></p>
                            <div class="custom_check_wrap">
                              <div class="custom-check">
                                <input type="checkbox" id="job_history_permissions" style="height: 15px;width: 50px;" class="ckbCheckAll">
                                <span></span>
                              </div>
                                <strong class="list-text">Select All</strong>
                            </div>
                            <div id="checkBoxes">
                              @foreach($jobHistoryPermissions as $permission)
                                <div class="custom_check_wrap">
                                  <div class="custom-check">
                                    <input type="checkbox" class="checkBoxClass jobHistorycheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                    <span></span>  
                                  </div>
                                  <label class="mb-0">{{ $permission->name }}</label>
                                </div>
                              @endforeach
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="form-group">
                          <div class="permissions-section-inner-sec">
                            <p class="headings"><strong class="list-text">Jobs Search History</strong></p>
                            <div class="custom_check_wrap">
                              <div class="custom-check">
                                <input type="checkbox" id="job_search_history_permissions" style="height: 15px;width: 50px;" class="ckbCheckAll">
                                <span></span>
                              </div>
                                <strong class="list-text">Select All</strong>
                            </div>
                            <div id="checkBoxes">
                              @foreach($jobSearchHistoryPermissions as $permission)
                                <div class="custom_check_wrap">
                                  <div class="custom-check">
                                    <input type="checkbox" class="checkBoxClass jobSearchHistorycheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                    <span></span>  
                                  </div>
                                  <label class="mb-0">{{ $permission->name }}</label>
                                </div>
                              @endforeach
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="title">
                    <h5>Payments</h5>
                    <hr/>
                  </div>

                  <div class="row permissions-section">
                    {{-- <div class="col-4">
                      <div class="form-group">
                        <div class="permissions-section-inner-sec">
                          <p class="headings"><strong class="list-text">Company Credits</strong></p>
                          <div class="custom_check_wrap">
                            <div class="custom-check">
                              <input type="checkbox" id="credits_permissions" class="ckbCheckAll">
                              <span></span>
                            </div>
                              <strong class="list-text">Select All</strong>
                          </div>
                          <div id="checkBoxes">
                            @foreach($companyCreditsPermissions as $permission)
                              <div class="custom_check_wrap">
                                <div class="custom-check">
                                  <input type="checkbox" class="checkBoxClass companyCreditscheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                  <span></span>
                                </div>
                                <label class="mb-0">{{ $permission->name }}</label>
                              </div>
                            @endforeach
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group">
                        <div class="permissions-section-inner-sec">
                          <p class="headings"><strong class="list-text">Credits History</strong></p>
                          <div class="custom_check_wrap">
                            <div class="custom-check">
                              <input type="checkbox" id="credits_history_permissions" class="ckbCheckAll">
                              <span></span>
                            </div>
                              <strong class="list-text">Select All</strong>
                          </div>
                          <div id="checkBoxes">
                            @foreach($companyCreditsHistoryPermissions as $permission)
                              <div class="custom_check_wrap">
                                <div class="custom-check">
                                  <input type="checkbox" class="checkBoxClass companyCreditsHistorycheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                  <span></span>
                                </div>
                                <label class="mb-0">{{ $permission->name }}</label>
                              </div>
                            @endforeach
                          </div>
                        </div>
                      </div>
                    </div> --}}
                    <div class="col-4">
                      <div class="form-group">
                        <div class="permissions-section-inner-sec">
                          <p class="headings"><strong class="list-text">Payment Transactions</strong></p>
                          <div class="custom_check_wrap">
                            <div class="custom-check">
                              <input type="checkbox" id="payments_permissions" class="ckbCheckAll">
                              <span></span>
                            </div>
                              <strong class="list-text">Select All</strong>
                          </div>
                          <div id="checkBoxes">
                            @foreach($paymentTransactionsPermissions as $permission)
                              <div class="custom_check_wrap">
                                <div class="custom-check">
                                  <input type="checkbox" class="checkBoxClass paymentTransactionscheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                  <span></span>
                                </div>
                                <label class="mb-0">{{ $permission->name }}</label>
                              </div>
                            @endforeach
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="title">
                    <h5>Content Management</h5>
                    <hr/>
                  </div>

                  <div class="row permissions-section">
                    <div class="col-4">
                      <div class="form-group">
                        <div class="permissions-section-inner-sec">
                          <p class="headings"><strong class="list-text">Website</strong></p>
                          <div class="custom_check_wrap">
                            <div class="custom-check">
                              <input type="checkbox" id="website_permissions" class="ckbCheckAll">
                              <span></span>
                            </div>
                              <strong class="list-text">Select All</strong>
                          </div>
                          <div id="checkBoxes">
                            @foreach($websitePagesPermissions as $permission)
                              <div class="custom_check_wrap">
                                <div class="custom-check">
                                  <input type="checkbox" class="checkBoxClass websitecheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                  <span></span>
                                </div>
                                <label class="mb-0">{{ $permission->name }}</label>
                              </div>
                            @endforeach
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group">
                        <div class="permissions-section-inner-sec">
                          <p class="headings"><strong class="list-text">Mobile</strong></p>
                          <div class="custom_check_wrap">
                            <div class="custom-check">
                              <input type="checkbox" id="mobile_permissions" class="ckbCheckAll">
                              <span></span>
                            </div>
                              <strong class="list-text">Select All</strong>
                          </div>
                          <div id="checkBoxes">
                            @foreach($mobilePagesPermissions as $permission)
                              <div class="custom_check_wrap">
                                <div class="custom-check">
                                  <input type="checkbox" class="checkBoxClass mobilecheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                  <span></span>
                                </div>
                                <label class="mb-0">{{ $permission->name }}</label>
                              </div>
                            @endforeach
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="title">
                    <h5>Users' Feedback</h5>
                    <hr/>
                  </div>

                  <div class="row permissions-section">
                    <div class="col-4">
                      <div class="form-group">
                        <div class="permissions-section-inner-sec">
                          <p class="headings"><strong class="list-text">Tickets</strong></p>
                          <div class="custom_check_wrap">
                            <div class="custom-check">
                              <input type="checkbox" id="tickets_permissions" class="ckbCheckAll">
                              <span></span>
                            </div>
                              <strong class="list-text">Select All</strong>
                          </div>
                          <div id="checkBoxes">
                            @foreach($ticketsPermissions as $permission)
                              <div class="custom_check_wrap">
                                <div class="custom-check">
                                  <input type="checkbox" class="checkBoxClass ticketscheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                  <span></span>
                                </div>
                                <label class="mb-0">{{ $permission->name }}</label>
                              </div>
                            @endforeach
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <div class="col-4">
                      <div class="form-group">
                        <div class="permissions-section-inner-sec">
                          <p class="headings"><strong class="list-text">Feedbacks</strong></p>
                          <div class="custom_check_wrap">
                            <div class="custom-check">
                              <input type="checkbox" id="feedbacks_permissions" class="ckbCheckAll">
                              <span></span>
                            </div>
                              <strong class="list-text">Select All</strong>
                          </div>
                          <div id="checkBoxes">
                            @foreach($feedbacksPermissions as $permission)
                              <div class="custom_check_wrap">
                                <div class="custom-check">
                                  <input type="checkbox" class="checkBoxClass feedbackscheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                  <span></span>
                                </div>
                                <label class="mb-0">{{ $permission->name }}</label>
                              </div>
                            @endforeach
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <div class="col-4">
                      <div class="form-group">
                        <div class="permissions-section-inner-sec">
                          <p class="headings"><strong class="list-text">Contact Us</strong></p>
                          <div class="custom_check_wrap">
                            <div class="custom-check">
                              <input type="checkbox" id="contact_us_permissions" class="ckbCheckAll">
                              <span></span>
                            </div>
                              <strong class="list-text">Select All</strong>
                          </div>
                          <div id="checkBoxes">
                            @foreach($contactUsPermissions as $permission)
                              <div class="custom_check_wrap">
                                <div class="custom-check">
                                  <input type="checkbox" class="checkBoxClass contactUscheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                  <span></span>
                                </div>
                                <label class="mb-0">{{ $permission->name }}</label>
                              </div>
                            @endforeach
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>

                  <div class="title">
                    <h5>{{ __('adminlte::adminlte.misc_data_management') }}</h5>
                    <hr/>
                  </div>

                  <div class="row permissions-section">
                    <div class="col-4">
                      <div class="form-group">
                        <div class="permissions-section-inner-sec">
                          <p class="headings"><strong class="list-text">{{ __('adminlte::adminlte.job_industries') }}</strong></p>
                          <div class="custom_check_wrap">
                            <div class="custom-check">
                              <input type="checkbox" id="job_industries_permissions" class="ckbCheckAll">
                              <span></span>
                            </div>
                              <strong class="list-text">Select All</strong>
                          </div>
                          <div id="checkBoxes">
                            @foreach($jobIndustriesPermissions as $permission)
                              <div class="custom_check_wrap">
                                <div class="custom-check">
                                  <input type="checkbox" class="checkBoxClass jobIndustriescheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                  <span></span>
                                </div>
                                  <label class="mb-0">{{ $permission->name }}</label>
                              </div>
                            @endforeach
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group">
                        <div class="permissions-section-inner-sec">
                          <p class="headings"><strong class="list-text">Job Qualifications</strong></p>
                          <div class="custom_check_wrap">
                            <div class="custom-check">
                              <input type="checkbox" id="job_qualifications_permissions" class="ckbCheckAll">
                              <span></span>
                            </div>
                              <strong class="list-text">Select All</strong>
                          </div>
                          <div id="checkBoxes">
                            @foreach($jobQualificationsPermissions as $permission)
                              <div class="custom_check_wrap">
                                <div class="custom-check">
                                  <input type="checkbox" class="checkBoxClass jobQualificationscheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                  <span></span>
                                </div>
                                  <label class="mb-0">{{ $permission->name }}</label>
                              </div>
                            @endforeach
                          </div>
                        </div>
                      </div>
                    </div>
                    {{-- <div class="col-4">
                      <div class="form-group">
                        <div class="permissions-section-inner-sec">
                          <p class="headings"><strong class="list-text">Job Locations</strong></p>
                          <div class="custom_check_wrap">
                            <div class="custom-check">
                              <input type="checkbox" id="job_locations_permissions" class="ckbCheckAll">
                              <span></span>
                            </div>
                              <strong class="list-text">Select All</strong>
                          </div>
                          <div id="checkBoxes">
                            @foreach($jobLocationsPermissions as $permission)
                              <div class="custom_check_wrap">
                                <div class="custom-check">
                                  <input type="checkbox" class="checkBoxClass jobLocationscheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                  <span></span>
                                </div>
                                <label class="mb-0">{{ $permission->name }}</label>
                              </div>
                            @endforeach
                          </div>
                        </div>
                      </div>
                    </div> --}}
                    <div class="col-4">
                      <div class="form-group">
                        <div class="permissions-section-inner-sec">
                          <p class="headings"><strong class="list-text">Skills</strong></p>
                          <div class="custom_check_wrap">
                            <div class="custom-check">
                              <input type="checkbox" id="skills_permissions" class="ckbCheckAll">
                              <span></span>
                            </div>
                              <strong class="list-text">Select All</strong>
                          </div>
                          <div id="checkBoxes">
                            @foreach($skillsPermissions as $permission)
                              <div class="custom_check_wrap">
                                <div class="custom-check">
                                  <input type="checkbox" class="checkBoxClass skillscheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                  <span></span>
                                </div>
                                  <label class="mb-0">{{ $permission->name }}</label>
                              </div>
                            @endforeach
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group">
                        <div class="permissions-section-inner-sec">
                          <p class="headings"><strong class="list-text">Cities</strong></p>
                          <div class="custom_check_wrap">
                            <div class="custom-check">
                              <input type="checkbox" id="cities_permissions" class="ckbCheckAll">
                              <span></span>
                            </div>
                              <strong class="list-text">Select All</strong>
                          </div>
                          <div id="checkBoxes">
                            @foreach($citiesPermissions as $permission)
                              <div class="custom_check_wrap">
                                <div class="custom-check">
                                  <input type="checkbox" class="checkBoxClass citiescheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                  <span></span>
                                </div>
                                  <label class="mb-0">{{ $permission->name }}</label>
                              </div>
                            @endforeach
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group">
                        <div class="permissions-section-inner-sec">
                          <p><strong class="list-text">Counties</strong></p>
                          <div class="custom_check_wrap">
                            <div class="custom-check">
                              <input type="checkbox" id="counties_permissions" class="ckbCheckAll">
                              <span></span>
                            </div>
                              <strong class="list-text">Select All</strong>
                          </div>
                          <div id="checkBoxes">
                            @foreach($countiesPermissions as $permission)
                              <div class="custom_check_wrap">
                                <div class="custom-check">
                                  <input type="checkbox" class="checkBoxClass countiescheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                  <span></span>
                                </div>
                                <label class="mb-0">{{ $permission->name }}</label>
                              </div>
                            @endforeach
                          </div>
                        </div>
                      </div>
                    </div>  
                  </div>

                  <div class="title">
                    <h5>Access Control</h5>
                    <hr/>
                  </div>

                  <div class="row permissions-section">
                    <div class="col-4">
                      <div class="form-group">
                        <div class="permissions-section-inner-sec">
                          <p class="headings"><strong class="list-text">Roles</strong></p>
                          <div class="custom_check_wrap">
                            <div class="custom-check">
                              <input type="checkbox" id="roles_permissions" class="ckbCheckAll">
                              <span></span>
                            </div>
                              <strong class="list-text">Select All</strong>
                          </div>
                          <div id="checkBoxes">
                            @foreach($rolesPermissions as $permission)
                              <div class="custom_check_wrap">
                                <div class="custom-check">
                                  <input type="checkbox" class="checkBoxClass rolescheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                  <span></span>
                                </div>
                                <label class="mb-0">{{ $permission->name }}</label>
                              </div>
                            @endforeach
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group">
                        <div class="permissions-section-inner-sec">
                          <p class="headings"><strong class="list-text">Permissions</strong></p>
                          <div class="custom_check_wrap">
                            <div class="custom-check">
                              <input type="checkbox" id="access_permissions" class="ckbCheckAll">
                              <span></span>
                            </div>
                              <strong class="list-text">Select All</strong>
                          </div>
                          <div id="checkBoxes">
                            @foreach($accessPermissions as $permission)
                              <div class="custom_check_wrap">
                                <div class="custom-check">
                                  <input type="checkbox" class="checkBoxClass accesscheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                  <span></span>    
                                </div>
                                <label class="mb-0">{{ $permission->name }}</label>
                              </div>
                            @endforeach
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  </div>

                  <div class="title">
                    <h5>Recycle Bin</h5>
                    <hr/>
                  </div>

                  <div class="row permissions-section">
                    <div class="col-6">
                      <div class="form-group">
                        <div class="permissions-section-inner-sec">
                          <div class="custom_check_wrap">
                            <div class="custom-check">
                              <input type="checkbox" id="restore_permissions" class="ckbCheckAll">
                              <span></span>
                            </div>
                              <strong class="list-text">Select All</strong>
                          </div>
                          <div id="checkBoxes">
                            @foreach($allRecyledPermissions as $permission)
                              <div class="custom_check_wrap">
                                <div class="custom-check">
                                  <input type="checkbox" class="checkBoxClass restorecheckBox" name="permissions[]" value="{{ $permission->id }}" id="button_{{ $permission->id }}">
                                  <span></span>
                                </div>
                                  <label class="mb-0">{{ $permission->name }}</label>
                              </div>
                            @endforeach
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>

              </div>
              <!-- /.card-body -->
              <div class="card-footer pt-0">
                <button type="submit" class="btn btn-primary">{{ __('adminlte::adminlte.save') }}</button>
              </div>
            </form>
          </div>
        </div>
      </div>
  </div>
</div>
@endsection

@section('css')
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <style>
    strong.list-text {
      position: relative;
      left: -8px;
      top: -3px;
    }
    span.list-text {
      position: relative;
      left: -8px;
      top: -3px;
    }
    /* .role-permissions { display:none; } */
  </style>
@stop

@section('js')
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script>
    $(document).ready(function() {
      checkAll();
      $("input[type='checkbox']").change(function() {
        checkAll();
      });
      $("#role_name").change(function() {
        $('input').filter(':checkbox').prop('checked',false);
        var role = $(this);
        $("#role_id").val(role.val());
        $(".checkBoxClass").removeAttr('checked');
        var id = $("#role_name").val();
        $.ajax({
          url: "{{ route('get_role_permissions') }}",
          type: 'post',
          data: {
            role_id: id
          },
          dataType: "JSON",
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function(res) {
            for (let i = 0; i < res.length; i++) {
              const response = res[i];
              var permissionId = "#button_"+response.permission_id;
              $(permissionId).prop('checked', 'true');
              checkAll();
            }
          }
        });
      });
      
      $('#addRoleForm').validate({
        ignore: [],
        debug: false,
        rules: {
          role_name: {
            required: true
          },
          "permissions[]":{
            required: true
          }
        },
        messages: {
          role_name: {
            required: "The Role Name field is required."
          },
          "permissions[]": {
            required: "You must select at least one permission.",
          }
        }
      });
    });
    
    function checkAll() {
      $("#full_access").click(function() {
        $("input[type=checkbox]").prop('checked', this.checked)
      })
      $("#pending_customer_permissions").click(function() {
        $(".pendingCustomerscheckBox").prop('checked', this.checked)
      })
      $("#whitelisted_customer_permissions").click(function() {
        $(".whitelistedCustomerscheckBox").prop('checked', this.checked)
      })
      $("#rejected_customer_permissions").click(function() {
        $(".rejectedCustomerscheckBox").prop('checked', this.checked)
      })
      $("#recruiter_permissions").click(function() {
        $(".recruiterscheckBox").prop('checked', this.checked)
      })
      $("#jobseeker_permissions").click(function() {
        $(".jobseekerscheckBox").prop('checked', this.checked)
      })
      $("#guest_permissions").click(function() {
        $(".guestscheckBox").prop('checked', this.checked)
      })
      $("#admins_permissions").click(function() {
        $(".adminscheckBox").prop('checked', this.checked)
      })
      $("#jobs_permissions").click(function() {
        $(".jobscheckBox").prop('checked', this.checked)
      })
      $("#suspended_jobs_permissions").click(function() {
        $(".suspendedJobscheckBox").prop('checked', this.checked)
      })
      $("#job_history_permissions").click(function() {
        $(".jobHistorycheckBox").prop('checked', this.checked)
      })
      $("#job_bookmarks_permissions").click(function() {
        $(".jobBookmarkscheckBox").prop('checked', this.checked)
      })
      $("#job_applications_permissions").click(function() {
        $(".jobApplicationscheckBox").prop('checked', this.checked)
      })
      $("#job_search_history_permissions").click(function() {
        $(".jobSearchHistorycheckBox").prop('checked', this.checked)
      })
      $("#reported_jobs_permissions").click(function() {
        $(".reportedJobscheckBox").prop('checked', this.checked)
      })
      $("#viewed_jobs_permissions").click(function() {
        $(".viewedJobscheckBox").prop('checked', this.checked)
      })
      /* $("#credits_permissions").click(function() {
        $(".companyCreditscheckBox").prop('checked', this.checked)
      })
      $("#credits_history_permissions").click(function() {
        $(".companyCreditsHistorycheckBox").prop('checked', this.checked)
      }) */
      $("#payments_permissions").click(function() {
        $(".paymentTransactionscheckBox").prop('checked', this.checked)
      })
      $("#tickets_permissions").click(function() {
        $(".ticketscheckBox").prop('checked', this.checked)
      })
      $("#feedbacks_permissions").click(function() {
        $(".feedbackscheckBox").prop('checked', this.checked)
      })
      $("#contact_us_permissions").click(function() {
        $(".contactUscheckBox").prop('checked', this.checked)
      })
      $("#job_industries_permissions").click(function() {
        $(".jobIndustriescheckBox").prop('checked', this.checked)
      })
      $("#job_qualifications_permissions").click(function() {
        $(".jobQualificationscheckBox").prop('checked', this.checked)
      })
      $("#job_locations_permissions").click(function() {
        $(".jobLocationscheckBox").prop('checked', this.checked)
      })
      $("#skills_permissions").click(function() {
        $(".skillscheckBox").prop('checked', this.checked)
      })
      $("#cities_permissions").click(function() {
        $(".citiescheckBox").prop('checked', this.checked)
      })
      $("#counties_permissions").click(function() {
        $(".countiescheckBox").prop('checked', this.checked)
      })
      $("#roles_permissions").click(function() {
        $(".rolescheckBox").prop('checked', this.checked)
      })
      $("#access_permissions").click(function() {
        $(".accesscheckBox").prop('checked', this.checked)
      })
      $("#restore_permissions").click(function() {
        $(".restorecheckBox").prop('checked', this.checked)
      })
      $("#website_permissions").click(function() {
        $(".websitecheckBox").prop('checked', this.checked)
      })
      $("#mobile_permissions").click(function() {
        $(".mobilecheckBox").prop('checked', this.checked)
      })

      if($('.checkBoxClass:checked').length == $('.checkBoxClass').length) {
        $("#full_access").prop('checked', 'true');
      }
      else {
        $("#full_access").prop('checked', false);
      }

      if($('.pendingCustomerscheckBox:checked').length == $('.pendingCustomerscheckBox').length) {
        $("#pending_customer_permissions").prop('checked', 'true');
      }
      else {
        $("#pending_customer_permissions").prop('checked', false);
      }
      if($('.whitelistedCustomerscheckBox:checked').length == $('.whitelistedCustomerscheckBox').length) {
        $("#whitelisted_customer_permissions").prop('checked', 'true');
      }
      else {
        $("#whitelisted_customer_permissions").prop('checked', false);
      }
      if($('.rejectedCustomerscheckBox:checked').length == $('.rejectedCustomerscheckBox').length) {
        $("#rejected_customer_permissions").prop('checked', 'true');
      }
      else {
        $("#rejected_customer_permissions").prop('checked', false);
      }
      if($('.recruiterscheckBox:checked').length == $('.recruiterscheckBox').length) {
        $("#recruiter_permissions").prop('checked', 'true');
      }
      else {
        $("#recruiter_permissions").prop('checked', false);
      }
      if($('.jobseekerscheckBox:checked').length == $('.jobseekerscheckBox').length) {
        $("#jobseeker_permissions").prop('checked', 'true');
      }
      else {
        $("#jobseeker_permissions").prop('checked', false);
      }
      if($('.guestscheckBox:checked').length == $('.guestscheckBox').length) {
        $("#guest_permissions").prop('checked', 'true');
      }
      else {
        $("#guest_permissions").prop('checked', false);
      }
      if($('.adminscheckBox:checked').length == $('.adminscheckBox').length) {
        $("#admins_permissions").prop('checked', 'true');
      }
      else {
        $("#admins_permissions").prop('checked', false);
      }
      if($('.jobscheckBox:checked').length == $('.jobscheckBox').length) {
        $("#jobs_permissions").prop('checked', 'true');
      }
      else {
        $("#jobs_permissions").prop('checked', false);
      }
      if($('.suspendedJobscheckBox:checked').length == $('.suspendedJobscheckBox').length) {
        $("#suspended_jobs_permissions").prop('checked', 'true');
      }
      else {
        $("#suspended_jobs_permissions").prop('checked', false);
      }
      if($('.jobHistorycheckBox:checked').length == $('.jobHistorycheckBox').length) {
        $("#job_history_permissions").prop('checked', 'true');
      }
      else {
        $("#job_history_permissions").prop('checked', false);
      }
      if($('.jobBookmarkscheckBox:checked').length == $('.jobBookmarkscheckBox').length) {
        $("#job_bookmarks_permissions").prop('checked', 'true');
      }
      else {
        $("#job_bookmarks_permissions").prop('checked', false);
      }
      if($('.jobApplicationscheckBox:checked').length == $('.jobApplicationscheckBox').length) {
        $("#job_applications_permissions").prop('checked', 'true');
      }
      else {
        $("#job_applications_permissions").prop('checked', false);
      }
      if($('.jobSearchHistorycheckBox:checked').length == $('.jobSearchHistorycheckBox').length) {
        $("#job_search_history_permissions").prop('checked', 'true');
      }
      else {
        $("#job_search_history_permissions").prop('checked', false);
      }
      if($('.reportedJobscheckBox:checked').length == $('.reportedJobscheckBox').length) {
        $("#reported_jobs_permissions").prop('checked', 'true');
      }
      else {
        $("#reported_jobs_permissions").prop('checked', false);
      }
      if($('.viewedJobscheckBox:checked').length == $('.viewedJobscheckBox').length) {
        $("#viewed_jobs_permissions").prop('checked', 'true');
      }
      else {
        $("#viewed_jobs_permissions").prop('checked', false);
      }
      /* if($('.companyCreditscheckBox:checked').length == $('.companyCreditscheckBox').length) {
        $("#credits_permissions").prop('checked', 'true');
      }
      else {
        $("#credits_permissions").prop('checked', false);
      }
      if($('.companyCreditsHistorycheckBox:checked').length == $('.companyCreditsHistorycheckBox').length) {
        $("#credits_history_permissions").prop('checked', 'true');
      }
      else {
        $("#credits_history_permissions").prop('checked', false);
      } */
      if($('.paymentTransactionscheckBox:checked').length == $('.paymentTransactionscheckBox').length) {
        $("#payments_permissions").prop('checked', 'true');
      }
      else {
        $("#payments_permissions").prop('checked', false);
      }
      if($('.ticketscheckBox:checked').length == $('.ticketscheckBox').length) {
        $("#tickets_permissions").prop('checked', 'true');
      }
      else {
        $("#tickets_permissions").prop('checked', false);
      }
      if($('.feedbackscheckBox:checked').length == $('.feedbackscheckBox').length) {
        $("#feedbacks_permissions").prop('checked', 'true');
      }
      else {
        $("#feedbacks_permissions").prop('checked', false);
      }
      if($('.contactUscheckBox:checked').length == $('.contactUscheckBox').length) {
        $("#contact_us_permissions").prop('checked', 'true');
      }
      else {
        $("#contact_us_permissions").prop('checked', false);
      }
      if($('.jobIndustriescheckBox:checked').length == $('.jobIndustriescheckBox').length) {
        $("#job_industries_permissions").prop('checked', 'true');
      }
      else {
        $("#job_industries_permissions").prop('checked', false);
      }
      if($('.jobQualificationscheckBox:checked').length == $('.jobQualificationscheckBox').length) {
        $("#job_qualifications_permissions").prop('checked', 'true');
      }
      else {
        $("#job_qualifications_permissions").prop('checked', false);
      }
      if($('.jobLocationscheckBox:checked').length == $('.jobLocationscheckBox').length) {
        $("#job_locations_permissions").prop('checked', 'true');
      }
      else {
        $("#job_locations_permissions").prop('checked', false);
      }
      if($('.skillscheckBox:checked').length == $('.skillscheckBox').length) {
        $("#skills_permissions").prop('checked', 'true');
      }
      else {
        $("#skills_permissions").prop('checked', false);
      }
      if($('.citiescheckBox:checked').length == $('.citiescheckBox').length) {
        $("#cities_permissions").prop('checked', 'true');
      }
      else {
        $("#cities_permissions").prop('checked', false);
      }
      if($('.countiescheckBox:checked').length == $('.countiescheckBox').length) {
        $("#counties_permissions").prop('checked', 'true');
      }
      else {
        $("#counties_permissions").prop('checked', false);
      }
      if($('.rolescheckBox:checked').length == $('.rolescheckBox').length) {
        $("#roles_permissions").prop('checked', 'true');
      }
      else {
        $("#roles_permissions").prop('checked', false);
      }
      if($('.accesscheckBox:checked').length == $('.accesscheckBox').length) {
        $("#access_permissions").prop('checked', 'true');
      }
      else {
        $("#access_permissions").prop('checked', false);
      }
      if($('.restorecheckBox:checked').length == $('.restorecheckBox').length) {
        $("#restore_permissions").prop('checked', 'true');
      }
      else {
        $("#restore_permissions").prop('checked', false);
      }
      if($('.websitecheckBox:checked').length == $('.websitecheckBox').length) {
        $("#website_permissions").prop('checked', 'true');
      }
      else {
        $("#website_permissions").prop('checked', false);
      }
      if($('.mobilecheckBox:checked').length == $('.mobilecheckBox').length) {
        $("#mobile_permissions").prop('checked', 'true');
      }
      else {
        $("#mobile_permissions").prop('checked', false);
      }
    }
  </script>
@stop
