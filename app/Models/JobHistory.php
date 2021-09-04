<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobHistory extends Model
{
    use HasFactory, SoftDeletes;

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
		'company_logo'
	];

    /**
     * The roles that belong to the user.
     */
    public function skills()
    {
        return $this->belongsToMany(Skill::class,'job_skill','job_id','skill_id');
    }

    public function jobHistoryBookmarks()
    {
        return $this->hasMany(JobHistoryBookmark::class);
    }

    public function jobHistoryApplications()
    {
        return $this->hasMany(JobHistoryApplication::class);
    }

    public function jobHistoryView()
    {
        return $this->hasOne(JobHistoryView::class);
    }

        /**
     * Get the organization for the user.
     */
    public function bookmarkedUsers()
    {
        return $this->belongsToMany(User::class,'job_history_bookmarks');
    }

        /**
     * Job seacrh history for a perticular user.
     */
    public function userViewed()
    {
        return $this->belongsToMany(User::class,'job_history_views')->withTimestamps();
    }
}
