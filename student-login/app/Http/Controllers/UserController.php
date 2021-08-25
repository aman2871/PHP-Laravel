<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Symfony\Component\Console\Input\Input;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function login()
    {
        return view('login');
    }
    function list()
    {

        $student = Student::all();
        return view('userlist', ['student' => $student]);
    }
    function create()
    {
        return view('create');
    }
    function loginsubmit(Request $req)
    {
       
            $user = Student::where(["email" => $req->email])->first();
            if (!$user ||$req->password != $user->password) {
                return "Username or password is not matched";
            } else {
                $req->session()->put('student', $user);
                return redirect('/list');
            }
        
        // $req->session()->put('logData', [$req->input()]);
        // return redirect('/list');
        // return print_r($req->input());
    }
    function createsubmit(Request $req)
    {
        $student = new Student;
        $student->name = $req->name;
        $student->email = $req->email;
        $student->password = $req->password;
        $result = $student->save();
        if ($result) {
            return redirect('/list');
        }
    }
    function edit($id)
    {
        $student = Student::find($id);

        return view('edit', ['student' => $student]);
    }
    function editsubmit(Request $req)
    {

        $student = Student::find($req->id);
        $student->name = $req->name;
        $student->email = $req->email;
        $student->password = $req->password;
        $result = $student->save();
        
        
        // this was the error that i made
        
        // $student->name = $id->name;
        // $student->email = $id->email;
        // $student->password = $id->password;
        // $student->save();
        return redirect('/list');
    }

    function destroy($id)
    {
        $student = Student::find($id);
        $student->delete();

        return redirect('/list');
    }
}
