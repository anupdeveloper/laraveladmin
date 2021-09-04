<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
  		'name',
  		'school_id',
  		'course_id',
  		'desc',
  		'duration',
  		'status'
    ];

    public function get_school_detail(){
      return $this->hasMany('App\Models\School','id','school_id');
    }

    public function get_course_detail(){
      return $this->hasMany('App\Models\Course','id','course_id');
    }
}
