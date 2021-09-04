<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrganizationCreditDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
		'txn_type',
		'credits',
		'credit_type',
		'status',
		'organization_id',
		'recruiter_id'
    ];
}
