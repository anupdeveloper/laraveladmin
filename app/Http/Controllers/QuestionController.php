<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\School;
use App\Models\User;
use App\Models\Question;
use App\Models\Question_Option;
use Session;
use Auth;

class QuestionController extends Controller
{
  public function list(){
    $list = Question::all();
    return view('questions.list',['list'=>$list]);
  }

  public function add(){
    $school_list = School::all();
    $course_list = Course::all();
    $teacher_list = User::where('role_id','4')->where('is_email_verified','1')->get();
    return view('questions.add',['course_list'=>$course_list,'school_list'=>$school_list,'teacher_list'=>$teacher_list]);
  }

  public function save(Request $request){
    //dd($request->all());
    $validatedData = $request->validate([
      'name' => 'required',
      'school_id' => 'required',
      //'price' => 'required'

    ], [
      'name.required' => 'The field is required.',
      'school_id.required' => 'Select the school.',
      //'phone.required' => 'The field is required.',
    ]);


    if($request->input('created_by') != ''){
      $created_by = $request->input('created_by');
    }else{
      $created_by = Auth::user()->id;
    }
    //$created_by = Auth::user()->id;
    ///echo $created_by; die;

    $model = New Question;
    $model->name = $request->input('name');
    $model->desc = $request->input('desc');
    $model->school_id = $request->input('school_id');
    $model->course_id = $request->input('course_id');
    $model->subject_id = NULL;
    $model->category_id = 1;
    $model->question_type = $request->input('question_type');
    $model->duration = $request->input('duration');
    //$model->starts_on = $request->input('starts_on');
    //$model->ends_on = $request->input('ends_on');
    $model->status = 1;
    $model->created_by =  $created_by;
    $model->save();
    $question_id = $model->id;
    // And question options
    if($question_id){
      $model = New Question_Option;
      $model->question_id = $question_id;
      $model->option_value = $request->input('option_1');
      $model->is_correct = $request->has('is_correct_1')?1:0;
      $model->save();
      $model = New Question_Option;
      $model->question_id = $question_id;
      $model->option_value = $request->input('option_2');
      $model->is_correct = $request->has('is_correct_2')?1:0;
      $model->save();
    }


    return redirect()->route('list_question')->with('success', $request->input('name').' has successfully added');
  }


  public function view($id){
    $list = Course::where('id',$id)->get();
    return view('questions.view',['list'=>$list]);
  }

  public function edit($id){
    $school_list = School::all();
    $list = Course::where('id',$id)->get();
    //dd($school_list);
    return view('questions.edit',[ 'school_list'=> $school_list,'list'=>$list]);
  }

  public function update(Request $request){
    $validatedData = $request->validate([
      'name' => 'required',
      'price' => 'required',
      'school_id' => 'required'

    ], [
      'name.required' => 'The field is required.',
      'price.required' => 'The field is required.',
      'school_id.required' => 'The field is required.',
    ]);
    $status = 0;
    if(isset($request->status)){
        if($request->status=="on"){
          $status = 1;
        }else{
          $status = 0;
        }
    }

    $update = Course::where('id', $request->id)->update([
      'name' => $request->name,
      'school_id' => $request->school_id,
      'status' => $status,
      'price' => $request->price,
      'duration' => $request->duration,
      'desc' => $request->desc
    ]);

    if($update){
      return redirect()->route('list_course')->with('success', $request->input('name').' has successfully updated');
    }else{
      return redirect()->back()->with('success', ' Some error occur!');
    }

  }

  public function delete(Request $request){
    $row = Question::find( $request->id );
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
