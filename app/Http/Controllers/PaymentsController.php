<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentTransaction;
use App\Models\JobPaymentTransaction;
use App\Models\Organization;
use App\Models\Recruiter;
use Auth;

class PaymentsController extends Controller {

	/**
	 * This function is used to Show Payments Transactions
	*/
	public function paymentTransactionsList(Request $request) {

		if(Auth::user()->can('view_payment_transaction')) {
			$paymentTransactionsList = JobPaymentTransaction::orderByDesc('created_at')->get();
			
			return view('payments/payment_transactions_list', [ 'paymentTransactionsList' => $paymentTransactionsList ]);
		}
		else {
			return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
		}
	}

	/**
	 * This function is used to View Payment Transaction
	*/
	public function viewPaymentTransaction($id) {
		if(Auth::user()->can('view_payment_transaction')) {
			$paymentTransaction = JobPaymentTransaction::find($id);
			$organization = Organization::find($paymentTransaction->organization_id);
			$recruiter = Recruiter::find($paymentTransaction->recruiter_id);
			return view('payments/view_payment_transaction', [
				'paymentTransaction' => $paymentTransaction,
				'organization' => $organization,
				'recruiter' => $recruiter,
			]);
		}
		else {
			return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
		}
	}
}
