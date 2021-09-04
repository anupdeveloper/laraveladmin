<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RecruiterSocialLogin extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = ['provider_name', 'provider_id'];

    /**
     * Get the user for the social login.
     */
    public function recruiter()
	{
	    return $this->belongsTo(Recruiter::class);
	}
}
