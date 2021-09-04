<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;
use App\Models\User;
use App\Models\UserSocialLogin;
use Illuminate\Support\Facades\Gate;
use Session;
use Auth;

class SchoolController extends Controller
{
    public function schoolList(){
      if(1) {
        $school_list = School::all();
        return view('school.school_list',['school_list'=>$school_list]);
      }
      else {
        return redirect()->route('dashboard')->with('warning', 'You do not have permission for this action!');
      }
    }

    public function addschool(){
      return view('school.add_school');
    }

    public function saveschool(Request $request){
      $validatedData = $request->validate([
  			'name' => 'required',
  			'email' => 'required',
  			'phone' => 'required'

  		], [
  			'name.required' => 'The field is required.',
  			'email.required' => 'The field is required.',
  		  'phone.required' => 'The field is required.',
  		]);

      $school = New School;
      $school->name = $request->input('name');
      $school->email = $request->input('email');
      $school->phone = $request->input('phone');
      $school->website = $request->input('website');
      $school->address = $request->input('address');
      $school->status = 1;
      $school->save();

      return redirect()->route('school_list')->with('success', $request->input('name').' has successfully added');
    }

    public function viewschool($id){
      $school_list = School::where('id',$id)->get();
      //dd($school_list);
      return view('school.view_school',['school_list'=>$school_list]);
    }


    public function editschool($id){
      $school_list = School::where('id',$id)->get();
      //dd($school_list);
      return view('school.edit_school',['school_list'=>$school_list]);
    }


    public function updateschool(Request $request){
      $validatedData = $request->validate([
  			'name' => 'required',
  			'email' => 'required',
  			'phone' => 'required'

  		], [
  			'name.required' => 'The field is required.',
  			'email.required' => 'The field is required.',
  		  'phone.required' => 'The field is required.',
  		]);
      $status = 0;
      if(isset($request->status)){
          if($request->status=="on"){
            $status = 1;
          }else{
            $status = 0;
          }
      }

      $update = School::where('id', $request->id)->update([
  			'name' => $request->name,
        'status' => $status,
        'phone' => $request->phone,
        'website' => $request->website,
        'address' => $request->address
  		]);

      if($update){
        return redirect()->route('school_list')->with('success', $request->input('name').' has successfully updated');
      }else{
        return redirect()->back()->with('success', ' Some error occur!');
      }

    }


    public function deleteschool(Request $request){
      $row = School::find( $request->id );
      $del_school = $row->delete();
      if($del_school) {
  			$res['success'] = 1;
        $res['message'] = "Delete successfully";
        Session::flash('success', 'Delete successfully');
  			return json_encode($res);
  		}
  		else {
  			$res['success'] = 0;
  			$res['message'] = "Something went wrong! Please try again.";
  			return json_encode($res);
  		}
  	}


}
