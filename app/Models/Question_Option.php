<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question_Option extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'question_option';
    protected $fillable = [
      'question_id',
      'option_value',
      'is_correct'
    ];
}
