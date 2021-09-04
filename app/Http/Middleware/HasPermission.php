<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class HasPermission {
	/**
	 * Handle an incoming request.
	 *
	 * @param \Illuminate\Http\Request  $request
	 * @param \Closure  $next
	 * @return mixed
	*/
	public function handle(Request $request, Closure $next) {
		$user = $request->user();
		$permissions = $user->role->permissions;
		foreach($permissions as $permission) {
			if(!Auth::user()->can($permission->slug)) {
				return $next($request);
			}
			else {
				return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
			}
		}
	}
}
