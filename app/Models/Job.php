<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model {
	use HasFactory,SoftDeletes;

	protected $fillable = [
		'job_ref_number',
		'job_title',
		'job_description',
		'job_type',
		'is_featured',
		'job_address',
		'city',
		'county',
		'state',
		'country',
		'pincode',
		'latitude',
		'longitude',
		'job_industry_id',
		'job_function',
		'job_location_id',
		'package_range_from',
		'package_range_to',
		'salary_currency',
		'experience_range_min',
		'experience_range_max',
		'status',
		'recruiter_id',
		'organization_id',
		'created_by',
		'expiring_at',
		'job_url',
		'company_logo',
		'salary_type'
	];

	protected $appends = ['application_count'];
	/**
	 * Get the organization for the recruiter.
	*/
	public function recruiter() {
		return $this->belongsTo(Recruiter::class);
	}

	/**
	 * Get the organization for the recruiter.
	*/
	public function organization() {
		return $this->belongsTo(Organization::class);
	}

	/**
	 * The roles that belong to the user.
	*/
	public function skills() {
		return $this->belongsToMany(Skill::class);
	}
	
	/**
	 * Payment Transactions of a perticular job.
	*/
	public function jobPaymentTransactions() {
		return $this->hasMany(JobPaymentTransaction::class);
	}
	
	/**
	 * Job reports of a perticular job.
	*/
	public function jobReports() {
		return $this->hasMany(JobReport::class);
	}

	public function jobViewHistories() {
		return $this->hasMany(JobViewHistory::class);
	}

	public function jobHistories() {
		return $this->hasMany(JobHistory::class);
	}

	public function jobSkills() {
		return $this->hasMany(JobSkill::class);
	}

	public function bookmarkedJobs() {
		return $this->hasMany(BookmarkedJob::class);
	}
 
	public function jobApplications() {
		return $this->hasMany(JobApplication::class);
	}

	/**
	 * Get the organization for the user.
	*/
	public function bookmarkedUsers() {
		return $this->belongsToMany(User::class,'bookmarked_jobs');
	}

	/**
	 * Job seacrh history for a perticular user.
	*/
	public function userViewHistory() {
		return $this->belongsToMany(User::class,'job_view_histories')->withTimestamps();
	}

	/**
	 * The roles that belong to the user.
	*/
	public function jobQualifications() {
		return $this->belongsToMany(JobQualification::class);
	}

	/**
	 * costRequiredToPostJobExclVat
	*/
	public static function costRequiredToPostJobExclVat($id) {
		$job = self::find($id);
		if ($job->is_featured) {  
			$sub_total = $job->advert_days * 2;
		}
		else {
			$sub_total = $job->advert_days;
		}
		return $sub_total;
	}

	public function jobUpdateLogs()
    {
        return $this->hasMany(JobUpdateLog::class);
    }

    public function getApplicationCountAttribute()
    {
        return $this->jobApplications->count();
    }
}
