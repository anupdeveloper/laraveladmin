<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobApplication extends Model {
	use HasFactory, SoftDeletes;

	public function user() {
		return $this->belongsToMany(User::class, 'id', 'applicant_id');
	}
}
