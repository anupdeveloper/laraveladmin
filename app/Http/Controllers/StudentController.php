<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\UserSocialLogin;
use Illuminate\Support\Facades\Gate;
use Hash;
use Auth;
use Session;
use Illuminate\Http\Request;

class StudentController extends Controller
{
  public function list(){
    $list = User::where('role_id','3')->get();
    //dd($list);
    return view('student.list',['list'=>$list]);
  }

  public function add(){
    //$school_list = School::all();
    //dd($school_list);
    return view('student.add');
  }

  public function save(Request $request){
    //dd($request->all());
    $validatedData = $request->validate([
      'name' => 'required',
      'first_name' => 'required',
      'email' => 'required',

    ], [
      'name.required' => 'The field is required.',
      'first_name.required' => 'Select the school.',
      //'phone.required' => 'The field is required.',
    ]);

    $email_verified = 0;
    if($request->has($request->input('email_verified'))){
      $email_verified = 1;
    }

    $model = New User;
    $model->name = $request->input('name');
    $model->first_name = $request->input('first_name');
    $model->last_name = $request->input('last_name');
    $model->email = $request->input('email');
    $model->is_email_verified = $email_verified;
    $model->ip_address = $request->ip();
    $model->role_id = '3';
    $model->save();

    return redirect()->route('list_student')->with('success', $request->input('name').' has successfully added');
  }


  public function view($id){
    $list = Course::where('id',$id)->get();
    //dd($school_list);
    return view('course.view',['list'=>$list]);
  }

  public function edit($id){
    //$school_list = School::all();
    $list = User::where('id',$id)->get();
    //dd($school_list);
    return view('student.edit',[ 'list'=>$list]);
  }

  public function update(Request $request){
    $validatedData = $request->validate([
      'name' => 'required',
      'first_name' => 'required',
      'email' => 'required',

    ], [
      'name.required' => 'The field is required.',
      'first_name.required' => 'Select the school.',
      //'phone.required' => 'The field is required.',
    ]);
    $email_verified = 0;
    if($request->has($request->input('email_verified'))){
      $email_verified = 1;
    }

    $update = User::where('id', $request->id)->update([
      'name' => $request->name,
      'email' => $request->email,
      'first_name' =>  $request->first_name,
      'last_name' => $request->last_name,
      'is_email_verified' => $email_verified,
      'ip_address' => $request->ip()
    ]);

    if($update){
      return redirect()->route('list_student')->with('success', $request->input('name').' has successfully updated');
    }else{
      return redirect()->back()->with('success', ' Some error occur!');
    }

  }

  public function delete(Request $request){
    $row = User::find( $request->id );
    $del = $row->delete();
    if($del) {
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
