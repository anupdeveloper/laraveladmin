<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organization;
use App\Models\Recruiter;
use App\Models\Country;
use App\Models\Admin;
use App\Notifications\VerifyUser;
use Notification;
use Mail;
use DB;
use Auth;
use Illuminate\Support\Facades\Gate;
use \Carbon\Carbon;

class OrganizationsController extends Controller {
	
	/**
	 * This function is used to Check if the email exists in the table
	*/
	public function checkEmail() {
		$tableName = $_GET['table_name'];
		if(isset($_GET['id'])) {
			$emailExists = DB::table($tableName)->where('email', $_GET['email'])->where('id', '!=', $_GET['id'])->get();
			if ($emailExists->isNotEmpty()) {
				return true;
			}
			else {
				return false;
			}
			exit;
		}
		else {
			$emailExists = DB::table($tableName)->where('email', $_GET['email'])->get();
			if ($emailExists->isNotEmpty()) {
				return true;
			}
			else {
				return false;
			}
			exit;
		}
	}
	
	/**
	 * This function is used to Show Add Job Seeker View
	*/
	public function addCustomer() {
		if(Auth::user()->can('add_customer')) {
			$countries = Country::orderBy('name')->get();
			$cities = \DB::table('cities')->orderBy('city')->get();
			$counties = \DB::table('counties')->orderBy('county')->get();
			return view('customers/add_customer', [
				'countries' => $countries,
				'cities' => $cities,
				'counties' => $counties,
			]);
		}
		else {
			return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
		}
	}

	/**
	 * This function is used to Save Customer
	*/
	public function saveCustomer(Request $request) {
		$validatedData = $request->validate([
			'address' => 'required',
			'name' => 'required',
			'email' => 'required|email|unique:organizations',
			'country_code' => 'required',
			'state' => 'required',
			'pincode' => 'required',
			'contact_number' => 'required',
			'url' => 'required',
		], [
			'address.required' => 'Address is required',
			'name.required' => 'Company Name is required',
			'email.required' => 'Company Or Consultants Email is required',
			'email.email' => 'Company Or Consultants Email is not valid',
			'email.unique' => 'Company Or Consultants Email must be unique',
			'country_code.required' => 'Country Code is required',
			'state.required' => 'State is required',
			'pincode.required' => 'Zip / Postcode is required',
			'contact_number.required' => 'Contact Number is required',
			'url.required' => 'Company Domain URL is required',
		]);
		$customer = new Organization;
		$customer->name = $request->first_name.$request->name;
		$customer->email = $request->email;
		$customer->country_code = $request->country_code;
		$customer->contact_number = $request->contact_number;
		$customer->vat_number = $request->vat_number;
		$customer->url = $request->url;
		$customer->domain = parse_url($request->url)['host'];
		$customer->address = $request->address;
		$customer->city = $request->city;
		$customer->state = $request->state;
		$customer->pincode = $request->pincode;
		$customer->country = $request->country;
		$customer->county = $request->county;
		if($customer->save()) {
			$recruiter = new Recruiter;
			$recruiter->email = $customer->email;
			$recruiter->organization_id = $customer->id;
			$recruiter->ip_address = $_SERVER["REMOTE_ADDR"];
			if($recruiter->save()) {
				$pendingCustomersList = Organization::where('is_whitelisted', 0)->get();
				return redirect()->route('pending_customers')->with('success', 'Customer added successfully. Please approve to allow Application Access.');
			}
			else {
				return back()->with('error', 'Something went wrong! Please try again.');
			}
		}
		else {
			return back()->with('error', 'Something went wrong! Please try again.');
		}
	}

	/**
	 * This function is used to Show Listing
	*/
	public function viewCustomer($from_page, $id) {
		if(Auth::user()->can('view_pending_customer') || 
			 Auth::user()->can('view_whitelisted_customer') || 
			 Auth::user()->can('view_rejected_customer')
			) {
			$viewCustomer = Organization::find($id);
			if($viewCustomer->created_by == 'admin') {
				$creator = Admin::find($viewCustomer->created_by_id);
			}
			else {
				$creator = Recruiter::find($viewCustomer->created_by_id);
			}
			return view('customers/view_customers')->with([
				'viewCustomer' => $viewCustomer,
				'creator' => $creator,
			]);
		}
		else {
			return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
		}
	}

	/**
	 * This function is used to Show Listing
	*/
	public function pendingCustomersList(Request $request) {
		if(Auth::user()->can('manage_pending_customers')) {
			$pendingCustomersList = Organization::orderBy('name')->where('is_whitelisted', 0)->get();
			return view('customers/pending_customers')->with('pendingCustomersList', $pendingCustomersList);
		}
		else {
			return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
		}
	}

	/**
	 * This function is used to Show Listing
	*/
	public function whitelistedCustomersList(Request $request) {
		if(Auth::user()->can('manage_whitelisted_customers')) {
			$whitelistedCustomersList = Organization::orderBy('name')->where('is_whitelisted', 1)->get();
			return view('customers/whitelisted_customers')->with('whitelistedCustomersList', $whitelistedCustomersList);
		}
		else {
			return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
		}
	}

	/**
	 * This function is used to Show Listing
	*/
	public function rejectedCustomersList(Request $request) {
		if(Auth::user()->can('manage_rejected_customers')) {
			$rejectedCustomersList = Organization::orderBy('name')->where('is_whitelisted', 2)->get();
			return view('customers/rejected_customers')->with('rejectedCustomersList', $rejectedCustomersList);
		}
		else {
			return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
		}
	}

	/**
	 * This function is used to Show Job Seekers Listing
	*/
	public function whitelistCustomer($id) {
		$customerId = $id;
		$whitelistCustomer = Organization::where('id', $customerId)->update(['is_whitelisted' => '1']);
		if($whitelistCustomer) {
			$customer = Organization::find($customerId);
			$random_pass = uniqid();
			$username = $customer->first_name ? $customer->first_name : $customer->email;
			$websiteLink = config("adminlte.email_verify_url").$random_pass;
			$appLink = config("adminlte.email_verify_url_mobile").$random_pass;
			$updateRecruiter = Recruiter::where('email', $customer->email)->update(['signup_token' => $random_pass]);
			if($updateRecruiter) {
				Notification::route('mail', $customer->email)->notify(new VerifyUser($username, $websiteLink, $appLink));
				$whitelistedCustomersList = Organization::where('is_whitelisted', 1)->get();
				return redirect()->route('whitelisted_customers', ['whitelistedCustomersList' => $whitelistedCustomersList])->with('success', 'Customer Whitelisted Successfully!');
			}
			else {
				return back()->with('warning', 'Something went wrong!');
			}
		}
		else {
			return back()->with('error', 'Something went wrong! Please try again.');
		}
	}

	/**
	 * This function is used to Show Job Seekers Listing
	*/
	public function rejectCustomer($id) {
		$customerId = $id;
		$rejectCustomer = Organization::where('id', $customerId)->update(['is_whitelisted' => '2']);
		if($rejectCustomer) {
			$rejectedCustomersList = Organization::where('is_whitelisted', 2)->get();
			return redirect()->route('rejected_customers', ['rejectedCustomersList' => $rejectedCustomersList])->with('success', 'Customer Rejected Successfully!');
		}
		else {
			return back()->with('error', 'Something went wrong! Please try again.');
		}
	}

	/**
	 * This function is used to Show Job Seekers Listing
	*/
	public function deleteCustomers(Request $request) {
		$customer = Organization::find($request->id);
		$recruiters = $customer->recruiters()->get();
		$recruiters->each(function($recruiter) {
			$recruiter->feedbacks()->delete();
			$recruiter->socialLogins()->delete();
		
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
			$jobs = $recruiter->jobs()->get();
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
			$recruiter->delete();
		});
		$customer->savedCards()->delete();
		$deleteCustomer = $customer->delete();

		if($deleteCustomer) {
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
	public function deletedCustomersList() {
		if(Auth::user()->can('manage_recycle_bin_customers')) {
			$deletedCustomers = Organization::onlyTrashed()->orderBy('name')->get();
			return view('customers/deleted_customers_list', ['deletedCustomers' => $deletedCustomers]);
		}
		else {
			return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
		}
	}

	/**
	 * This function is used to Show Job Seekers Listing
	*/
	public function restoreCustomer(Request $request) {
		$customer = Organization::where('id', $request->id)->onlyTrashed()->first();
		$restoreCustomer = $customer->restore();
		$recruiters = $customer->recruiters()->withTrashed()->get();
		$recruiters->each(function($recruiter) {
			$recruiter->restore();
			$recruiter->feedbacks()->restore();
			$recruiter->socialLogins()->restore();
		
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
			$jobs = $recruiter->jobs()->withTrashed()->get();
			$jobs->each(function($job) {
				$job->restore();
				DB::table('job_job_qualification')->where('job_id', $job->id)->update(['deleted_at' => null]);
				$job->jobSkills()->restore();
				$job->bookmarkedJobs()->restore();
				$job->jobUpdateLogs()->restore();
				$job->jobViewHistories()->restore();
				$job->jobReports()->restore();
				$job->jobPaymentTransactions()->restore();
				$job->jobApplications()->restore();
			});
		});
		$customer->savedCards()->restore();

		if($restoreCustomer) {
			$res['success'] = 1;
			return json_encode($res);
		}
		else {
			$res['success'] = 0;
			return json_encode($res);
		}
	}

	/**
	 * This function is used to Permanent Delete Recruiter
	*/
	public function permanentDeleteCustomer(Request $request) {
		$customer = Organization::where('id', $request->id)->onlyTrashed()->first();
		$recruiters = $customer->recruiters()->withTrashed()->get();
		$recruiters->each(function($recruiter) {
			$recruiter->feedbacks()->forceDelete();
			$recruiter->socialLogins()->forceDelete();
		
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
			$jobs = $recruiter->jobs()->withTrashed()->get();
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
			$recruiter->forceDelete();
		});
		$customer->savedCards()->forceDelete();
		$deleteCustomer = $customer->forceDelete();

		if($deleteCustomer) {
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
	public function editCustomer($from_page, $id) {
		if(Auth::user()->can('edit_pending_customer') || Auth::user()->can('edit_whitelisted_customer') || Auth::user()->can('edit_rejected_customer')) {
			$customer = Organization::find($id);
			$countries = Country::orderBy('name')->get();
			$cities = \DB::table('cities')->orderBy('city')->get();
			$counties = \DB::table('counties')->orderBy('county')->get();
			return view('customers/edit_customer', [
				'countries' => $countries,
				'customer' => $customer,
				'from_page' => $from_page,
				'cities' => $cities,
				'counties' => $counties,
			]);
		}
		else {
			return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
		}
	}

	/**
	 * This function is used to Show Job Seekers Listing
	*/
	public function updateCustomer(Request $request) {
		$validatedData = $request->validate([
			'address' => 'required',
			'city' => 'required',
			'pincode' => 'required',
			'state' => 'required',
			'country' => 'required',
			'name' => 'required',
			'email' => 'required|email',
			'country_code' => 'required',
			'contact_number' => 'required',
			'url' => 'required',
		], [
			'address.required' => 'Address is required',
			'city.required' => 'City is required',
			'pincode.required' => 'Zipcode is required',
			'state.required' => 'State is required',
			'country.required' => 'Country is required',
			'name.required' => 'Company Name is required',
			'email.required' => 'Company Or Consultants Email is required',
			'email.email' => 'Company Or Consultants Email is not valid',
			'country_code.required' => 'Country Code is required',
			'contact_number.required' => 'Contact Number is required',
			'url.required' => 'Company Domain URL is required',
		]);
		$dataToUpdate = [
			// 'name' => $request->name,
			// 'email' => $request->email,
			'country_code' => $request->country_code,
			'contact_number' => $request->contact_number,
			'vat_number' => $request->vat_number,
			'url' => $request->url,
			'domain' => parse_url($request->url)['host'],
			'address' => $request->address,
			'city' => $request->city,
			'state' => $request->state,
			'pincode' => $request->pincode,
			'country' => $request->country,
			'county' => $request->county
		];
		$updateCustomer = Organization::where('id', $request->id)->update($dataToUpdate);
		if($updateCustomer) {
			if($request->from_page == 'whitelisted') {
				$redirectTo = 'whitelisted_customers';
			}
			else if($request->from_page == 'rejected') {
				$redirectTo = 'rejected_customers';
			}
			else {
				$redirectTo = 'pending_customers';
			}
			$pendingCustomersList = Organization::where('is_whitelisted', 0)->get();
			return redirect()->route($redirectTo, ['pendingCustomersList' => $pendingCustomersList])->with('success', 'Cutomer Updated Successfully!');
		}
		else {
			return back()->with('error', 'Something went wrong! Please try again.');
		}
	}

	public function uploadLogoImage(Request $request) {
		$companyId = $request->companyId;
		$logo_image = $request->logo_image;

		$folderPath = $_SERVER['DOCUMENT_ROOT'].config('adminlte.logo_path');
		$imageParts = explode(";base64,", $logo_image);
		$imageTypeAux = explode("image/", $imageParts[0]);
		$imageType = $imageTypeAux[1];
		$imageBase64 = base64_decode($imageParts[1]);
		$fileName = uniqid().'.'.$imageType;
		$file = $folderPath.$fileName;
		file_put_contents($file, $imageBase64);

		$updateImage = Organization::where('id', $companyId)->update(['logo' => $fileName]);
		if($updateImage) {
			$res['success'] = 1;
			$res['image'] = $fileName;
			$response = [
				'success' => 1,
				'image' => $fileName,
			];
			return json_encode($response);
		}
		else {
			$res['success'] = 0;
			$res['image'] = "";
			$response = $res;
			return json_encode($response);
		}
	}

}
