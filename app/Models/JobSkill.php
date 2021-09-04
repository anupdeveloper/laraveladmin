<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobSkill extends Pivot {

	use HasFactory, SoftDeletes;
	
	/**
	 * The job that belong to the skill.
	*/
	public function jobs() {
		return $this->belongsToMany(Job::class);
	}

}
