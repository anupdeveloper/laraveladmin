<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobHistoryApplication extends Model {
	use HasFactory, SoftDeletes;

	protected $fillable = ['applicant_id', 'applicant_type'];

	public function jobHistory() {
		return $this->belongsTo(JobHistory::class);
	}

	public function applicant() {
		return $this->morphTo();
	}

	public function user() {
		return $this->belongsToMany(User::class, 'id', 'applicant_id');
	}
}
