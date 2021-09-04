<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\School;
use App\Models\Subject;
use App\Models\User;
use Auth;

class SubjectController extends Controller
{
  public function list(){
    $list = Subject::all();
    return view('subject.list',['list'=>$list]);
  }

  public function add(){
    $school_list = School::all();
    $course_list = Course::all();
    $teacher_list = User::where('role_id','4')->where('is_email_verified','1')->get();
    return view('subject.add',['school_list'=>$school_list,'course_list'=>$course_list,'teacher_list'=>$teacher_list]);
  }

  public function save(Request $request){
    //dd($request->all());
    $validatedData = $request->validate([
      'name' => 'required',
      'school_id' => 'required',
      'course_id' => 'required'

    ], [
      'name.required' => 'The field is required.',
      'school_id.required' => 'Select the school.',
      'course_id.required' => 'The field is required.',
    ]);

    if($request->input('created_by') != ''){
      $created_by = $request->input('created_by');
    }else{
      $created_by = Auth::user()->id;
    }

    $model = New Subject;
    $model->name = $request->input('name');
    $model->school_id = $request->input('school_id');
    $model->course_id = $request->input('course_id');
    $model->duration = $request->input('duration');
    $model->desc = $request->input('desc');
    $model->status = 1;
    $model->created_by = $created_by;
    $model->save();

    return redirect()->route('list_subject')->with('success', $request->input('name').' has successfully added');
  }


  public function view($id){
    $list = Course::where('id',$id)->get();
    //dd($school_list);
    return view('subject.view',['list'=>$list]);
  }

  public function edit($id){
    $school_list = School::all();
    $course_list = Course::all();
    $list = Subject::where('id',$id)->get();
    //dd($school_list);
    return view('subject.edit',[ 'school_list'=> $school_list,'course_list'=> $course_list,'list'=>$list]);
  }

  public function update(Request $request){
    $validatedData = $request->validate([
      'name' => 'required',
      'school_id' => 'required',
      'course_id' => 'required'

    ], [
      'name.required' => 'The field is required.',
      'school_id.required' => 'Select the school.',
      'course_id.required' => 'The field is required.',
    ]);
    $status = 0;
    if(isset($request->status)){
        if($request->status=="on"){
          $status = 1;
        }else{
          $status = 0;
        }
    }

    $update = Subject::where('id', $request->id)->update([
      'name' => $request->name,
      'school_id' => $request->school_id,
      'status' => $status,
      'course_id' => $request->course_id,
      'duration' => $request->duration,
      'desc' => $request->desc
    ]);

    if($update){
      return redirect()->route('list_subject')->with('success', $request->input('name').' has successfully updated');
    }else{
      return redirect()->back()->with('success', ' Some error occur!');
    }

  }

  public function delete(Request $request){
    $row = Subject::find( $request->id );
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
