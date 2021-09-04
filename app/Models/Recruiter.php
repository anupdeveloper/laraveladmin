<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Jobs\QueuedVerifyEmailJob;
use App\Notifications\RecruiterResetPassword as ResetPasswordNotification;

class Recruiter extends Authenticatable implements MustVerifyEmail {
	use HasFactory, Notifiable, SoftDeletes;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	*/
	protected $fillable = [
		'name',
		'first_name',
		'last_name',
		'email',
		'password',
		'ip_address',
		'is_email_verified',
		'login_with',
		'organization_id',
		'signup_via'
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	*/
	protected $hidden = [
		'password',
		'remember_token',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	*/
	protected $casts = [
		'email_verified_at' => 'datetime',
		'last_logged_in_at' => 'datetime'
	];

	/**
	 * Get the organization for the recruiter.
	*/
	public function organization() {
		return $this->belongsTo(Organization::class);
	}

	/**
	 * Get the social logins for the user.
	*/
	public function socialLogins() {
		return $this->hasMany(RecruiterSocialLogin::class);
	}

	/**
	 * Get the social logins for the user.
	*/
	public function jobs() {
		return $this->hasMany(Job::class);
	}

	/**
	 * Get the social logins for the user.
	*/
	public function tickets() {
		return $this->hasMany(Ticket::class);
	}

	/**
	 * Get the social logins for the user.
	*/
	public function jobHistories() {
		return $this->hasMany(JobHistory::class);
	}

	/**
	 * Get the social logins for the user.
	*/
	public function feedbacks() {
		return $this->hasMany(Feedback::class);
	}

	public function jobPaymentTransactions() {
		return $this->hasMany(JobPaymentTransaction::class);
	}

	public function sendPasswordResetNotification($token) {
		// Your your own implementation.
		$this->notify(new ResetPasswordNotification($token));
	}
}
