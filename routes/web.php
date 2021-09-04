<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\JobSeekersController;
use App\Http\Controllers\RecruitersController;
use App\Http\Controllers\AdminsController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\OrganizationsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\MiscController;
// use App\Http\Controllers\CreditsController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\DatatableController;
use App\Http\Controllers\GuestsController;

// New Controllers
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\QuestionController;

use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
  return redirect()->route('login');
  // return view('welcome');
})->name('admin_home');

Route::get('/places', function (Request $request) {

    return (\App\Models\UkPlace::where('place','LIKE','%'.$request->input('query').'%')->get());
})->name('get.places');

Route::middleware(['auth:admin'])->group(function () {


  Route::get('/course/list', [CourseController::class, 'get_course_list'])->name('get_courses_by_school');


  // Admin Panel
  Route::group(['prefix' => 'admin_panel'], function () {
    Route::get('/user_permissions', [RolesController::class, 'getUserPermissions'])->name('user_permissions');
    Route::get('/all_permissions', [RolesController::class, 'getAllPermissions'])->name('all_permissions');

    // Common
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/admin_profile', [AdminController::class, 'adminProfile'])->name('admin_profile');
    Route::post('/update_profile', [AdminController::class, 'updateProfile'])->name('update_profile');
    Route::post('/check_password', [AdminController::class, 'checkPassword'])->name('check_password');
    Route::post('/change_password', [AdminController::class, 'changePassword'])->name('change_password');

    // Customers Management
    Route::group(['prefix' => 'customers'], function () {
      Route::get('/pending', [OrganizationsController::class, 'pendingCustomersList'])->name('pending_customers');
      Route::get('/whitelisted', [OrganizationsController::class, 'whitelistedCustomersList'])->name('whitelisted_customers');
      Route::get('/rejected', [OrganizationsController::class, 'rejectedCustomersList'])->name('rejected_customers');
      Route::get('/whitelist/{id}', [OrganizationsController::class, 'whitelistCustomer'])->name('whitelist_customer');
      Route::get('/reject/{id}', [OrganizationsController::class, 'rejectCustomer'])->name('reject_customer');
      Route::get('/{from_page}/view/{id}', [OrganizationsController::class, 'viewCustomer'])->name('view_customer');
      Route::get('/{from_page}/edit/{id}', [OrganizationsController::class, 'editCustomer'])->name('edit_customer');
      Route::post('/update', [OrganizationsController::class, 'updateCustomer'])->name('update_customer');
      Route::post('/delete', [OrganizationsController::class, 'deleteCustomers'])->name('delete_customer');
      Route::post('/restore', [OrganizationsController::class, 'restoreCustomer'])->name('restore_customer');
      Route::get('/check_email', [OrganizationsController::class, 'checkEmail'])->name('check_email');
      Route::get('/add', [OrganizationsController::class, 'addCustomer'])->name('add_customer');
      Route::post('/save', [OrganizationsController::class, 'saveCustomer'])->name('save_customer');
      Route::post('/upload_logo_image', [OrganizationsController::class, 'uploadLogoImage'])->name('upload_logo_image');
    });

    // Users Management
    Route::group(['prefix' => 'users'], function () {
      // Jobseekers
      Route::group(['prefix' => 'jobseekers'], function () {
        Route::get('/list', [JobSeekersController::class, 'jobseekersList'])->name('jobseekers_list');
        Route::get('/view/{id}', [JobSeekersController::class, 'viewJobseeker'])->name('view_jobseeker');
        Route::get('/edit/{id}', [JobSeekersController::class, 'editJobseeker'])->name('edit_jobseeker');
        Route::post('/update', [JobSeekersController::class, 'updateJobseeker'])->name('update_jobseeker');
        Route::post('/delete', [JobSeekersController::class, 'deleteJobseeker'])->name('delete_jobseeker');
        Route::post('/restore', [JobSeekersController::class, 'restoreJobseeker'])->name('restore_jobseeker');
        Route::get('/add', [JobSeekersController::class, 'addJobseeker'])->name('add_jobseeker');
        Route::post('/save', [JobSeekersController::class, 'saveJobseeker'])->name('save_jobseeker');

        //ajax routes
        Route::post('/toggle-job-alert', [JobSeekersController::class, 'toggleJobAlert'])->name('toggle.job.alert');
        Route::post('/store-job-alert/{id}', [JobSeekersController::class, 'storeJobAlert'])->name('store.job.alert');

      });

      // Teachers
      Route::group(['prefix' => 'teachers'], function () {
        Route::get('/list', [TeacherController::class, 'list'])->name('list_teacher');
        Route::get('/view/{id}', [TeacherController::class, 'view'])->name('view_teacher');
        Route::get('/edit/{id}', [TeacherController::class, 'edit'])->name('edit_teacher');
        Route::post('/update', [TeacherController::class, 'update'])->name('update_teacher');
        Route::delete('/delete', [TeacherController::class, 'delete'])->name('delete_teacher');
        Route::post('/restore', [TeacherController::class, 'restore'])->name('restore_teacher');
        Route::get('/add', [TeacherController::class, 'add'])->name('add_teacher');
        Route::post('/save', [TeacherController::class, 'save'])->name('save_teacher');

        //ajax routes
        Route::post('/toggle-job-alert', [TeacherController::class, 'toggleJobAlert'])->name('toggle.job.alert');
        Route::post('/store-job-alert/{id}', [TeacherController::class, 'storeJobAlert'])->name('store.job.alert');

      });


      // Students
      Route::group(['prefix' => 'students'], function () {
        Route::get('/list', [StudentController::class, 'list'])->name('list_student');
        Route::get('/view/{id}', [StudentController::class, 'view'])->name('view_student');
        Route::get('/edit/{id}', [StudentController::class, 'edit'])->name('edit_student');
        Route::post('/update', [StudentController::class, 'update'])->name('update_student');
        Route::delete('/delete', [StudentController::class, 'delete'])->name('delete_student');
        Route::post('/restore', [StudentController::class, 'restore'])->name('restore_student');
        Route::get('/add', [StudentController::class, 'add'])->name('add_student');
        Route::post('/save', [StudentController::class, 'save'])->name('save_student');

        //ajax routes
        Route::post('/toggle-job-alert', [JobSeekersController::class, 'toggleJobAlert'])->name('toggle.job.alert');
        Route::post('/store-job-alert/{id}', [JobSeekersController::class, 'storeJobAlert'])->name('store.job.alert');

      });



      // Recruiters
      Route::group(['prefix' => 'recruiters'], function () {
        Route::get('/list', [RecruitersController::class, 'recruitersList'])->name('recruiters_list');
        Route::get('/view/{id}', [RecruitersController::class, 'viewRecruiter'])->name('view_recruiter');
        Route::get('/edit/{id}', [RecruitersController::class, 'editRecruiter'])->name('edit_recruiter');
        Route::post('/update', [RecruitersController::class, 'updateRecruiter'])->name('update_recruiter');
        Route::post('/delete', [RecruitersController::class, 'deleteRecruiter'])->name('delete_recruiter');
        Route::post('/restore', [RecruitersController::class, 'restoreRecruiter'])->name('restore_recruiter');
        /* Route::get('/add', [RecruitersController::class, 'addRecruiter'])->name('add_recruiter');
        Route::post('/save', [RecruitersController::class, 'saveRecruiter'])->name('save_recruiter'); */
      });

      // Admins
      Route::group(['prefix' => 'admins'], function () {
        Route::get('/list', [AdminsController::class, 'adminsList'])->name('admins_list');
        Route::get('/view/{id}', [AdminsController::class, 'viewAdmin'])->name('view_admin');
        Route::get('/edit/{id}', [AdminsController::class, 'editAdmin'])->name('edit_admin');
        Route::post('/update', [AdminsController::class, 'updateAdmin'])->name('update_admin');
        Route::post('/delete', [AdminsController::class, 'deleteAdmin'])->name('delete_admin');
        Route::post('/restore', [AdminsController::class, 'restoreAdmin'])->name('restore_admin');
        Route::get('/add', [AdminsController::class, 'addAdmin'])->name('add_admin');
        Route::post('/save', [AdminsController::class, 'saveAdmin'])->name('save_admin');
      });

      // Guests
      Route::group(['prefix' => 'guests'], function () {
        Route::get('/list', [GuestsController::class, 'guestsList'])->name('guests_list');
        Route::get('/view/{id}', [GuestsController::class, 'viewGuest'])->name('view_guest');
        Route::get('/view_guest_resume/{id}', [GuestsController::class, 'viewGuestResume'])->name('view_guest_resume');
      });
    });

    // Jobs Management
    Route::group(['prefix' => 'jobs'], function () {
      Route::get('/list', [JobsController::class, 'jobsList'])->name('jobs_list');
      Route::get('/add', [JobsController::class, 'addJob'])->name('add_job');
      Route::post('/save', [JobsController::class, 'saveJob'])->name('save_job');
      Route::post('/delete', [JobsController::class, 'deleteJob'])->name('delete_job');
      Route::post('/restore', [JobsController::class, 'restoreJob'])->name('restore_job');
      Route::get('/suspend/{id}', [JobsController::class, 'suspendJob'])->name('suspend_job');
      Route::get('/resume/{id}', [JobsController::class, 'resumeJob'])->name('resume_job');
      Route::get('/view/{id}', [JobsController::class, 'viewJob'])->name('view_job');
      Route::get('/edit/{id}', [JobsController::class, 'editJob'])->name('edit_job');
      Route::post('/update', [JobsController::class, 'updateJob'])->name('update_job');
      Route::get('/history', [JobsController::class, 'jobsHistory'])->name('jobs_history');
      Route::get('/view_job_history/{id}', [JobsController::class, 'viewJobHistory'])->name('view_job_history');
      Route::post('/upload_company_logo', [JobsController::class, 'uploadImage'])->name('upload_company_logo');
      Route::group(['prefix' => 'bookmarked'], function () {
        Route::get('/list', [JobsController::class, 'bookmarkedJobs'])->name('bookmarked_jobs_list');
        Route::get('/view/{id}', [JobsController::class, 'viewBookmarkedJob'])->name('view_bookmarked_job');
      });
      Route::group(['prefix' => 'applications'], function () {
        Route::get('/list', [JobsController::class, 'jobApplications'])->name('job_applications_list');
        Route::get('/view/{id}', [JobsController::class, 'viewJobApplication'])->name('view_job_application');
      });
      Route::group(['prefix' => 'search_history'], function () {
        Route::get('/list', [JobsController::class, 'jobSearchHistoryList'])->name('job_search_history_list');
        Route::get('/view/{id}', [JobsController::class, 'viewJobSearchHistory'])->name('view_search_history');
      });
      Route::group(['prefix' => 'reported'], function () {
        Route::get('/list', [JobsController::class, 'reportedJobsList'])->name('reported_jobs_list');
        Route::get('/view/{id}', [JobsController::class, 'viewReportedJob'])->name('view_reported_job');
      });
      Route::group(['prefix' => 'viewed'], function () {
        Route::get('/list', [JobsController::class, 'viewedJobsList'])->name('viewed_jobs_list');
        Route::get('/view/{id}', [JobsController::class, 'viewViewedJob'])->name('view_viewed_job');
      });
      Route::group(['prefix' => 'suspended'], function () {
        Route::get('/list', [JobsController::class, 'suspendJobsList'])->name('suspended_jobs_list');
      });
    });

    // Company Credits
    /* Route::group(['prefix' => 'credits'], function () {
      Route::get('/list', [CreditsController::class, 'companyCreditsList'])->name('company_credits_list');
      Route::get('/view/{id}', [CreditsController::class, 'viewCompanyCredit'])->name('view_company_credit');
      Route::get('/add', [CreditsController::class, 'addCompanyCredit'])->name('add_company_credit');
      Route::post('/save', [CreditsController::class, 'saveCompanyCredit'])->name('save_company_credit');
    }); */

    // Credits History
    /* Route::group(['prefix' => 'credits_history'], function () {
      Route::get('/list', [CreditsController::class, 'creditsHistory'])->name('credits_history');
      Route::get('/view/{id}', [CreditsController::class, 'viewCreditHistory'])->name('view_credit_history');
    }); */

    // Payments Transactions
    Route::group(['prefix' => 'payment_transactions'], function () {
      Route::get('/list', [PaymentsController::class, 'paymentTransactionsList'])->name('payment_transactions_list');
      Route::get('/view/{id}', [PaymentsController::class, 'viewPaymentTransaction'])->name('view_payment_transaction');
    });

    // Tickets Management
    Route::group(['prefix' => 'tickets'], function () {
      Route::get('/list', [TicketsController::class, 'ticketsList'])->name('tickets_list');
      Route::get('/view/{id}', [TicketsController::class, 'viewTicket'])->name('view_ticket');
      Route::post('/close', [TicketsController::class, 'closeTicket'])->name('close_ticket');
      Route::post('/open', [TicketsController::class, 'openTicket'])->name('open_ticket');
      Route::post('/reply', [TicketsController::class, 'replyOnTicket'])->name('reply_on_ticket');
    });

    // Courses Management
    Route::group(['prefix' => 'course'], function () {

      Route::get('/course/list', [CourseController::class, 'list'])->name('list_course');
      Route::get('/course/add', [CourseController::class, 'add'])->name('add_course');
      Route::post('/course/save', [CourseController::class, 'save'])->name('save_course');
      Route::get('/course/view/{id}', [CourseController::class, 'view'])->name('view_course');
      Route::get('/course/edit/{id}', [CourseController::class, 'edit'])->name('edit_school');
      Route::post('/course/update', [CourseController::class, 'update'])->name('update_course');
      Route::delete('/course/delete', [CourseController::class, 'delete'])->name('delete_course');

      Route::get('/subject/list', [SubjectController::class, 'List'])->name('list_subject');
      Route::get('/subject/add', [SubjectController::class, 'add'])->name('add_subject');
      Route::post('/subject/save', [SubjectController::class, 'save'])->name('save_subject');
      Route::get('/subject/view/{id}', [SubjectController::class, 'view'])->name('view_subject');
      Route::get('/subject/edit/{id}', [SubjectController::class, 'edit'])->name('edit_subject');
      Route::post('/subject/update', [SubjectController::class, 'update'])->name('update_subject');
      Route::delete('/subject/delete', [SubjectController::class, 'delete'])->name('delete_subject');

      Route::get('/questions/list', [QuestionController::class, 'list'])->name('list_question');
      Route::get('/questions/add', [QuestionController::class, 'add'])->name('add_question');
      Route::post('/questions/save', [QuestionController::class, 'save'])->name('save_question');
      Route::get('/questions/view/{id}', [QuestionController::class, 'view'])->name('view_question');
      Route::get('/questions/edit/{id}', [QuestionController::class, 'edit'])->name('edit_question');
      Route::post('/questions/update', [QuestionController::class, 'update'])->name('update_question');
      Route::delete('/questions/delete', [QuestionController::class, 'delete'])->name('delete_question');
    });

    // School Management
    Route::group(['prefix' => 'school'], function () {
        Route::get('/list', [SchoolController::class, 'schoolList'])->name('school_list');
        Route::get('/add', [SchoolController::class, 'addschool'])->name('add_school');
        Route::post('/save', [SchoolController::class, 'saveschool'])->name('save_school');
        Route::get('/view/{id}', [SchoolController::class, 'viewschool'])->name('view_school');
        Route::get('/edit/{id}', [SchoolController::class, 'editschool'])->name('edit_school');
        Route::post('/update_school', [SchoolController::class, 'updateschool'])->name('update_school');
        Route::delete('/delete_school', [SchoolController::class, 'deleteschool'])->name('delete_school');



    });

    // Feedback
    Route::group(['prefix' => 'feedbacks'], function () {
      Route::get('/list', [TicketsController::class, 'feedbacksList'])->name('feedbacks_list');
      Route::get('/view/{id}', [TicketsController::class, 'viewFeedback'])->name('view_feedback');
    });

    // Contact Us
    Route::group(['prefix' => 'contact_us'], function () {
      Route::get('/list', [TicketsController::class, 'contactUsMessagesList'])->name('contact_us_message_list');
      Route::get('/view/{id}', [TicketsController::class, 'viewContactUsMessage'])->name('view_contact_us_message');
    });

    // Misc Data Management
    Route::group(['prefix' => 'misc'], function () {
      Route::get('/check_if_exists', [MiscController::class, 'checkIfExists'])->name('check_if_exists');
      Route::group(['prefix' => 'job_industries'], function () {
        Route::get('/list', [MiscController::class, 'jobIndustriesList'])->name('job_industries_list');
        Route::get('/add', [MiscController::class, 'addJobIndustry'])->name('add_job_industry');
        Route::post('/save', [MiscController::class, 'saveJobIndustry'])->name('save_job_industry');
        Route::get('/view/{id}', [MiscController::class, 'viewJobIndustry'])->name('view_job_industry');
        Route::get('/edit/{id}', [MiscController::class, 'editJobIndustry'])->name('edit_job_industry');
        Route::post('/update', [MiscController::class, 'updateJobIndustry'])->name('update_job_industry');
        Route::post('/delete', [MiscController::class, 'deleteJobIndustry'])->name('delete_job_industry');
        Route::post('/restore', [MiscController::class, 'restoreJobIndustry'])->name('restore_job_industry');
      });
      Route::group(['prefix' => 'job_qualifications'], function () {
        Route::get('/list', [MiscController::class, 'jobQualificationsList'])->name('job_qualifications_list');
        Route::get('/add', [MiscController::class, 'addJobQualification'])->name('add_job_qualification');
        Route::post('/save', [MiscController::class, 'saveJobQualification'])->name('save_job_qualification');
        Route::get('/view/{id}', [MiscController::class, 'viewJobQualification'])->name('view_job_qualification');
        Route::get('/edit/{id}', [MiscController::class, 'editJobQualification'])->name('edit_job_qualification');
        Route::post('/update', [MiscController::class, 'updateJobQualification'])->name('update_job_qualification');
        Route::post('/delete', [MiscController::class, 'deleteJobQualification'])->name('delete_job_qualification');
        Route::post('/restore', [MiscController::class, 'restoreJobQualification'])->name('restore_job_qualification');
      });
      Route::group(['prefix' => 'job_functions'], function () {
        Route::get('/list', [MiscController::class, 'jobFunctionsList'])->name('job_functions_list');
        Route::get('/add', [MiscController::class, 'addJobFunction'])->name('add_job_function');
        Route::post('/save', [MiscController::class, 'saveJobFunction'])->name('save_job_function');
        Route::get('/view/{id}', [MiscController::class, 'viewJobFunction'])->name('view_job_function');
        Route::get('/edit/{id}', [MiscController::class, 'editJobFunction'])->name('edit_job_function');
        Route::post('/update', [MiscController::class, 'updateJobFunction'])->name('update_job_function');
        Route::post('/delete', [MiscController::class, 'deleteJobFunction'])->name('delete_job_function');
        Route::post('/restore', [MiscController::class, 'restoreJobFunction'])->name('restore_job_function');
      });
      Route::group(['prefix' => 'skills'], function () {
        Route::get('/list', [MiscController::class, 'skillsList'])->name('skills_list');
        Route::get('/add', [MiscController::class, 'addSkill'])->name('add_skill');
        Route::post('/save', [MiscController::class, 'saveSkill'])->name('save_skill');
        Route::get('/view/{id}', [MiscController::class, 'viewSkill'])->name('view_skill');
        Route::get('/edit/{id}', [MiscController::class, 'editSkill'])->name('edit_skill');
        Route::post('/update', [MiscController::class, 'updateSkill'])->name('update_skill');
        Route::post('/delete', [MiscController::class, 'deleteSkill'])->name('delete_skill');
        Route::post('/restore', [MiscController::class, 'restoreSkill'])->name('restore_skill');
      });
      Route::group(['prefix' => 'job_locations'], function () {
        Route::get('/list', [MiscController::class, 'jobLocationsList'])->name('job_locations_list');
        Route::get('/add', [MiscController::class, 'addJobLocation'])->name('add_job_location');
        Route::post('/save', [MiscController::class, 'saveJobLocation'])->name('save_job_location');
        Route::get('/view/{id}', [MiscController::class, 'viewJobLocation'])->name('view_job_location');
        Route::get('/edit/{id}', [MiscController::class, 'editJobLocation'])->name('edit_job_location');
        Route::post('/update', [MiscController::class, 'updateJobLocation'])->name('update_job_location');
        Route::post('/delete', [MiscController::class, 'deleteJobLocation'])->name('delete_job_location');
        Route::post('/restore', [MiscController::class, 'restoreJobLocation'])->name('restore_job_location');
      });
      Route::group(['prefix' => 'cities'], function () {
        Route::get('/list', [MiscController::class, 'CitiesList'])->name('cities_list');
        Route::get('/add', [MiscController::class, 'addCity'])->name('add_city');
        Route::post('/save', [MiscController::class, 'saveCity'])->name('save_city');
        Route::get('/view/{id}', [MiscController::class, 'viewCity'])->name('view_city');
        Route::get('/edit/{id}', [MiscController::class, 'editCity'])->name('edit_city');
        Route::post('/update', [MiscController::class, 'updateCity'])->name('update_city');
        Route::post('/delete', [MiscController::class, 'deleteCity'])->name('delete_city');
        Route::post('/restore', [MiscController::class, 'restoreCity'])->name('restore_city');
      });
      Route::group(['prefix' => 'counties'], function () {
        Route::get('/list', [MiscController::class, 'CountiesList'])->name('counties_list');
        Route::get('/add', [MiscController::class, 'addCounty'])->name('add_county');
        Route::post('/save', [MiscController::class, 'saveCounty'])->name('save_county');
        Route::get('/view/{id}', [MiscController::class, 'viewCounty'])->name('view_county');
        Route::get('/edit/{id}', [MiscController::class, 'editCounty'])->name('edit_county');
        Route::post('/update', [MiscController::class, 'updateCounty'])->name('update_county');
        Route::post('/delete', [MiscController::class, 'deleteCounty'])->name('delete_county');
        Route::post('/restore', [MiscController::class, 'restoreCounty'])->name('restore_county');
      });
    });

    // Access Controls
    Route::group(['prefix' => 'roles'], function () {
      Route::get('/view/{id}', [RolesController::class, 'viewRole'])->name('view_role');
      Route::get('/list', [RolesController::class, 'rolesList'])->name('roles_list');
      Route::get('/add', [RolesController::class, 'addRole'])->name('add_role');
      Route::post('/save', [RolesController::class, 'saveRole'])->name('save_role');
      Route::get('/edit/{id}', [RolesController::class, 'editRole'])->name('edit_role');
      Route::post('/update', [RolesController::class, 'updateRole'])->name('update_role');
      Route::post('/get_role_permissions', [RolesController::class, 'getRolePermissions'])->name('get_role_permissions');
      Route::get('/role_permissions', [RolesController::class, 'rolePermissions'])->name('role_permissions');
      Route::post('/save_permissions', [RolesController::class, 'saveRolePermissions'])->name('save_permissions');
      Route::post('/delete', [RolesController::class, 'deleteRole'])->name('delete_role');
      Route::post('/restore', [RolesController::class, 'restoreRole'])->name('restore_role');
    });

    // Content Management
    Route::group(['prefix' => 'content'], function () {
      Route::group(['prefix' => 'website'], function () {
        Route::get('/list', [ContentController::class, 'websitePagesList'])->name('website_pages_list');
        Route::get('/view/{id}', [ContentController::class, 'viewWebsitePage'])->name('view_website_page');
        Route::get('/edit/{id}', [ContentController::class, 'editWebsitePage'])->name('edit_website_page');
        Route::post('/update', [ContentController::class, 'updateWebsitePage'])->name('update_website_page');
        // Route::get('/add', [ContentController::class, 'addWebsitePage'])->name('add_website_page');
        // Route::post('/save', [ContentController::class, 'saveWebsitePage'])->name('save_website_page');
        // Route::post('/delete', [ContentController::class, 'deleteWebsitePage'])->name('delete_website_page');
        // Route::post('/restore', [ContentController::class, 'restoreWebsitePage'])->name('restore_website_page');
      });
      Route::group(['prefix' => 'mobile'], function () {
        Route::get('/list', [ContentController::class, 'mobilePagesList'])->name('mobile_pages_list');
        Route::get('/view/{id}', [ContentController::class, 'viewMobilePage'])->name('view_mobile_page');
        Route::get('/edit/{id}', [ContentController::class, 'editMobilePage'])->name('edit_mobile_page');
        Route::post('/update', [ContentController::class, 'updateMobilePage'])->name('update_mobile_page');
        // Route::get('/add', [ContentController::class, 'addMobilePage'])->name('add_mobile_page');
        // Route::post('/save', [ContentController::class, 'saveMobilePage'])->name('save_mobile_page');
        // Route::post('/delete', [ContentController::class, 'deleteMobilePage'])->name('delete_mobile_page');
        // Route::post('/restore', [ContentController::class, 'restoreMobilePage'])->name('restore_mobile_page');
      });
    });

    // Recycle Bin
    Route::group(['prefix' => 'recycle_bin'], function () {
      Route::group(['prefix' => 'customers'], function () {
        Route::get('/deleted', [OrganizationsController::class, 'deletedCustomersList'])->name('deleted_customers_list');
        Route::post('/permanent_delete', [OrganizationsController::class, 'permanentDeleteCustomer'])->name('permanent_delete_customer');
      });
      Route::group(['prefix' => 'jobseekers'], function () {
        Route::get('/deleted', [JobSeekersController::class, 'deletedJobseekersList'])->name('deleted_jobseekers_list');
        Route::post('/permanent_delete', [JobSeekersController::class, 'permanentDeleteJobseeker'])->name('permanent_delete_jobseeker');
      });
      Route::group(['prefix' => 'recruiters'], function () {
        Route::get('/deleted', [RecruitersController::class, 'deletedRecruitersList'])->name('deleted_recruiters_list');
        Route::post('/permanent_delete', [RecruitersController::class, 'permanentDeleteRecruiter'])->name('permanent_delete_recruiter');
      });
      Route::group(['prefix' => 'admins'], function () {
        Route::get('/deleted', [AdminsController::class, 'deletedAdminsList'])->name('deleted_admins_list');
        Route::post('/permanent_delete', [AdminsController::class, 'permanentDeleteAdmin'])->name('permanent_delete_admin');
      });
      Route::group(['prefix' => 'jobs'], function () {
        Route::get('/deleted', [JobsController::class, 'deletedJobs'])->name('deleted_jobs_list');
        Route::post('/permanent_delete', [JobsController::class, 'permanentDeleteJob'])->name('permanent_delete_job');
      });
      Route::group(['prefix' => 'job_industries'], function () {
        Route::get('/deleted', [MiscController::class, 'deletedJobIndustries'])->name('deleted_job_industries');
        Route::post('/permanent_delete', [MiscController::class, 'permanentDeleteJobIndustry'])->name('permanent_delete_job_industry');
      });
      Route::group(['prefix' => 'job_qualifications'], function () {
        Route::get('/deleted', [MiscController::class, 'deletedJobQualifications'])->name('deleted_job_qualification');
        Route::post('/permanent_delete', [MiscController::class, 'permanentDeleteJobQualification'])->name('permanent_delete_job_qualification');
      });
      Route::group(['prefix' => 'job_locations'], function () {
        Route::get('/deleted', [MiscController::class, 'deletedJobLocations'])->name('deleted_job_locations');
        Route::post('/permanent_delete', [MiscController::class, 'permanentDeleteJobLocation'])->name('permanent_delete_job_location');
      });
      Route::group(['prefix' => 'skills'], function () {
        Route::get('/deleted', [MiscController::class, 'deletedskills'])->name('deleted_skills');
        Route::post('/permanent_delete', [MiscController::class, 'permanentDeleteSkill'])->name('permanent_delete_skill');
      });
      Route::group(['prefix' => 'cities'], function () {
        Route::get('/deleted', [MiscController::class, 'deletedCities'])->name('deleted_cities');
        Route::post('/permanent_delete', [MiscController::class, 'permanentDeleteCity'])->name('permanent_delete_city');
      });
      Route::group(['prefix' => 'counties'], function () {
        Route::get('/deleted', [MiscController::class, 'deletedCounties'])->name('deleted_counties');
        Route::post('/permanent_delete', [MiscController::class, 'permanentDeleteCounty'])->name('permanent_delete_county');
      });
      Route::group(['prefix' => 'roles'], function () {
        Route::get('/deleted', [RolesController::class, 'deletedRoles'])->name('deleted_roles');
        Route::post('/permanent_delete', [RolesController::class, 'permanentDeleteRole'])->name('permanent_delete_role');
      });
      /* Route::group(['prefix' => 'job_functions'], function () {
        Route::get('/deleted', [MiscController::class, 'deletedJobFunctions'])->name('deleted_job_functions');
      }); */
      /* Route::group(['prefix' => 'website'], function () {
        Route::get('/deleted', [ContentController::class, 'deletedWebsitePages'])->name('deleted_website_pages');
      });
      Route::group(['prefix' => 'mobile'], function () {
        Route::get('/deleted', [ContentController::class, 'deletedWebsitePages'])->name('deleted_mobile_pages');
      }); */
    });

    Route::prefix('datatable')->as('datatable.')->group(function(){

      Route::get('/payment-logs',[DatatableController::class,'getPaymentLogs'])->name('payment.logs');
      Route::post('/export-payment-logs',[DatatableController::class,'exportPaymentLogs'])->name('export.payment.logs');
      Route::post('/export-bulk-invoices',[DatatableController::class,'exportBulkInvoices'])->name('export.bulk.invoices');

      // Route::get('/payment-logs',[DatatableController::class,'getPaymentLogs'])->name('payment.logs');
      Route::get("/published-jobs",[DatatableController::class,'getPublihsedJobs'])->name('get.published.job');

    });

  });

});

Auth::routes([
  'register' => false,
  'reset' => false,
  'verify' => false,
]);


Route::post('get-qualifications',[JobsController::class,'getQualifications'])->name('recruiter.get.qualification');
