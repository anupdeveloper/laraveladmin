<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobUpdateLog extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
    	"transaction_date",
    	"advert_start_date",
    	"advert_end_date",
    	"selected_days"
    ];
}
