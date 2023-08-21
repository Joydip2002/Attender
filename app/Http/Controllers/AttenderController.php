<?php

namespace App\Http\Controllers;

use App\Models\AllUser;
use App\Models\Classroom;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class AttenderController extends Controller
{
    public function login()
    {
        if (Auth::user() && Auth::user()->role == 'admin') {
            return redirect('/dashboard');
        } else if (Auth::user() && Auth::user()->role == 'student' && Auth::user()->status == 'active') {
            return redirect('/studentDashboard');
        } else if (Auth::user() && Auth::user()->role == 'teacher' && Auth::user()->status == 'active') {
            return redirect('/attendenceBook');
        }
        return view('layouts.adminLogin');
    }
    public function loginEnter(Request $request)
    {
        // dd($request->all());
        $credentials = $request->validate([
            'email' => ['required', 'string'],
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials) && Auth::user()->role == 'admin') {
            return redirect('/dashboard');
        } else if (Auth::attempt($credentials) && Auth::user()->role == 'student') {
            if (Auth::user()->status == 'active') {
                return redirect('/studentDashboard');
            } else {
                return redirect('/')->with("failed", "Permission denied! You are not granted yet!!");
            }
        } else if (Auth::attempt($credentials) && Auth::user()->role == 'teacher') {
            if (Auth::user()->status == 'active') {
                session(['user_name' => Auth::user()->name]);
                return redirect('/attendenceBook');
            } else {
                return redirect('/')->with("failed", "Permission denied! You are not granted yet!!");
            }
        } else {
            return redirect('/')->with('failed', 'Invalid Credentials!');
        }
    }

    public function signup()
    {
        if (Auth::user() && Auth::user()->role == 'admin') {
            return redirect('/dashboard');
        } else if (Auth::user() && Auth::user()->role == 'student' && Auth::user()->status == 'active') {
            return redirect('/studentDashboard');
        } else if (Auth::user() && Auth::user()->role == 'teacher' && Auth::user()->status == 'active') {
            return redirect('/attendenceBook');
        }
        return view('layouts.adminSignup');
    }

    public function signupSave(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'role' => 'required',
            'name' => 'required',
            'gender' => 'required',
            'email' => 'required|email|unique:alluser,email',
            'phone' => 'required|digits:10',
            'address' => 'required',
            'password' => 'required',
            'cpassword' => 'required|same:password',
        ]);

        $user_data = new AllUser;
        $user_data->name = $request->input('name');
        $user_data->gender = $request->input('gender');
        $user_data->email = $request->input('email');
        $user_data->phone = $request->input('phone');
        $user_data->address = $request->input('address');
        $user_data->role = $request->input('role');
        $user_data->semester = $request->input('semester');
        $user_data->password = Hash::make($request->input('password'));

        $user_data->save();
        return redirect('/')->with('success', 'You have successfully registered!');

    }
    public function dashboard()
    {
        return view('main.dashboard');
    }
    // public function registrationStudent()
    // {
    //     $days = 30; // Replace this with the desired number of days

    //     $results = AllUser::selectRaw('DATE(created_at) AS reg_date, COUNT(*) AS count')
    //         ->where('created_at', '>=', now()->subDays($days))
    //         ->where('role', 'student')
    //         ->groupBy('reg_date')
    //         ->get();
    //     // dd($results);
    //     return view("layouts.adminDashboard", ['results' => $results]);
    // }
    public function adminDashboard()
    {
        $totalStudent = AllUser::where('role', 'student')->count();
        $totalTeacher = AllUser::where('role', 'teacher')->count();
        $totalAdmin = AllUser::where('role', 'admin')->count();

        $days = 30; // Replace this with the desired number of days

        // $results = AllUser::selectRaw('DATE(created_at) AS reg_date, COUNT(*) AS count')
        //     ->where('created_at', '>=', now()->subDays($days))
        //     ->where('role', 'student')
        //     ->groupBy('reg_date')
        //     ->get();
        return view('layouts.adminDashboard', ['totalStudent' => $totalStudent, 'totalTeacher' => $totalTeacher, 'totalAdmin' => $totalAdmin]);
    }
    public function chartRegistration(){
        $days = 30; // Replace this with the desired number of days
        $results = AllUser::selectRaw('DATE(created_at) AS reg_date, COUNT(*) AS count')
        ->where('created_at', '>=', now()->subDays($days))
        ->where('role', 'student')
        ->groupBy('reg_date')
        ->get();
        return $results;
    }
    public function addAdmin()
    {
        $admin = AllUser::where('role', 'admin')->get();
        return view('layouts.addAdmin', ['admins' => $admin]);
    }
    public function addStudent()
    {
        $students = AllUser::where('role', 'student')->get();

        return view('layouts.addStudent', ['students' => $students]);
    }

    public function studentGranted(Request $request)
    {
        $sid = $request->id;

        $student = AllUser::find($sid);
        if ($student) {
            $student->status = 'active';
            $student->save();
            return response()->json(['message' => 'student status upadated successful', 'status' => 200]);
        } else {
            return response()->json(['message' => 'student not found', 'status' => 404]);
        }
    }
    public function studentDenied(Request $request)
    {
        $sid = $request->id;

        $student = AllUser::find($sid);
        if ($student) {
            $student->status = 'inactive';
            $student->save();
            return response()->json(['message' => 'student status upadated successful', 'status' => 200]);
        } else {
            return response()->json(['message' => 'student not found', 'status' => 404]);
        }
    }
    public function addStudentSave(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'name' => 'required',
            'gendertype' => 'required',
            'email' => 'required|email|unique:admin,email',
            'phone' => 'required|digits:10',
            'address' => 'required',
            'semester' => 'required'
        ]);
        $stu_data = new Student;
        $stu_data->name = $request->input('name');
        $stu_data->gender = $request->input('gendertype');
        $stu_data->email = $request->input('email');
        $stu_data->phone = $request->input('phone');
        $stu_data->address = $request->input('address');
        $stu_data->semester = $request->input('semester');
        $stu_data->password = '123';

        $stu_data->save();
    }
    public function addTeacher()
    {
        $teachers = AllUser::where('role', 'teacher')->get();
        return view('layouts.addTeacher', ['teachers' => $teachers]);
    }

    public function grantedTeacher(Request $request)
    {
        $tid = $request->id;
        $teacher = AllUser::find($tid);
        if ($teacher) {
            $teacher->status = 'active';
            $teacher->save();

            return response()->json(['message' => 'Teacher status updated successfully', 'status' => 200]);
        } else {
            return response()->json(['message' => 'Teacher not found', 'status' => 404]);
        }
    }

    public function deniedTeacher(Request $request)
    {
        $tid = $request->id;
        $teacher = AllUser::find($tid);

        if ($teacher) {
            $teacher->status = 'inactive';
            $teacher->save();
            return response()->json(['message' => 'Teacher status updated successfully', 'status' => 200]);
        } else {
            return response()->json(['message' => 'Teacher Not Found', 'status' => 400]);
        }
    }


    public function addClass()
    {
        return view('layouts.addClass');
    }

    public function addClassroom(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'subjectname' => 'required|unique:semester,subject',
            'semester' => 'required',
            'year' => 'required'
        ]);

        $class_data = new Classroom;
        $class_data->subject = $request->input('subjectname');
        $class_data->semestername = $request->input('semester');
        $class_data->semesteryear = $request->input('year');
        $class_data->save();
    }
    // -----------Student Dashboard------------

    public function studentDashboard()
    {
        return view('main.studentDashboard');
    }
    public function studentDashboardPage()
    {
        return view('layouts.studentDashboardPage');
    }
    public function studentReport()
    {
        return view('layouts.studentReport');
    }
    public function attendenceBook()
    {
        $subjects = Classroom::all();
        return view('layouts.attendenceBook', ['subjects' => $subjects]);
    }

    public function viewStudent(Request $request)
    {
        $sem = $request->sem;
        $sub = $request->sub;
        // $semesterStudent = AllUser::where('semester', $sem)->get();
        $semesterStudent =  AllUser::join('semester', 'semester.id', '=', 'alluser.sem_fk_id')
        ->where('alluser.semester', $sem)
        ->where('semester.subject',$sub)
        ->get();
        // dd($semesterStudent);
        $subjects = Classroom::all();
        return view('layouts.studentViewData',compact('semesterStudent','subjects'));
    }

    public function studentLogout()
    {
        Auth::logout();
        return redirect('/');
    }
    public function adminLogout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
    public function teacherLogout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
}