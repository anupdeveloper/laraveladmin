<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UkPlace extends Model
{
    use HasFactory;

    protected $appends = ['value'];


    public function getValueAttribute()
    {
    	
    	if (request()->has('type')) {
    		
    		return $this->place.', '.$this->county.', '.$this->country;
    	}
    	return $this->place;
    }

}
