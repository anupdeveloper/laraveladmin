<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Recruiter;
use App\Models\Admin;
use App\Models\Page;
use App\Models\Role;
use App\Models\Organization;
use App\Models\UserSocialLogin;
use App\Models\Job;
use App\Models\Guest;
use App\Models\JobPaymentTransaction;
use App\Models\Ticket;
use App\Models\Feedback;
use App\Models\ContactUs;
use Auth;
use Hash;

class AdminController extends Controller
{
	/**
	 * This function is used to Show Admin Dashboard
	*/
	public function dashboard(Request $request) {
		$jobseekers = User::all();
		$jobseekersCount = count($jobseekers);
		$guests = Guest::all();
		$guestsCount = count($guests);
		$payments = JobPaymentTransaction::all();
		$paymentsCount = count($payments);
		$pages = Page::all();
		$pagesCount = count($pages);
		$customers = Organization::where('is_whitelisted', 1)->get();
		$recruitersList = [];
		$allRecruiters = Recruiter::all();
		$allCustomers = Organization::all();
		for ($i=0; $i < count($allRecruiters); $i++) {
			for ($j=0; $j < count($allCustomers); $j++) {
				if($allCustomers[$j]->is_whitelisted == '1') {
					array_push($recruitersList, $allRecruiters[$i]);
				}
			}
		}
		$recruitersCount = count($recruitersList);
		$customers = Organization::where('is_whitelisted', 1)->get();
		$customersCount = count($customers);
		$admins = Admin::where('role_id', '!=', 1)->where('id', '!=', Auth::id())->get();
		$adminsCount = count($admins);
		$jobs = Job::all();
		$jobsCount = count($jobs);
		$tickets = Ticket::all();
		$feedback = Feedback::all();
		$contactUs = ContactUs::all();
		$feedbacksCount = count($tickets)+count($feedback)+count($contactUs);
		return view('dashboard', [
			'jobseekersCount' => $jobseekersCount,
			'guestsCount' => $guestsCount,
			'recruitersCount' => $recruitersCount,
			'customersCount' => $customersCount,
			'adminsCount' => $adminsCount,
			'jobsCount' => $jobsCount,
			'paymentsCount' => $paymentsCount,
			'pagesCount' => $pagesCount,
			'feedbacksCount' => $feedbacksCount,
		]);
	}

	/**
	 * This function is used to Show Admin Profile
	*/
	public function adminProfile(Request $request) {
		$userDetails = Admin::findOrFail(Auth::id());
		return view('admin_profile')->with('userDetails', $userDetails );
	}

	/**
	 * This function is used to Update Admin Profile
	*/
	public function updateProfile(Request $request) {
		$validatedData = $request->validate([
			'name' => 'required',
		], [
			'name.required' => 'Name is required',
		]);
		$updateProfile = Admin::where('id', $request->id)->update(['name' => $request->name]);
		if($updateProfile) {
			return back()->with('success', 'Profile Updated Successfully!');
		}
		else {
			return back()->with('error', 'Something went wrong! Please try again later.');
		}
	}

	public function checkPassword(Request $request) {
		$passwordType = $request['password_type'];
		$admin = Admin::find(Auth::id());
		if($passwordType == 'old') {
			if(Hash::check($request->password, $admin->password) == false) {
				return true;
			}
			else if(Hash::check($request->password, $admin->password) == true) {
				return false;
			}
		}
		else if($passwordType == 'new') {
			if(Hash::check($request->password, $admin->password) == false) {
				return false;
			}
			else {
				return true;
			}
		} 
	}

	/**
	 * This function is used to Change Admin Password
	*/
	public function changePassword(Request $request) {
		$changePassword = Admin::where('id', Auth::id())->update(['password' => Hash::make($request->password)]);
		if($changePassword) {
			return back()->with('success', 'Password Updated Successfully!');
		}
		else {
			return back()->with('error', 'Something went wrong! Please try again later.');
		}
	}
}
