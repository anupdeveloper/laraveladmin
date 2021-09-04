<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lecture extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
      'course_id','lecture_name','lecture_no','lecture_date','created_by','status'
    ];

    public function get_course_detail(){
      return $this->belongsTo('\App\Models\Course','course_id','id');
    }
}
