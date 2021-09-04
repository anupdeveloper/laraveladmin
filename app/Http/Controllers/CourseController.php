<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\School;
use App\Models\User;
use Session;
use Auth;

class CourseController extends Controller
{

    public function get_course_list(Request $request){
      $list = Course::where('school_id',$request->school_id)->get();
      $course_select = '<select name="course_id" id="course_id" class="form-control">';
      foreach($list as $row){
        $course_select .= '<option value="'.$row->id.'">'.$row->name.'</option>';
      }
      $course_select .='</select>';
      return response()->json(['course_sel' => $course_select]);
    }
    public function list(){
      $list = Course::all();
      return view('course.list',['list'=>$list]);
    }

    public function add(){
      $school_list = School::all();
      $teacher_list = User::where('role_id','4')->where('is_email_verified','1')->get();
      return view('course.add',['school_list'=>$school_list,'teacher_list'=>$teacher_list]);
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

      $model = New Course;
      $model->name = $request->input('name');
      $model->school_id = $request->input('school_id');
      $model->course_start_date = date('Y-m-d H:i:s',strtotime($request->input('course_start_date')));
      $model->subject = $request->input('subject');
      $model->course_code = $request->input('course_code');
      $model->price = '0.00';
      $model->status = 1;
      $model->created_by =  $created_by;
      $model->save();

      return redirect()->route('list_course')->with('success', $request->input('name').' has successfully added');
    }


    public function view($id){
      $list = Course::where('id',$id)->get();
      //dd($school_list);
      return view('course.view',['list'=>$list]);
    }

    public function edit($id){
      $school_list = School::all();
      $list = Course::where('id',$id)->get();
      //dd($school_list);
      return view('course.edit',[ 'school_list'=> $school_list,'list'=>$list]);
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
      $row = Course::find( $request->id );
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
