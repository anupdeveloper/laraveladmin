<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guest;
use Auth;

class GuestsController extends Controller {
	/* 
	* This function is used to show Guests List
	*/
	public function guestsList() {
		if(Auth::user()->can('manage_guests')) {
			$guestsList = Guest::orderBy('email')->get();
			return view('guests/guests_list')->with('guestsList', $guestsList);
		}
		else {
			return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
		}
	}

	/* 
	* This function is used to view Guest Details
	*/
	public function viewGuest($id) {
		if(Auth::user()->can('view_guest')) {
			$guest = Guest::find($id);
			return view('guests/view_guest')->with('guest', $guest);
		}
		else {
			return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
		}
	}

	/* 
	* This function is used to View Guest Resume
	*/
	public function viewGuestResume($id) {
		if(Auth::user()->can('view_guest_resume')) {
			$guest = Guest::where('id', $id)->get();
			return view('guests/view_guest')->with('guest', $guest);
		}
		else {
			return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
		}
	}
}
