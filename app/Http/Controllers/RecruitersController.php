<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recruiter;
use App\Models\Organization;
use App\Models\RecruiterSocialLogin;
use App\Models\Job;
use Hash;
use Auth;
use DB;
use \Carbon\Carbon;

class RecruitersController extends Controller {

	/**
	 * This function is used to Show Recruiters Listing
	*/
	public function recruitersList(Request $request) {
		if(Auth::user()->can('manage_recruiters')) {
			$recruiter = Recruiter::orderBy('email')->get();
			$customers = Organization::all();
			$recruitersList = [];
			for ($i=0; $i < count($recruiter); $i++) {
				for ($j=0; $j < count($customers); $j++) {
					if($customers[$j]->is_whitelisted == '1') {
						if(!in_array($recruiter[$i], $recruitersList, true)) {
							array_push($recruitersList, $recruiter[$i]);
						}
					}
				}
			}
			return view('recruiters/recruiters_list', ['recruitersList' => $recruitersList]);
		}
		else {
			return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
		}
	}

	/**
	 * This function is used to Show Job Seekers Listing
	*/
	public function viewRecruiter($id) {
		if(Auth::user()->can('view_recruiter')) {
			$recruiter = Recruiter::where('id', $id)->get();
			$deletedRecruiter = Recruiter::onlyTrashed()->get();
			if($recruiter->isNotEmpty()) {
				$organization = Organization::where('id', $recruiter[0]->organization_id)->get();
				return view('recruiters/view_recruiter')->with(['recruiter' => $recruiter, 'organization' => $organization]);
			}
			else {
				$organization = Organization::where('id', $deletedRecruiter[0]->organization_id)->get();
				return view('recruiters/view_recruiter')->with(['recruiter' => $deletedRecruiter, 'organization' => $deletedRecruiter]);
			}
		}
		else {
			return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
		}
	}

	/**
	 * This function is used to Show Saved Jobs Listing
	*/
	public function editRecruiter($id) {
		if(Auth::user()->can('edit_recruiter')) {
			$recruiter = Recruiter::find($id);
			$organization = Organization::find($recruiter->organization_id);
			return view('recruiters/edit_recruiter', )->with(["recruiter" => $recruiter, "organization" => $organization]);
		}
		else {
			return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
		}
	}

	/**
	 * This function is used to Show Saved Jobs Listing
	*/
	public function updateRecruiter(Request $request) {
		$validatedData = $request->validate([
			'email' => 'required|email',
			'organization_id' => 'required',
		], [
			'email.required' => 'Email is required.',
			'email.email' => 'Email is not Valid.',
			'organization_id.required' => 'Company is required.',
		]);
		$dataToUpdate = [
			'name' => $request->first_name.' '.$request->last_name,
			'first_name' => $request->first_name,
			'last_name' => $request->last_name,
			'email' => $request->email,
			'phone_number' => $request->phone_number,
			// 'organization_id' => $request->organization_id,
		];
		$updateUser = Recruiter::where('id', $request->id)->update($dataToUpdate);
		if($updateUser) {
			return redirect()->route('recruiters_list')->with('success', 'Recruiter Updated Successfully!');
		}
		else {
			return back()->with('error', 'Something went wrong! Please try again.');
		}
	}

	/**
	 * This function is used to Permanent Delete Recruiter
	*/
	public function permanentDeleteRecruiter(Request $request) {
		$recruiter = Recruiter::where('id', $request->id)->onlyTrashed()->first();
		$recruiter->feedbacks()->forceDelete();
		$recruiter->socialLogins()->forceDelete();
		
		$jobs = Job::where('recruiter_id', $request->id)->withTrashed()->get();
		$jobHistories = $recruiter->jobHistories()->withTrashed()->get();
		$jobHistories->each(function($jobHistory) {
			$jobHistory->jobHistoryApplications()->forceDelete();
			$jobHistory->jobHistoryBookmarks()->forceDelete();
			$jobHistory->jobHistoryView()->forceDelete();
			$jobHistory->forceDelete();
		});
		$tickets = $recruiter->tickets()->withTrashed()->get();
		$tickets->each(function($ticket) {
			$ticket->ticketMessages()->forceDelete();
			$ticket->forceDelete();
		});
		$jobs->each(function($job) {
			DB::table('job_job_qualification')->where('job_id', $job->id)->delete();
			$job->jobSkills()->forceDelete();
			$job->bookmarkedJobs()->forceDelete();
			$job->jobUpdateLogs()->forceDelete();
			$job->jobViewHistories()->forceDelete();
			$job->jobReports()->forceDelete();
			$job->jobPaymentTransactions()->forceDelete();
			$job->jobApplications()->forceDelete();
			$job->forceDelete();
		});
		$deleteRecruiter = $recruiter->forceDelete();

		if($deleteRecruiter) {
			$res['success'] = 1;
			return json_encode($res);
		}
		else {
			$res['success'] = 0;
			$res['message'] = "Something went wrong! Please try again.";
			return json_encode($res);
		}
	}

	/**
	 * This function is used to Show Job Seekers Listing
	*/
	public function deleteRecruiter(Request $request) {
		$recruiter = Recruiter::find($request->id);
		$recruiter->feedbacks()->delete();
		$recruiter->socialLogins()->delete();
		
		$jobs = Job::where('recruiter_id', $request->id)->get();
		$jobHistories = $recruiter->jobHistories()->get();
		$jobHistories->each(function($jobHistory) {
			$jobHistory->jobHistoryApplications()->delete();
			$jobHistory->jobHistoryBookmarks()->delete();
			$jobHistory->jobHistoryView()->delete();
			$jobHistory->delete();
		});
		$recruiter->tickets->each(function($ticket) {
			$ticket->ticketMessages()->delete();
			$ticket->delete();
		});
		$jobs->each(function($job) {
			DB::table('job_job_qualification')->where('job_id', $job->id)->update(['deleted_at' => Carbon::now()]);
			$job->jobSkills()->delete();
			$job->bookmarkedJobs()->delete();
			$job->jobUpdateLogs()->delete();
			$job->jobViewHistories()->delete();
			$job->jobReports()->delete();
			$job->jobPaymentTransactions()->delete();
			$job->jobApplications()->delete();
			$job->delete();
		});
		$deleteRecruiter = $recruiter->delete();

		if($deleteRecruiter) {
			$res['success'] = 1;
			return json_encode($res);
		}
		else {
			$res['success'] = 0;
			$res['message'] = "Something went wrong! Please try again.";
			return json_encode($res);
		}
	}

	/**
	 * This function is used to Show Saved Jobs Listing
	*/
	public function deletedRecruitersList() {
		if(Auth::user()->can('manage_recycle_bin_recruiters')) {
			$deletedRecruiters = Recruiter::onlyTrashed()->orderBy('email')->get();
			return view('recruiters/deleted_recruiters_list', ['deletedRecruiters' => $deletedRecruiters]);
		}
		else {
			return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
		}
	}

	/**
	 * This function is used to Show Saved Jobs Listing
	*/
	public function restoreRecruiter(Request $request) {
		$recruiter = Recruiter::where('id', $request->id)->onlyTrashed()->first();
		$restoreRecruiter = $recruiter->restore();
		$recruiter->feedbacks()->restore();
		$recruiter->socialLogins()->restore();
		
		$jobs = Job::where('recruiter_id', $request->id)->withTrashed()->get();
		$jobHistories = $recruiter->jobHistories()->withTrashed()->get();
		$jobHistories->each(function($jobHistory) {
			$jobHistory->restore();
			$jobHistory->jobHistoryApplications()->restore();
			$jobHistory->jobHistoryBookmarks()->restore();
			$jobHistory->jobHistoryView()->restore();
		});
		$tickets = $recruiter->tickets()->withTrashed()->get();
		$tickets->each(function($ticket) {
			$ticket->restore();
			$ticket->ticketMessages()->restore();
		});
		$jobs->each(function($job) {
			DB::table('job_job_qualification')->where('job_id', $job->id)->update(['deleted_at' => null]);
			$job->restore();
			$job->jobSkills()->restore();
			$job->bookmarkedJobs()->restore();
			$job->jobUpdateLogs()->restore();
			$job->jobViewHistories()->restore();
			$job->jobReports()->restore();
			$job->jobPaymentTransactions()->restore();
			$job->jobApplications()->restore();
		});

		if($restoreRecruiter) {
			$res['success'] = 1;
			return json_encode($res);
		}
		else {
			$res['success'] = 0;
			return json_encode($res);
		}
	}

	/**
	 * This function is used to Show Saved Jobs Listing
	*/
	/* public function addRecruiter() {
		if(Auth::user()->can('add_recruiter')) {
			$companies = organization::where('is_whitelisted', 1)->where('deleted_at', NULL)->orderBy('name')->get();
			return view('recruiters/add_recruiter', ['companies' => $companies]);
		}
		else {
			return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
		}
	} */

	/**
	 * This function is used to Show Saved Jobs Listing
	*/
	/* public function saveRecruiter(Request $request) {
		$validatedData = $request->validate([
			'first_name' => 'required',
			'last_name' => 'required',
			'email' => 'required|email|unique:organizations',
			'password' => 'required',
		], [
			'first_name.required' => 'First Name is required',
			'last_name.required' => 'Last Name is required',
			'email.required' => 'Email is required',
			'email.email' => 'Email is not valid',
			'email.unique' => 'Email must be unique',
			'password.required' => 'password is required',
		]);
		$recruiter = new Recruiter;
		$recruiter->name = $request->first_name.' '.$request->last_name;
		$recruiter->first_name = $request->first_name;
		$recruiter->last_name = $request->last_name;
		$recruiter->phone_number = $request->phone_number;
		$recruiter->email = $request->email;
		$recruiter->password = Hash::make($request->password);
		$recruiter->organization_id = $request->organization_id;
		$recruiter->ip_address = $_SERVER["REMOTE_ADDR"];
		$recruiter->is_parent = 0;
		if($recruiter->save()) {$customers = Organization::where('is_whitelisted', 1)->get();
			$recruitersList = [];
			if($customers->isNotEmpty()) {
				for ($i=0; $i < count($customers); $i++) {
					$recruiter = Recruiter::where('organization_id', $customers[$i]->id)->get();
					if($recruiter->isNotEmpty()) {
						array_push($recruitersList, $recruiter[0]);
					}
				}
			}
			return redirect()->route('recruiters_list', ['recruitersList' => $recruitersList])->with('success', 'Recruiter added successfully.');
		}
		else {
			return back()->with('error', 'Something went wrong! Please try again.');
		}
	} */
}
