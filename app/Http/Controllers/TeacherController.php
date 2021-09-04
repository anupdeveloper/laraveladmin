<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserSocialLogin;
use App\Http\Requests\TeacherRequest;

//use Illuminate\Support\Facades\Gate;
use Hash;
use Auth;
use Session;

class TeacherController extends Controller
{
    public function list()
    {
        $list = User::where('role_id', '4')->get();
        return view('teacher.list', ['list'=>$list]);
    }

    public function add()
    {
        return view('teacher.add');
    }

    public function save(TeacherRequest $request)
    {
        $status = User::saveTeacher($request, 'insert');

        return redirect()->route('list_teacher')->with('success', $request->input('name').' has successfully added');
    }



    public function view($id)
    {
        $list = Course::where('id', $id)->get();

        return view('course.view', ['list'=>$list]);
    }

    public function edit($id)
    {
        $list = User::where('id', $id)->get();

        return view('teacher.edit', [ 'list'=>$list]);
    }

    public function update(TeacherRequest $request)
    {
        $status = User::saveTeacher($request, 'update');

        if ($status) {
            return redirect()->route('list_teacher')->with('success', $request->input('name').' has successfully updated');
        } else {
            return redirect()->back()->with('success', ' Some error occur!');
        }
    }

    public function delete(Request $request)
    {
        $status = User::saveTeacher($request, 'delete');
        if ($status) {
            $res['success'] = 1;
            $res['message'] = "Delete successfully";
            Session::flash('success', 'Delete successfully');
            return json_encode($res);
        } else {
            $res['success'] = 0;
            $res['message'] = "Something went wrong! Please try again.";
            return json_encode($res);
        }
    }
}
