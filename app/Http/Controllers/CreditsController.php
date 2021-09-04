<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organization;
use App\Models\OrganizationCredit;
use App\Models\OrganizationCreditDetail;
use App\Models\Recruiter;
use App\Models\Admin;
use Auth;

class CreditsController extends Controller {
	
	/**
	 * This function is used to Show Company Credits List
	*/
	public function companyCreditsList(Request $request) {
		if(Auth::user()->can('manage_credits')) {
			$companyCreditsList = OrganizationCredit::orderByDesc('id')->get();
			return view('company_credits/credits_list', [ 'companyCreditsList' => $companyCreditsList ]);
		}
		else {
			return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
		}
	}
	
	/**
	 * This function is used to Show Add Company Credit Page
	*/
	public function addCompanyCredit() {
		if(Auth::user()->can('add_company_credit')) {
			$organizations = Organization::all();
			return view('company_credits/add_credit', [ 'organizations' => $organizations]);
		}
		else {
			return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
		}
	}
	
	/**
	 * This function is used to Save Company Credit
	*/
	public function saveCompanyCredit(Request $request) {
		$organizationId = $request->organization_id;
		$validatedData = $request->validate([
			'total_paid_credits' => 'required',
			// 'txn_type' => 'required',
			'credit_type' => 'required',
			'organization_id' => 'required'
		], [
			'total_paid_credits.required' => 'Credit Amount is required',
			// 'txn_type.required' => 'Transaction Type is required',
			'credit_type.required' => 'Credit Type is required',
			'organization_id.required' => 'Company is required'
		]);
		$recruiter = Recruiter::where('organization_id', $organizationId)->where('is_parent', 1)->get();
		$recruiterId = $recruiter[0]->id;
		$creditsAvailable = OrganizationCredit::where('organization_id', $organizationId)->get();
		if($creditsAvailable->isNotEmpty()) {
			$newcredits = $creditsAvailable[0]->total_paid_credits+$request->total_paid_credits;
			$creditUpdate = OrganizationCredit::where('organization_id', $organizationId)->update([
				'total_paid_credits' => $newcredits
			]);
			if($creditUpdate) {
				$updatedCredit = OrganizationCredit::where('organization_id', $organizationId)->get();
				$creditDetail = new OrganizationCreditDetail;
				$creditDetail->txn_type = $request->txn_type;
				$creditDetail->credits = $request->total_paid_credits;
				$creditDetail->credit_type = $request->credit_type;
				$creditDetail->organization_id = $organizationId;
				$creditDetail->organization_credit_id = $updatedCredit[0]->id;
				$creditDetail->admin_id = Auth::id();
				if($creditDetail->save()) {
					$companyCreditsList = Organization::all();
					return redirect()->route('company_credits_list', [ 'companyCreditsList' => $companyCreditsList ])->with('success', 'Company Credits Added Successfully!');
				}
				else {
					return back()->with('error', 'Something went wrong!');
				}
			}
			else {
				return back()->with('error', 'Something went wrong!');
			}
		}
		else {
			$credit = new OrganizationCredit;
			$credit->total_paid_credits = $request->total_paid_credits;
			$credit->organization_id = $organizationId;
			$credit->recruiter_id = $recruiterId;
			if($credit->save()) {
				$creditDetail = new OrganizationCreditDetail;
				$creditDetail->txn_type = $request->txn_type;
				$creditDetail->credits = $request->total_paid_credits;
				$creditDetail->credit_type = $request->credit_type;
				$creditDetail->organization_id = $organizationId;
				$creditDetail->organization_credit_id = $credit->id;
				if($creditDetail->save()) {
					$companyCreditsList = Organization::all();
					return redirect()->route('company_credits_list', [ 'companyCreditsList' => $companyCreditsList ])->with('success', 'Company Credits Added Successfully!');
				}
				else {
					return back()->with('error', 'Something went wrong!');
				}
			}
			else {
				return back()->with('error', 'Something went wrong!');
			}
		}
	}
	
	/**
	 * This function is used to View Company Credit
	*/
	public function viewCompanyCredit($id) {
		if(Auth::user()->can('view_company_credit')) {
			$companyCredits = OrganizationCredit::find($id);
			$companyCreditDetails = OrganizationCreditDetail::where('organization_id', $companyCredits->organization_id)->get();
			$company = Organization::where('id', $companyCredits->id)->get();
			$recruiter = Recruiter::find($companyCreditDetails[0]->recruiter_id);
			return view('company_credits/view_credit', [
				'companyCredits' => $companyCredits,
				'company' => $company,
				'recruiter' => $recruiter
			]);
		}
		else {
			return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
		}
	}

	/**
	 * This function is used to Show Credits history
	*/
	public function creditsHistory(Request $request) {
		if(Auth::user()->can('view_credits_history')) {
			$creditsHistory = OrganizationCreditDetail::orderByDesc('id')->get();
			return view('company_credits/credits_history', [ 'creditsHistory' => $creditsHistory ]);
		}
		else {
			return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
		}
	}
	
	/**
	 * This function is used to View Credit History
	*/
	public function viewCreditHistory($id) {
		if(Auth::user()->can('view_credits_history')) {
			$viewCreditHistory = OrganizationCreditDetail::find($id);
			$companyName = Organization::where('id', $viewCreditHistory->id)->get();
			$recruiter = Recruiter::find($viewCreditHistory->recruiter_id);
			$admin = Admin::find($viewCreditHistory->admin_id);
			return view('company_credits/view_credit_history', [
				'viewCreditHistory' => $viewCreditHistory,
				'companyName' => $companyName,
				'recruiter' => $recruiter,
				'admin' => $admin
			]);
		}
		else {
			return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
		}
	}

}
