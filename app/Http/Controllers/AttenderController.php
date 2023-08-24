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
        if (Auth::user() && Auth::user()->role == 'student') {
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
                session(['user_name' => Auth::user()->name, 'user_id' => Auth::user()->id]);
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
        $subject = Classroom::all();
        if (Auth::user() && Auth::user()->role == 'admin') {
            return redirect('/dashboard');
        } else if (Auth::user() && Auth::user()->role == 'student' && Auth::user()->status == 'active') {
            return redirect('/studentDashboard');
        } else if (Auth::user() && Auth::user()->role == 'teacher' && Auth::user()->status == 'active') {
            return redirect('/attendenceBook');
        }
        return view('layouts.adminSignup', ['subjects' => $subject]);
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
        if ($request->role == 'student') {
            $request->validate([
                'role' => 'required',
                'name' => 'required',
                'gender' => 'required',
                'email' => 'required|email|unique:alluser,email',
                'phone' => 'required|digits:10',
                'address' => 'required',
                'semester' => 'required',
                'subject' => 'required',
                'password' => 'required',
                'cpassword' => 'required|same:password',
            ]);
        }

        $user_data = new AllUser;
        $user_data->name = $request->input('name');
        $user_data->gender = $request->input('gender');
        $user_data->email = $request->input('email');
        $user_data->phone = $request->input('phone');
        $user_data->address = $request->input('address');
        $user_data->role = $request->input('role');
        $user_data->semester = $request->input('semester');
        $user_data->password = Hash::make($request->input('password'));
        $user_data->sem_fk_id = $request->input('subject');

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
    public function chartRegistration()
    {
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
        $students = AllUser::where('role', 'student')->orderBy('id', 'desc')->get();
        return view('layouts.addStudent', ['students' => $students]);
    }

    public function viewClass()
    {
        $semester = Classroom::orderBy('id', 'desc')->get();
        return view('layouts.viewClass', ['semester' => $semester]);
    }

    public function studentGranted(Request $request)
    {
        $sid = $request->id;

        $student = AllUser::find($sid);
        if ($student) {
            $student->status = 'active';
            $details = [
                'title' => 'Mail from Joydip',
                'body' => 'Hello,  ' . $student->name,
                'main' => '   Welcome our environment.You have successfully Verified!! Now You Can Login..'
            ];
            \Mail::to($student->email)->send(new \App\Mail\sendmail($details));
            $student->save();
            return response()->json(['message' => 'student status upadated successful', 'mail' => 'email send Successfully', 'status' => 200]);
        } else {
            return response()->json(['message' => 'student not found', 'mail' => 'email not send', 'status' => 404]);
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
        $teachers = AllUser::where('role', 'teacher')->orderBy('id', 'desc')->get();
        return view('layouts.addTeacher', ['teachers' => $teachers]);
    }

    public function grantedTeacher(Request $request)
    {
        $tid = $request->id;
        $teacher = AllUser::find($tid);
        if ($teacher) {
            $teacher->status = 'active';
            $details = [
                'title' => 'Mail from Joydip',
                'body' => 'Hello,  ' . $teacher->name,
                'main' => '   Welcome our environment.You have successfully Verified!! Now You Can Login..'
            ];
            \Mail::to($teacher->email)->send(new \App\Mail\sendmail($details));
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

    public function classActive(Request $request)
    {
        $tid = $request->id;
        $sem = Classroom::find($tid);
        if ($sem) {
            $sem->status = 'active';
            $sem->save();

            return response()->json(['message' => 'sem status updated successfully', 'status' => 200]);
        } else {
            return response()->json(['message' => 'sem not found', 'status' => 404]);
        }
    }

    public function classInactive(Request $request)
    {
        $tid = $request->id;
        $sem = Classroom::find($tid);
        if ($sem) {
            $sem->status = 'inactive';
            $sem->save();

            return response()->json(['message' => 'sem status updated successfully', 'status' => 200]);
        } else {
            return response()->json(['message' => 'sem not found', 'status' => 404]);
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

    // public function updateClassStatus(Request $request){
    //     $findClass = Classroom::where('subject',$request->sub)->get();
    //     $subid = $findClass[0]->id ;
    //     $findsub = Classroom::find($subid);

    //     if($findsub){
    //         $findsub->classstatus = '1';
    //         $findsub->save();
    //     }
    // } 
    public function studentDashboard()
    {
        return view('main.studentDashboard');
    }
    public function studentDashboardPage(Request $request)
    {
        $stuid = $request->id;

        $findStudent = AllUser::find($stuid);
        // dd($findStudent);
        $totalPresent = $findStudent->present;
        $semester = $findStudent->semester;
        $fkid = $findStudent->sem_fk_id;
        $stuEmail = $findStudent->email;

        $totalClass = Classroom::join('alluser', 'alluser.sem_fk_id', '=', 'semester.id')
            ->where('alluser.semester', $semester)
            ->where('alluser.sem_fk_id', $fkid)
            ->where('alluser.email', $stuEmail)
            ->get();

        $class = $totalClass[0]->total_class;
        $absent = $class - $totalPresent;
        if ($class == 0) {
            $class = 1;
            $absent = 0;
            $totalPresent = 0;
        }
        if ($totalPresent == null) {
            $totalPresent = 0;
        }
        $percentage = ceil(($totalPresent / $class) * 100);

        // dd($absent);
        return view('layouts.studentDashboardPage', ['absent' => $absent, 'totalPresent' => $totalPresent, 'percentage' => $percentage]);
    }
    public function studentReport()
    {
        return view('layouts.studentReport');
    }
    public function attendenceBook()
    {
        $subjects = Classroom::where('semester.status', 'Active')->get();
        // $pendingClass = Classroom::where('classstatus','0')->get();
        return view('layouts.attendenceBook', ['subjects' => $subjects]);
    }

    public function viewStudent(Request $request)
    {
        $sem = $request->sem;
        $sub = $request->sub;
        $year = $request->year;
        $dt = date("Y.m.d");

        $semesterStudent = Classroom::join('alluser', 'alluser.sem_fk_id', '=', 'semester.id')
            ->where('alluser.semester', $sem)
            ->where('semester.subject', $sub)
            ->where('semester.semesteryear', $year)
            ->where('alluser.status', 'active')
            ->select('alluser.*', 'semester.updated_at as semester_updated_at')
            ->get();

        // dd($semesterStudent);
        foreach ($semesterStudent as $stu) {
            if (date("Y.m.d", strtotime($stu->semester_updated_at)) == $dt) {
                // dd($stu->semester_updated_at->format('Y.m.d'));
                return response()->json(['alreadypresent' => "Already Attendence Recorded!!"]);
            }
        }
        $subjects = Classroom::all();
        return view('layouts.studentViewData', compact('semesterStudent', 'subjects'));
    }

    public function giveAttendence(Request $request)
    {
        // $date

        $record = $request->input('stuArr');
        $length = count($record);
        // dd($length);

        $students = AllUser::whereIn('id', $record)->get();
        foreach ($students as $stu) {
            $stu->present = $stu->present + 1;
            $stu->save();
        }
        $sem = Classroom::find($students[0]->sem_fk_id);
        $sem->total_class = $sem->total_class + 1;
        $sem->save();
        return response()->json(['message' => 'attendence recorded successfully', 'status' => 200]);
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

    public function edit(Request $request)
    {
        $id = $request->uid;
        $adminData = AllUser::find($id);
        // dd($adminData);

        return response()->json(['adminData' => $adminData]);
    }
    public function studentedit(Request $request)
    {
        $id = $request->uid;
        $studentData = AllUser::find($id);
        // dd($studentData);

        return response()->json(['studentData' => $studentData]);
    }
    public function teacheredit(Request $request)
    {
        $id = $request->uid;
        $teacherData = AllUser::find($id);
        dd($teacherData);
        return response()->json(['teacherData' => $teacherData]);
    }

    public function updateDetails(Request $request)
    {
        $id = $request->userid;
        $adminData = AllUser::find($id);

        $adminData->name = $request['uname'];
        $adminData->email = $request['uemail'];
        $adminData->gender = $request['upgender'];
        $adminData->phone = $request['umobile'];
        $adminData->address = $request['address'];
        $adminData->save();
        return response()->json(['success' => 'successfully update', 'status' => 200]);
    }

    public function updateDetailsStudent(Request $request)
    {
        $id = $request->userid;
        $adminData = AllUser::find($id);

        $adminData->name = $request['uname'];
        $adminData->email = $request['uemail'];
        $adminData->gender = $request['upgender'];
        $adminData->phone = $request['umobile'];
        $adminData->address = $request['address'];
        $adminData->save();
        return response()->json(['success' => 'successfully update', 'status' => 200]);
    }
    public function updateDetailsTeacher(Request $request)
    {
        $id = $request->userid;

        $adminData = AllUser::find($id);

        $adminData->name = $request['uname'];
        $adminData->email = $request['uemail'];
        $adminData->gender = $request['upgender'];
        $adminData->phone = $request['umobile'];
        $adminData->address = $request['address'];
        $adminData->save();
        return response()->json(['success' => 'successfully update', 'status' => 200]);
    }
}