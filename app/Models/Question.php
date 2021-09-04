<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory, SoftDeletes;

    protected $protected = [
      'category_id',
      'school_id',
      'course_id',
      'subject_id',
      'question_type',
      'name',
      'desc',
      'duration',
      'starts_on',
      'ends_on',
      'status',
      'created_by'
    ];

    public function get_school_name(){
      return $this->belongsTo('App\Models\School','school_id','id');
    }

    public function get_course_name(){
      return $this->belongsTo('App\Models\Course','course_id','id');
    }
}
