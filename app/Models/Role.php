<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
	use HasFactory, SoftDeletes;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	*/
	protected $fillable = [ 'name', 'status' ];

	/**
	 * Get the permissions for the role.
	*/
	public function permissions() {
		return $this->belongsToMany(Permission::class);
	}

	/**
	 * Get the admins for the role.
	*/
	public function admins() {
		return $this->hasMany(Admin::class);
	}

	/**
	 * Get the admins for the role.
	*/
	public function permissionRoles() {
		return $this->hasMany(PermissionRole::class);
	}
}
