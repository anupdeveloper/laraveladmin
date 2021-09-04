<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobPaymentTransaction extends Model {
	use HasFactory, SoftDeletes;

	public function organization() {
		return $this->belongsTo(Organization::class);
	}

	protected $fillable = [
		'txn_id',
	'amount',
	'status',
			'sub_total',
			'vat',
			'vat_percentage',
	'description',
	'request',
	'response',
	'recruiter_id',
			'job_id',
			'organization_id',
			'invoice'
	];

	public function job() {
		return $this->belongsTo(Job::class);
	}

}
