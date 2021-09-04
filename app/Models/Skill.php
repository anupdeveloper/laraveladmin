<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Skill extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The users that belong to the role.
     */
    public function jobs()
    {
        return $this->belongsToMany(Job::class);
    }
}
