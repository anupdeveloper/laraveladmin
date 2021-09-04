<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobSearchHistory extends Model {

    use HasFactory, SoftDeletes;
	
		protected $casts = [
			'industry' => 'array',
			'job_type' => 'array',
    ];
}
