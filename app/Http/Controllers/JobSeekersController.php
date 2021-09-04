<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserSocialLogin;
use Illuminate\Support\Facades\Gate;
use Hash;
use Auth;

class JobSeekersController extends Controller {
	
	/**
	 * This function is used to Add Job Seeker
	*/
	public function addJobseeker() {
		if(Auth::user()->can('add_jobseeker')) {
			return view('jobseekers/add_jobseeker');
		}
		else {
			return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
		}
	}

	/**
	 * This function is used to Add Job Seeker
	*/
	public function saveJobseeker(Request $request) {
		$validatedData = $request->validate([
			'first_name' => 'required',
			'last_name' => 'required',
			'email' => 'required|email|unique:users',
			'password' => 'required|min:8',
			'confirm_password' => 'required|min:8',
		], [
			'first_name.required' => 'First Name is required',
			'last_name.required' => 'Last Name is required',
			'email.required' => 'Email is required',
			'email.email' => 'Email is not valid',
			'email.unique' => 'This Email is already taken',
			'password.required' => 'Password is required',
			'confirm_password.required' => 'Confirm Password is required'
		]);
		$jobseeker = new User;
		$jobseeker->name = $request->first_name.$request->last_name;
		$jobseeker->first_name = $request->first_name;
		$jobseeker->last_name = $request->last_name;
		$jobseeker->email = $request->email;
		$jobseeker->phone_number = $request->phone_number;
		$jobseeker->password = Hash::make($request->password);
		$jobseeker->ip_address = $_SERVER["REMOTE_ADDR"];
		$jobseeker->signup_via = 'web';
		if($jobseeker->save()) {
			$jobseekersList = User::all();
			return redirect()->route('jobseekers_list', ['jobseekersList' => $jobseekersList])->with('success', 'Jobseeker Added Successfully!');
		}
		else {
			return back()->with('error', 'Something went wrong! Please try again.');
		}
	}

	/**
	 * This function is used to Show Job Seekers Listing
	*/
	public function jobseekersList(Request $request) {
		if(Auth::user()->can('manage_jobseekers')) {
			$jobseekersList = User::orderBy('email')->get();
			return view('jobseekers/jobseekers_list')->with('jobseekersList', $jobseekersList);
		}
		else {
			return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
		}
	}

	/**
	 * This function is used to Show Job Seekers Listing
	*/
	public function viewJobseeker($id) {
		if(Auth::user()->can('view_jobseeker')) {
			$jobseeker = User::where('id', $id)->get();
			$deletedJobseekers = User::onlyTrashed()->get();
			if($jobseeker->isNotEmpty()) {
				return view('jobseekers/view_jobseeker')->with([
					'jobseeker' => $jobseeker,
					'applicantType' => null
				]);
			}
			else {
				return view('jobseekers/view_jobseeker')->with('jobseeker', $deletedJobseekers);
			}
		}
		else {
			return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
		}
	}

	/**
	 * This function is used to Show Job Seekers Listing
	*/
	public function viewUser($id, $applicantType) {
		$applicantType = base64_decode(base64_decode($applicantType));
		if(Auth::user()->can('view_jobseeker')) {
			$jobseeker = $applicantType::where('id', $id)->get();
			return view('jobseekers/view_jobseeker')->with([
				'jobseeker' => $jobseeker,
				'applicantType' => $applicantType
			]);
		}
		else {
			return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
		}
	}

	/**
	 * This function is used to Show Saved Jobs Listing
	*/
	public function editJobseeker($id) {
		if(Auth::user()->can('edit_jobseeker')) {
			$jobseeker = User::where('id', $id)->get();
			return view('jobseekers/edit_jobseeker')->with("jobseeker", $jobseeker);
		}
		else {
			return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
		}
	}

	/**
	 * This function is used to Show Saved Jobs Listing
	*/
	public function updateJobseeker(Request $request) {
		$validatedData = $request->validate([
			'first_name' => 'required',
			'last_name' => 'required',
			'email' => 'required|email',
			'is_job_alert_enabled' => 'required',
		], [
			'first_name.required' => 'First Name is required',
			'last_name.required' => 'Last Name is required',
			'email.required' => 'Email is required',
			'email.email' => 'Email is not valid',
			'is_job_alert_enabled.required' => 'Job Alert Status is required',
		]);
		$dataToUpdate = [
			'name' => $request->first_name.$request->last_name,
			'first_name' => $request->first_name,
			'last_name' => $request->last_name,
			// 'email' => $request->email,
			'phone_number' => $request->phone_number,
			'is_job_alert_enabled' => $request->is_job_alert_enabled,
		];
		$updateUser = User::where('id', $request->id)->update($dataToUpdate);
		if($updateUser) {
			$jobseekersList = User::all();
			return redirect()->route('jobseekers_list', ['jobseekersList' => $jobseekersList])->with('success', 'Jobseeker Updated Successfully!');
		}
		else {
			return back()->with('error', 'Something went wrong! Please try again.');
		}
	}

	/**
	 * This function is used to Permanent Delete a Jobseeker
	*/
	public function permanentDeleteJobseeker(Request $request) {
		$jobseeker = User::where('id', $request->id)->onlyTrashed()->first();

		$jobseeker->jobHistoryApplications()->forceDelete();
		$jobseeker->JobApplications()->forceDelete();
		$jobseeker->socialLogins()->forceDelete();
		$jobseeker->jobAlert()->forceDelete();
		$jobseeker->feedbacks()->forceDelete();
		$jobseeker->jobReports()->forceDelete();
		$jobseeker->jobHistoryViews()->forceDelete();
		$jobseeker->jobHistoryBookmarks()->forceDelete();
		$jobseeker->jobSearchHistory()->forceDelete();
		$jobseeker->jobViewHistory()->forceDelete();
		$jobseeker->JobBookmarks()->forceDelete();
		$deleteJobseeker = $jobseeker->forceDelete();

		if($deleteJobseeker) {
			$res['success'] = 1;
			return json_encode($res);
		}
		else {
			$res['success'] = 0;
			return json_encode($res);
		}
	}

	/**
	 * This function is used to Delete a Jobseeker
	*/
	public function deleteJobseeker(Request $request) {
		$jobseeker = User::where('id', $request->id)->first();

		$jobseeker->jobHistoryApplications()->delete();
		$jobseeker->JobApplications()->delete();
		$jobseeker->socialLogins()->delete();
		$jobseeker->jobAlert()->delete();
		$jobseeker->feedbacks()->delete();
		$jobseeker->jobReports()->delete();
		$jobseeker->jobHistoryViews()->delete();
		$jobseeker->jobHistoryBookmarks()->delete();
		$jobseeker->jobSearchHistory()->delete();
		$jobseeker->jobViewHistory()->delete();
		$jobseeker->JobBookmarks()->delete();
		$deleteJobseeker = $jobseeker->delete();

		if($deleteJobseeker) {
			$res['success'] = 1;
			return json_encode($res);
		}
		else {
			$res['success'] = 0;
			return json_encode($res);
		}
	}

	/**
	 * This function is used to Restore a Jobseeker
	*/
	public function deletedJobseekersList() {
		if(Auth::user()->can('manage_recycle_bin_jobseekers')) {
			$deletedJobseekers = User::onlyTrashed()->orderBy('email')->get();
			return view('jobseekers/deleted_jobseekers_list', ['deletedJobseekers' => $deletedJobseekers]);
		}
		else {
			return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
		}
	}

	/**
	 * This function is used to Show Saved Jobs Listing
	*/
	public function restoreJobseeker(Request $request) {
		$jobseeker = User::where('id', $request->id)->onlyTrashed()->first();

		$jobseeker->jobHistoryApplications()->restore();
		$jobseeker->JobApplications()->restore();
		$jobseeker->socialLogins()->restore();
		$jobseeker->jobAlert()->restore();
		$jobseeker->feedbacks()->restore();
		$jobseeker->jobReports()->restore();
		$jobseeker->jobHistoryViews()->restore();
		$jobseeker->jobHistoryBookmarks()->restore();
		$jobseeker->jobSearchHistory()->restore();
		$jobseeker->jobViewHistory()->restore();
		$jobseeker->JobBookmarks()->restore();
		$restoreJobseeker = $jobseeker->restore();

		if($restoreJobseeker) {
			$jobseekersList = User::all();
			$res['success'] = 1;
			$res['data'] = $jobseekersList;
			return json_encode($res);
		}
		else {
			$res['success'] = 0;
			return json_encode($res);
		}
	}

	public function toggleJobAlert(Request $request)
	{
		$user = User::find($request->job_seeker_id);

        if ($user->is_job_alert_enabled) {
            
            $user->is_job_alert_enabled = 0;

        }else{
            
            $user->is_job_alert_enabled = 1;            
        }

        $user->save();
		
	}

	public function storeJobAlert(Request $request,$id)
	{
		
		if (User::find($id)->jobAlert) {
            
            User::find($id)->jobAlert()->update([
                'keywords' => $request->keywords,
                'locations' => isset($request->locations)?implode(',', $request->locations):null,
                'distance' => $request->distance,
                'min_salary' => $request->min_salary,
                'max_salary' => $request->max_salary,
                'job_types' => isset($request->job_types)?implode(',', $request->job_types):null,
                'job_posted' => $request->job_posted

            ]);
        }else{
            User::find($id)->jobAlert()->create([
                'keywords' => $request->keywords,
                'locations' => isset($request->locations)?implode(',', $request->locations):null,
                'distance' => $request->distance,
                'min_salary' => $request->min_salary,
                'max_salary' => $request->max_salary,
                'job_types' => isset($request->job_types)?implode(',', $request->job_types):null,
                'job_posted' => $request->job_posted
            ]);
        }
            
        return response()->json([
            'status'=> true,
        ]);		
	}

}
