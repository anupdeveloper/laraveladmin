<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\JobPaymentTransaction;
use Illuminate\Support\Collection;

class PaymentLogs implements FromCollection {
	protected $date_range;

	/**
	 * 
	 *
	 * @return void
	*/
	public function __construct($date_range) {
		$this->date_range = $date_range;
	}

	/**
	 * @return \Illuminate\Support\Collection
	*/
	public function collection() {
		if ($this->date_range == null) {
			$data = JobPaymentTransaction::all();
			$data = JobPaymentTransaction::select('id','txn_id',\DB::raw('DATE_FORMAT(CAST(created_at AS DATE),"%d/%m/%Y")'),'sub_total',\DB::raw('sub_total as taxable'),'vat_percentage','vat','amount','status','description')->get();
		}
		else {
			$date_range_array = explode(' - ',$this->date_range);
			$from = \Carbon\Carbon::parse($date_range_array[0]);
			$to = \Carbon\Carbon::parse($date_range_array[1]);
			$data = JobPaymentTransaction::select('id','txn_id',\DB::raw('DATE_FORMAT(CAST(created_at AS DATE),"%d/%m/%Y")'),'sub_total',\DB::raw('sub_total as taxable'),'vat_percentage','vat','amount','status','description')->whereDate('created_at','>=', $from)->whereDate('created_at','<=', $to)->get();
		}
		return new Collection([
			['id','Transaction No','Invoice date','Sub Total (£)','Taxable amount (£)','VAT (%)','Total VAT','Total amount (£)','status','description'], $data
		]);
	}

}
