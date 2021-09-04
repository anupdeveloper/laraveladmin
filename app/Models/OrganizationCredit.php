<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrganizationCredit extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
		'total_paid_credits',
		'status',
		'trial_credits'
    ];

    protected $appends = ['total_credits'];

    public function organizationCreditDetails()
    {
    	return $this->hasMany(OrganizationCreditDetail::class);
    }

    public function getTotalCreditsAttribute()
    {
        return $this->total_paid_credits + $this->trial_credits;
    }
}
