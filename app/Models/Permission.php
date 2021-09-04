<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model {
    use HasFactory, SoftDeletes;

    /**
     * The users that belong to the role.
     */
    public function roles() {
        return $this->belongsToMany(Role::class);
    }
}
