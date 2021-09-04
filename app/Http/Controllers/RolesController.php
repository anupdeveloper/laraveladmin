<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Admin;
use Auth;

class RolesController extends Controller {
	/**
	 * This function is used to Show Saved Jobs Listing
	*/
	public function rolesList(Request $request) {
		if(Auth::user()->can('manage_roles')) {
			$roles = Role::orderBy('name')->where('id', '!=', 1)->get();
			return view('roles/roles_list', ['roles' => $roles]);
		}
		else {
			return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
		}
	}

	/**
	 * This function is used to Show Saved Jobs Listing
	*/
	public function viewRole($id) {
		if(Auth::user()->can('view_role')) {
			$role = Role::find($id);
			$permissions = \DB::table('permission_role')->where('role_id', $role->id)->get();
			return view('roles/view_role', [
				'role' => $role,
				'permissions' => $permissions,
			]);
		}
		else {
			return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
		}
	}

	/**
	 * This function is used to Show Saved Jobs Listing
	*/
	public function addRole(Request $request) {
		if(Auth::user()->can('add_role')) {
			return view('roles/add_role');
		}
		else {
			return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
		}
	}

	/**
	 * This function is used to Show Saved Jobs Listing
	*/
	public function saveRole(Request $request) {
		$nameToLowercase = strtolower($request->role_name);
		$roleTag = $name = str_replace(' ', '_', $nameToLowercase);
		$role = Role::where("tag", $roleTag)->get();
		if(count($role) <= 0) {
			$role = new Role;
			$role->name = $request->role_name;
			$role->tag = $roleTag;
			$role->status = 1;
			if($role->save()) {
				$roles = Role::where('id', '!=', 1)->get();
				return redirect()->route('roles_list', ['roles' => $roles])->with('success', 'Role Added successfully!');
			}
			else {
				return redirect()->back()->with('error', 'Something went wrong!');
			}
		}
		else {
			$roles = Role::where('id', '!=', 1)->get();
			return redirect()->route('roles_list', ['roles' => $roles])->with('error', 'The Role already exists! Please edit the Role if you want to make any changes.');
		}
	}

	/**
	 * This function is used to Show Saved Jobs Listing
	*/
	public function editRole($id) {
		if(Auth::user()->can('edit_role')) {
			$role = Role::find($id);
			return view('roles/edit_role', [
				'role' => $role
			]);
		}
		else {
			return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
		}
	}

	/**
	 * This function is used to Update Role
	*/
	public function updateRole(Request $request) {
		$updateRole = Role::where('id', $request->id)->update([
			'name' => $request->name
		]);
		if($updateRole) {
			$roles = Role::orderByDesc('id')->get();
			return redirect()->route('roles_list', ['roles' => $roles])->with('success', 'Role Updated successfully!');
		}

	}

	/**
	 * This function is used to Show Saved Jobs Listing
	*/
	public function getRolePermissions(Request $request) {
		$rolePermissions = \DB::table('permission_role')->where('role_id', $request->role_id)->get();
		return json_encode($rolePermissions);
	}

	/**
	 * This function is used to Show Saved Jobs Listing
	*/
	public function rolePermissions(Request $request) {
		if(Auth::user()->can('add_permissions')) {
			$roles = Role::orderBy('name')->where('id', '!=', 1)->get();
			if($roles->isNotEmpty()) {
				$pendingCustomersPermissions = Permission::where('module_slug', 'pending_customers')->get();
				$whitelistedCustomersPermissions = Permission::where('module_slug', 'whitelisted_customers')->get();
				$rejectedCustomersPermissions = Permission::where('module_slug', 'rejected_customers')->get();
				$recruitersPermissions = Permission::where('module_slug', 'recruiters')->get();
				$jobseekersPermissions = Permission::where('module_slug', 'jobseekers')->get();
				$adminsPermissions = Permission::where('module_slug', 'admins')->get();
				$jobsPermissions = Permission::where('module_slug', 'jobs')->get();
				$jobHistoryPermissions = Permission::where('module_slug', 'job_history')->get();
				$paymentTransactionsPermissions = Permission::where('module_slug', 'payment_transactions')->get();
				$ticketsPermissions = Permission::where('module_slug', 'tickets')->get();
				$jobIndustriesPermissions = Permission::where('module_slug', 'job_industries')->get();
				$jobQualificationsPermissions = Permission::where('module_slug', 'job_qualifications')->get();
				$jobLocationsPermissions = Permission::where('module_slug', 'job_locations')->get();
				$skillsPermissions = Permission::where('module_slug', 'skills')->get();
				$citiesPermissions = Permission::where('module_slug', 'cities')->get();
				$countiesPermissions = Permission::where('module_slug', 'counties')->get();
				$rolesPermissions = Permission::where('module_slug', 'roles')->get();
				$accessPermissions = Permission::where('module_slug', 'permissions')->get();
				$allRecyledPermissions = Permission::where('module_slug', 'recycle_bin')->get();
				$feedbacksPermissions = Permission::where('module_slug', 'feedback')->get();
				$contactUsPermissions = Permission::where('module_slug', 'contact_us')->get();
				$websitePagesPermissions = Permission::where('module_slug', 'website_pages')->get();
				$mobilePagesPermissions = Permission::where('module_slug', 'mobile_pages')->get();
				$jobBookmarksPermissions = Permission::where('module_slug', 'bookmarks')->get();
				$jobApplicationsPermissions = Permission::where('module_slug', 'job_applications')->get();
				$jobSearchHistoryPermissions = Permission::where('module_slug', 'job_search_history')->get();
				$reportedJobsPermissions = Permission::where('module_slug', 'reported_jobs')->get();
				$viewedJobsPermissions = Permission::where('module_slug', 'viewed_jobs')->get();
				$guestsPermissions = Permission::where('module_slug', 'guests')->get();
				$suspendedJobsPermissions = Permission::where('module_slug', 'suspended_jobs')->get();
				return view('roles/role_permissions', [
					'roles' => $roles,
					'pendingCustomersPermissions' => $pendingCustomersPermissions,
					'whitelistedCustomersPermissions' => $whitelistedCustomersPermissions,
					'rejectedCustomersPermissions' => $rejectedCustomersPermissions,
					'recruitersPermissions' => $recruitersPermissions,
					'jobseekersPermissions' => $jobseekersPermissions,
					'adminsPermissions' => $adminsPermissions,
					'jobsPermissions' => $jobsPermissions,
					'jobHistoryPermissions' => $jobHistoryPermissions,
					'paymentTransactionsPermissions' => $paymentTransactionsPermissions,
					'ticketsPermissions' => $ticketsPermissions,
					'jobIndustriesPermissions' => $jobIndustriesPermissions,
					'jobQualificationsPermissions' => $jobQualificationsPermissions,
					'jobLocationsPermissions' => $jobLocationsPermissions,
					'skillsPermissions' => $skillsPermissions,
					'citiesPermissions' => $citiesPermissions,
					'countiesPermissions' => $countiesPermissions,
					'rolesPermissions' => $rolesPermissions,
					'accessPermissions' => $accessPermissions,
					'allRecyledPermissions' => $allRecyledPermissions,
					'feedbacksPermissions' => $feedbacksPermissions,
					'contactUsPermissions' => $contactUsPermissions,
					'websitePagesPermissions' => $websitePagesPermissions,
					'mobilePagesPermissions' => $mobilePagesPermissions,
					'jobBookmarksPermissions' => $jobBookmarksPermissions,
					'jobApplicationsPermissions' => $jobApplicationsPermissions,
					'jobSearchHistoryPermissions' => $jobSearchHistoryPermissions,
					'reportedJobsPermissions' => $reportedJobsPermissions,
					'viewedJobsPermissions' => $viewedJobsPermissions,
					'guestsPermissions' => $guestsPermissions,
					'suspendedJobsPermissions' => $suspendedJobsPermissions,
				]);
			}
			else {
				return redirect()->route('add_role')->with('warning', 'No Roles Found! Please add a Role first.');
			}
		}
		else {
			return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
		}
	}

	/**
	 * This function is used to Show Saved Jobs Listing
	*/
	public function saveRolePermissions(Request $request) {
		$role = Role::find($request->role_id);
		$updatePermissions = $role->permissions()->sync($request->permissions);
		if($updatePermissions) {
			$roles = Role::where('id', '!=', 1)->get();
			return back()->with('success', 'Role Permissions Added successfully!');
		}
		else {
			return redirect()->back()->with('error', 'Something went wrong!');
		}
	}

	/**
	 * This function is used to Permanent Delete Role
	*/
	public function permanentDeleteRole(Request $request) {
		$role = Role::where('id', $request->id)->onlyTrashed()->first();
		$role->permissionRoles()->forceDelete();
		$role->admins()->forceDelete();
		$deleteRole = $role->forceDelete();
		if($deleteRole) {
			$res['success'] = 1;
			return json_encode($res);
		}
		else {
			$res['success'] = 0;
			$res['message'] = "Something went wrong! Please try again.";
			return json_encode($res);
		}
	}

	/**
	 * This function is used to Show Saved Jobs Listing
	*/
	public function deleteRole(Request $request) {
		$admin = Admin::where('role_id', $request->id)->first();
		if($admin != null) {
			$res['success'] = 0;
			$res['message'] = "You cannot delete this record as it's being used.";
			return json_encode($res);
		}
		else {
			$role = Role::where('id', $request->id)->first();
			$role->permissionRoles()->delete();
			$role->admins()->delete();
			$deleteRole = $role->delete();
			if($deleteRole) {
				$res['success'] = 1;
				return json_encode($res);
			}
			else {
				$res['success'] = 0;
				$res['message'] = "Something went wrong! Please try again.";
				return json_encode($res);
			}
		}
	}

	/**
	 * This function is used to Show deleted Roles
	*/
	public function deletedRoles() {
		if(Auth::user()->can('manage_recycle_bin_roles')) {
			$deletedRoles = Role::onlyTrashed()->orderByDesc('id')->get();
			return view('roles/deleted_roles_list', ['deletedRoles' => $deletedRoles]);
		}
		else {
			return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
		}
	}

	/**
	 * This function is used to Restore Roles
	*/
	public function restoreRole(Request $request) {
		$role = Role::where('id', $request->id)->onlyTrashed()->first();
		$role->permissionRoles()->restore();
		$role->admins()->restore();
		$restoreRole = $role->restore();
		if($restoreRole) {
			$res['success'] = 1;
			return json_encode($res);
		}
		else {
			$res['success'] = 0;
			$res['message'] = "Something went wrong! Please try again.";
			return json_encode($res);
		}
	}

	public function getAllPermissions(Request $request) {
		$permissions = Permission::orderBy('name')->get();
		for ($i=0; $i < count($permissions); $i++) { 
			echo $permissions[$i]->id.' : '.$permissions[$i]->slug."<br>";
			echo "\n";
		}
	}

	public function getUserPermissions(Request $request) {
		$user = $request->user();
		$permissions = $user->role->permissions;
		for ($i=0; $i < count($permissions); $i++) { 
			echo $permissions[$i]->id.' : '.$permissions[$i]->slug."<br>";
			echo "\n";
		}
	}
}
