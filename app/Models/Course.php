<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name','course_code','school_id','course_start_date','price','subject','status','created_by'
    ];

    public function get_school_detail(){
      return $this->hasMany('App\Models\School','id','school_id');
    }


    public function get_user_detail(){
      return $this->belongsTo('App\Models\User','created_by','id');
    }
}
