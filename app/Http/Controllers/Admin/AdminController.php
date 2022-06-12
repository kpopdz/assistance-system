<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\user;
use App\Models\Question;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\Controller;
use App\Models\collection;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Parents;
use App\Providers\RouteServiceProvider;





class AdminController extends Controller
{

   public function __construct()
   {
       $this->middleware('isadmin');
   }
    public function index ()
    {
       $users=user::all();
       return view ('admin.users',compact('users'));
     //return view ('home',['user'=>Auth::user()]);

    }
    public function destroy(question $question){
        $question->delete();
        return redirect()->route('quizs.show')->with('success','question delete successfully');

    }
    public function studentlist()
    {
        # code...
$students=student::join('users', 'users.id', '=', 'student.user_id')
->join('class_user','class_user.user_id', '=', 'student.user_id')
->join('classroom','classroom.id', '=', 'class_user.class_id')
->select('student.*','classroom.class_name')
->get();
        return view('admin.liststudent',compact('students'));
    }
    public function addUser()
    {
        return view('auth.register');
        # code...
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => 'required',

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(Request $request)

    {



if ($request->role=='teacher') {
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        'role' => 'required',
        'firstname' => ['required', 'string', 'max:255'],
        'lastname' => ['required', 'string', 'max:255'],
        'birth_date' => ['required'],
        'sex' => 'required',

    ]);
    $user=User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role,

    ]);

    $teacher=Teacher::create([
        'user_id' => $user->id,
        'firstname' => $request->firstname,
        'lastname' => $request->lastname,
        'birth_date' => $request->birth_date,
        'sex' => $request->sex,
        'address' => $request->address,
        'grade' => $request->grade,


    ]);
    return dd($teacher);

} elseif ($request->role=='student')
 {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'role' => 'required',
                'firstname' => ['required', 'string', 'alpha', 'max:255'],
                'lastname' => ['required', 'string','alpha', 'max:255'],
                'birth_date' => ['required'],
                'sex' => 'required',
                'nationality' => 'required',


            ]);
            $user=User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'student_id'=> $request->student_id,

        ]);
        $student=Student::create([
    'user_id' => $user->id,
    'firstname' => $request->firstname,
    'lastname' => $request->lastname,
    'birth_date' => $request->birth_date,
    'sex' => $request->sex,
    'address' => $request->address,
    'nationality' => $request->nationality,
    'academic_level' => $request->academic_level,
    'student_id' => $request->student_id,


]);


}else {
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        'role' => 'required',
        'full_name'=>['required', 'string', 'max:255'],
        'phone_number'=> ['required','min:5', 'max:255', 'unique:parents'],
    ]);
    $user=User::create([
    'name' => $request->name,
    'email' => $request->email,
    'password' => Hash::make($request->password),
    'role' => $request->role,

]);
$parent=Parents::create([
    'user_id' => $user->id,

    'full_name' => $request->full_name,
    'phone_number' => $request->phone_number,

]);
}
    $favorite=new collection();
    $favorite->name="favorite";
    $favorite->user_id=$user->id;
    $favorite->save();
        return $user;

    }


}
//app\Http\Controllers\Admin\AdminController.php
