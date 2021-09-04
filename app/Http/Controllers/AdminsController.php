<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Role;
use Auth;
use Illuminate\Support\Facades\Validator;
use Hash;

class AdminsController extends Controller {
	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	protected function validator(array $data) {
		return Validator::make($data, [
			'name' => ['required', 'string', 'max:255'],
			'email' => ['required', 'string', 'email', 'max:255', 'unique:recruiters'],
			'role' => ['required']
		]);
	}
	/**
	 * This function is used to Show Admins Listing
	*/
	public function adminsList(Request $request) {
		if(Auth::user()->can('manage_admins')) {
			$adminsList = Admin::where('role_id', '!=', 1)->where('id', '!=', Auth::id())->orderBy('email')->get();
			return view('admins/admins_list', ['adminsList' => $adminsList]);
		}
		else {
			return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
		}
	}

	/**
	 * This function is used to Show Admins Listing
	*/
	public function addAdmin(Request $request) {
		if(Auth::user()->can('add_admin')) {
			$roles = Role::orderBy('name')->where('id', '!=', 1)->get();
			return view('admins/add_admin', ['roles' => $roles]);
		}
		else {
			return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
		}
	}

	/**
	 * This function is used to Show Admins Listing
	*/
	public function saveAdmin(Request $request) {
		$validatedData = $request->validate([
			'name' => 'required',
			'email' => 'required|email|unique:admins',
			'role_id' => 'required',
			'password' => 'required',
		], [
			'name.required' => 'Name is required',
			'email.required' => 'Email is required',
			'email.email' => 'Email is not valid',
			'email.unique' => 'Email must be unique',
			'role_id.required' => 'Role is required',
			'password.required' => 'Password is required',
		]);
		$admin = new Admin;
		$admin->name = $request->name;
		$admin->email = $request->email;
		$admin->role_id = $request->role_id;
		$admin->password = Hash::make($request->password);
		if($admin->save()) {
			return redirect()->route('admins_list', ['admin' => $admin])->with('success', 'Admin Creaed Successfully!');
		}
		else {
			return redirect()->back()->with('error', 'Something went wrong!');
		}
		return view('admins/add_admin');
	}

	/**
	 * This function is used to Show Saved Jobs Listing
	*/
	public function viewAdmin($id) {
		if(Auth::user()->can('view_admin')) {
			$viewAdmin = Admin::where('id', $id)->get();
			$deletedAdmins = Admin::onlyTrashed()->get();
			if($viewAdmin->isNotEmpty()) {
				return view('admins/view_admin', ['viewAdmin' => $viewAdmin]);
			}
			else {
				return view('admins/view_admin', ['viewAdmin' => $deletedAdmins]);
			}
		}
		else {
			return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
		}
	}

	/**
	 * This function is used to Show Admins Listing
	*/
	public function editAdmin($id) {
		if(Auth::user()->can('edit_admin')) {
			$roles = Role::orderBy('name')->where('id', '!=', 1)->get();
			$admin = Admin::where('id', $id)->get();
			return view('admins/edit_admin', ['roles' => $roles, 'admin' => $admin]);
		}
		else {
			return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
		}
	}

	/**
	 * This function is used to Show Admins Listing
	*/
	public function updateAdmin(Request $request) {
		$validatedData = $request->validate([
			'name' => 'required',
			'email' => 'required|email',
			'role_id' => 'required',
		], [
			'name.required' => 'Name is required',
			'email.required' => 'Email is required',
			'email.email' => 'Email is not valid',
			'role_id.required' => 'Role is required',
		]);
		$updateAdmin = Admin::where('id', $request->id)->update([
			'name' => $request->name,
			// 'email' => $request->email,
			'role_id' => $request->role_id,
		]);
		if($updateAdmin) {
			$adminsList = Admin::where('role_id', '!=', 1)->get();
			return redirect()->route('admins_list', ['adminsList' => $adminsList])->with('success', "Admin Updated Successfully!");
		}
		else {
			return back()->with('error', "Something went wrong! Please try again.");
		}
	}

	/**
	 * This function is used to Permanent Delete Admin
	*/
	public function permanentDeleteAdmin(Request $request) {
		$admin = Admin::where('id', $request->id)->onlyTrashed()->first();
		$deleteAdmin = $admin->forceDelete();
		if($deleteAdmin) {
			$res['success'] = 1;
			return json_encode($res);
		}
		else {
			$res['success'] = 0;
			return json_encode($res);
		}
	}

	/**
	 * This function is used to Show Saved Jobs Listing
	*/
	public function deleteAdmin(Request $request) {
		$deleteAdmin = Admin::where('id', $request->id)->delete();
		if($deleteAdmin) {
			$res['success'] = 1;
			return json_encode($res);
		}
		else {
			$res['success'] = 0;
			return json_encode($res);
		}
	}

	/**
	 * This function is used to Show Saved Jobs Listing
	*/
	public function deletedAdminsList() {
		if(Auth::user()->can('manage_recycle_bin_admins')) {
			$deletedAdmins = Admin::onlyTrashed()->orderByDesc('email')->get();
			return view('admins/deleted_admins_list', ['deletedAdmins' => $deletedAdmins]);
		}
		else {
			return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
		}
	}

	/**
	 * This function is used to Show Saved Jobs Listing
	*/
	public function restoreAdmin(Request $request) {
		$restoreAdmin = Admin::where('id', $request->id)->restore();
		if($restoreAdmin) {
			$res['success'] = 1;
			return json_encode($res);
		}
		else {
			$res['success'] = 0;
			return json_encode($res);
		}
	}
}
