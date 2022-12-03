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
use App\Models\Classroom;
use App\Models\academic_level;
use App\Models\Result;
use App\Models\class_user;
use App\Models\quiz;
use App\Models\point;
use Carbon\Carbon;
use Auth;
use App\Models\Admin;

use App\Models\class_teacher;
use Monarobase\CountryList\CountryListFacade;


use App\Providers\RouteServiceProvider;


use DB;


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
    public function datatable(Request $request)

    {

        if ($request->ajax()) {

            $data = User::select('*');

            return Datatables::of($data)

                    ->addIndexColumn()

                    ->addColumn('action', function($row){



                            $btn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm text-center">View</a>';



                            return $btn;

                    })

                    ->rawColumns(['action'])

                    ->make(true);

        }



        return view('users');

    }

    public function radar(student $student)
    {
 # code...
 $math=result::join('quiz', 'quiz.id', '=', 'results.quiz_id')
 ->where('results.user_id',$student->user_id)
 ->where('quiz.module','=','math')
 ->select('results.*','quiz.title','quiz.created_at','quiz.user_id AS creator')
 ->orderBy('creator')
 ->orderBy('quiz.created_at')


 ->get()
 ;
 $arabic=result::join('quiz', 'quiz.id', '=', 'results.quiz_id')
 ->where('results.user_id',$student->user_id)
 ->where('quiz.module','=','arabic')
 ->select('results.*','quiz.title','quiz.created_at','quiz.user_id AS creator')
 ->orderBy('creator')
 ->orderBy('quiz.created_at')


 ->get()
 ;
 $french=result::join('quiz', 'quiz.id', '=', 'results.quiz_id')
 ->where('results.user_id',$student->user_id)
 ->where('quiz.module','=','french')
 ->select('results.*','quiz.title','quiz.created_at','quiz.user_id AS creator')
 ->orderBy('creator')
 ->orderBy('quiz.created_at')


 ->get()
 ;
$module=['math','arabic','french'];
 $arrray=[];

 for ($i=0; $i <3 ; $i++) {
    if ($i==0) {
        $mod=$math;
    } elseif ($i==1) {
    //    $mod=$arabic;
    }else {
        $mod=$french;
    }

    $count=0;
    $moduleavg=0;
 foreach ($mod as $key => $value) {
     # code...
     $arrray[$module[$i]]['title'][$key]=$value->title;
     $arrray[$module[$i]]['quizpoints'][$key]=$value->quiz->totalPoint();
     $arrray[$module[$i]]['fullpoints'][$key]=$value->fullpoint;
     $arrray[$module[$i]]['avg'][$key]=(($arrray[$module[$i]]['fullpoints'][$key])/($arrray[$module[$i]]['quizpoints'][$key]));
$count++;
$moduleavg=$moduleavg+$arrray[$module[$i]]['avg'][$key];

 }
$results[$i]=$moduleavg/$count;
}

return view('admin.radarstudent',compact('arrray','results','module'));
}
public function viewCreateClass()
{
    return view('admin.addclass');
    # code...
}
public function addclass(Request $request)
{           $class = new Classroom();
            $class->class_name=$request->classroom;
            $class->academic_year=$request->academic_year;

            $class->save();

return redirect()->route('view.classroom.list')->with('success','you have create a classroom');
        }

public function profileadmin()
{
    $user=Auth::user();
        $id=Auth::id();
        $admin=admin::where('user_id',$id)->get();
        return view('admin.profileadmin',compact('admin'));
    # code...
}
public function UpdateAdmin(Request $request)
    {       $admin=admin::where('id',$request->a_id)->first();

        $request->validate([



            'firstname' => ['required', 'string', 'alpha', 'max:255'],
            'lastname' => ['required', 'string','alpha', 'max:255'],


       ]);




       $admin->firstname=$request->firstname;
       $admin->lastname=$request->lastname;







       $admin->save();
     return redirect()->route('profile.admin')->with('success','you have update your profile successufuly');

    }
        public function deleteclassroom(classroom $classroom)
        {
            $classroom->delete();
            return redirect()->back()->with('success','delete classroom successufuly');        }


            public function viewinfoclass(classroom $classroom)
            {
                $data1['module']=array('math','arabic','french','history','english');


                $academic_level=academic_level::all();
$students=student::join('users','users.id','=','student.user_id')
->join('class_user','class_user.user_id','=','users.id')
->where(['users.role'=>'student','class_user.class_id'=>$classroom->id])
->select('student.*','class_user.academic_level','class_user.academic_year')
->get();
$teachers=teacher::join('class_teacher','teachers.id','=','class_teacher.teacher_id')
->where('class_teacher.class_id',$classroom->id)
->select('teachers.*','class_teacher.module')
->get();
$count=0;

for ($i=0; $i <count($data1['module']) ; $i++) {
foreach ($teachers as $key => $value) {
    # code...

    if ($data1['module'][$i]==$value->module) {
        $data1['teachers'][$i]=$value;
        $count++;

    }
    }
}

return view('admin.viewclassroominfo',compact('teachers','students','academic_level','classroom','data1'));   }
public function deletestudentfromclasss(classroom $classroom,student $student )
{
$class_student=class_user::where('user_id',$student->user_id);
$class_student->delete();
return redirect()->back()->with('success','you have delete student from class');
    # code...
}
public function pointsstudents()
{
    $students=student::all();
    foreach ($students as $student) {
        if($student->points==null){

            $point=new point();
            $point->student_id=$student->id;
            $point->points=0;
            $point->save();
        }

    }
    # code...
}
public function badgestudents()
{
    $array=['hint','removeoption'];
    $students=student::all();
    foreach ($students as $student) {
        if($student->badge==null){
for ($i=0; $i < 2; $i++) {
    # code...
    $point=new badge();


    $point->student_id=$student->id;
    $point->name=$array[$i];
    $point->count=0;

    $point->save();
}
            $point=new point();
            $point->student_id=$student->id;
            $point->points=0;
            $point->save();
        }

    }
    # code...
}

public function deleteteacherfromclasss(classroom $classroom,teacher $teacher,$data1 )
{
$class_teacher=class_teacher::where('module',$data1);
$class_teacher->delete();
return redirect()->back()->with('success','you have delete teacher from class');
    # code...
}
    public function viewclasses()
    {
        $quiz=result::first();
        $classes=classroom::paginate(8);
        // join('class_user', 'class_user.class_id', '=', 'classroom.id')
        // ->join('users', 'users.id', '=', 'class_user.user_id')
        // ->where('users.role','=','student')
        // ->groupBy('classroom.id')
        // // DB::raw('count(area_id) as connections')
        // ->select('classroom.*',DB::raw('count(users.id) as number_student'))

return view('admin.classes',compact('classes'));

    //     $classfetch=Classroom::where('class_name',$request->class_name)->first();
    //    // return(dd($classfetch));
    //     if ($classfetch==null) {
    //         $class = new Classroom();
    //         $class->class_name=$request->class_name;
    //         $class->save();
    //         // $class_user=new class_user();
    //         // $class_user->user_id=$id;
    //         // $class_user->class_id=$class->id;
    //         // $class_user->save();
    //         return redirect()->route('list.classes');

    //     }else {
    //         return redirect()->back()->with('error','that class   exist');
    //   }


    }
    public function aprove(parents $parent)
    {
    $user=User::find($parent->user_id);
    if ($user->status=='Active') {
        return redirect()->back()->with('error','you have aproved this parent before');
    }
        $user->status='Active';
        $user->save();
        return redirect()->back()->with('success','you have aproved the parent');
        # code...
    }
    public function disactive(parents $parent)
    {
    $user=User::find($parent->user_id);
    if ($user->status=='Suspended') {
        return redirect()->back()->with('error',' this account not active');
    }
        $user->status='Suspended';
        $user->save();
        return redirect()->back()->with('success','you have Suspended this account');
        # code...
    }

    //      ////////////////        teachers /////////////////////////////
    public function teacherview(Teacher $teacher)
    {
        return view('admin.viewprofileteacher',compact('teacher'));
        # code...
    }
    public function parentview(Parents $parent)
    {
        return view('admin.viewprofileparent',compact('parent'));
        # code...
    }
    public function teacheredit(Teacher $teacher)
    {
        return view('admin.viewprofileteacher',compact('teacher'));
    }
    public function deleteoneTeacher(Teacher $teacher)
    {
        $user=User::where('id',$teacher->user_id);
        $user->delete();
        $teacher->delete();
        return redirect()->back()->with('success','delete teacher successufuly');
    }
    public function UpdateTeacher(Request $request)
    {       $teacher=teacher::where('id',$request->t_id)->first();

        $request->validate([

'teacher_id' => ['required', 'digits:16'],

            'firstname' => ['required', 'string', 'alpha', 'max:255'],
            'lastname' => ['required', 'string','alpha', 'max:255'],
            'birth_date' => ['required'],
            'sex' => 'required',

            'email' => 'unique:users,email,'.$teacher->user_id,

            'grade' => 'required',

       ]);




        $teacher->teacher_id=$request->teacher_id;
       $teacher->firstname=$request->firstname;
       $teacher->lastname=$request->lastname;
       $teacher->birth_date=$request->birth_date;
       $teacher->sex=$request->sex;



       if ($request->address) {
        $teacher->address=$request->address;
       }
         if ($request->grade) {
        $teacher->grade=$request->grade;
       }
       if ($request->marital_situation) {
        $teacher->marital_situation=$request->marital_situation;
       }


       $teacher->save();
     return redirect()->route('teachers.view',$teacher)->with('success','update information of teacher successufuly');

    }
    ////            teachers               //////////////////
    public function destroy(question $question){
        $question->delete();
        return redirect()->route('quizs.show')->with('success','question delete successfully');

    }
    public function statStudent(student $student,Request $request)
    {
        $math1=result::join('quiz', 'quiz.id', '=', 'results.quiz_id')
 ->where('results.user_id',$student->user_id)
 ->where('quiz.module','=','math')
 ->select('results.*','quiz.title','quiz.created_at','quiz.user_id AS creator')
 ->orderBy('creator')
 ->orderBy('quiz.created_at')


 ->get()
 ;
 $arabic1=result::join('quiz', 'quiz.id', '=', 'results.quiz_id')
 ->where('results.user_id',$student->user_id)
 ->where('quiz.module','=','arabic')
 ->select('results.*','quiz.title','quiz.created_at','quiz.user_id AS creator')
 ->orderBy('creator')
 ->orderBy('quiz.created_at')


 ->get()
 ;
 $french1=result::join('quiz', 'quiz.id', '=', 'results.quiz_id')
 ->where('results.user_id',$student->user_id)
 ->where('quiz.module','=','french')
 ->select('results.*','quiz.title','quiz.created_at','quiz.user_id AS creator')
 ->orderBy('creator')
 ->orderBy('quiz.created_at')


 ->get()
 ;
$module1=['math','arabic','french'];
 $arrray1=[];

 for ($i=0; $i <3 ; $i++) {
    if ($i==0) {
        $mod1=$math1;
    } elseif ($i==1) {
    //    $mod1=$arabic1;
    }else {
        $mod1=$french1;
    }

    $count1=0;
    $moduleavg1=0;
 foreach ($mod1 as $key => $value) {
     # code...
     $arrray1[$module1[$i]]['title'][$key]=$value->title;
     $arrray1[$module1[$i]]['quizpoints'][$key]=$value->quiz->totalPoint();
     $arrray1[$module1[$i]]['fullpoints'][$key]=$value->fullpoint;
     $arrray1[$module1[$i]]['avg'][$key]=(($arrray1[$module1[$i]]['fullpoints'][$key])/($arrray1[$module1[$i]]['quizpoints'][$key]));
$count1++;
$moduleavg1=$moduleavg1+$arrray1[$module1[$i]]['avg'][$key];

 }
$results1[$i]=$moduleavg1/$count1;
}

        $data=[];
        $class_id=$student->user->classes->first();
        $module=$request->get('module');
        if ($module) {
            # code...
            $results=result::join('quiz', 'quiz.id', '=', 'results.quiz_id')
->where('results.user_id',$student->user_id)
->where('quiz.module','=',$module)
->select('results.*','quiz.title','quiz.created_at','quiz.user_id AS creator')
->orderBy('creator')
->orderBy('quiz.created_at')


->get()
;
$arrray=[];
foreach ($results as $key => $value) {
    # code...
    $arrray['label'][$key]=$value->title;
    $arrray['quizpoints'][$key]=$value->quiz->totalPoint();
    $arrray['fullpoints'][$key]=$value->fullpoint;

}
$arrray['module']=$module;
$are=[];
foreach ($arrray['fullpoints'] as $key => $value) {
    # code...
    $are[$key]=20*($value - min($arrray['fullpoints']))/(max($arrray['fullpoints'])- min($arrray['fullpoints']));

}

return view('admin.statstudent',compact('student','results','arrray','are','module','arrray1','results1','module1'));

        }
//         $teachers=User::join('class_user','class_user.user_id', '=', 'users.id')
// ->where('class_user.class_id',$class_id->id)
// ->where('users.role','teacher')->get();

$results=result::join('quiz', 'quiz.id', '=', 'results.quiz_id')
->where('results.user_id',$student->user_id)
->where('quiz.module','=','math')
->select('results.*','quiz.title','quiz.created_at','quiz.user_id AS creator')
->orderBy('creator')
->orderBy('quiz.created_at')


->get()
;
$arrray=[];
foreach ($results as $key => $value) {
    # code...
    $arrray['label'][$key]=$value->title;
    $arrray['quizpoints'][$key]=$value->quiz->totalPoint();
    $arrray['fullpoints'][$key]=$value->fullpoint;

}
$arrray['module']=$module;
$are=[];
foreach ($arrray['fullpoints'] as $key => $value) {
    # code...
    $are[$key]=20*($value - min($arrray['fullpoints']))/(max($arrray['fullpoints'])- min($arrray['fullpoints']));

}

return view('admin.statstudent',compact('student','results','arrray','are'));

    }


    public function changeStatus(Request $request)
    {
        $user = User::find($request->user_id);
            # code...
            if ($user->status=='Active') {
                $user->status = 'Suspended';

            }else {
                $user->status='Active';
            }


        $user->save();

        return response()->json(['success'=>'Status change successfully.']);
    }



    public function studentview(Student $student)
    {$academic_level=academic_level::all();
        $countries=CountryListFacade::getList('en');
        $results=result::join('quiz', 'quiz.id', '=', 'results.quiz_id')
->where('results.user_id',$student->user_id)

->select('results.*','quiz.title','quiz.created_at','quiz.user_id AS creator')
->orderBy('creator')
->orderBy('quiz.created_at')


->get()
;
        return view('admin.viewprofile',compact('student','academic_level','countries','results'));
        # code...
    }

    public function studentedit(Student $student)
    {
        $academic_level=academic_level::all();
$countries=CountryListFacade::getList('en');
$results=result::join('quiz', 'quiz.id', '=', 'results.quiz_id')
->where('results.user_id',$student->user_id)

->select('results.*','quiz.title','quiz.created_at','quiz.user_id AS creator')
->orderBy('creator')
->orderBy('quiz.created_at')


->get()
;

        return view('admin.viewprofile',compact('student','academic_level','countries','results'));
        # code...
    }

    public function UpdateStudent(Request $request)
    {
        $request->validate([

'student_id' => ['required', 'digits:16'],

            'firstname' => ['required', 'string', 'alpha', 'max:255'],
            'lastname' => ['required', 'string','alpha', 'max:255'],
            'birth_date' => ['required'],
            'sex' => 'required',

            'email' => ['required'],

            'nationality' => 'required',

       ]);

       $student=student::where('id',$request->stud_id)->first();
       $student->student_id=$request->student_id;

       $student->firstname=$request->firstname;
       $student->lastname=$request->lastname;
       $student->birth_date=$request->birth_date;
       $student->sex=$request->sex;


       if ($request->academic_level) {
        $student->academic_level=$request->academic_level;
       }
       if ($request->address) {
        $student->address=$request->address;
       }
         if ($request->nationality) {
        $student->nationality=$request->nationality;
       }


       $student->save();
     return redirect()->route('students.list')->with('success','update information of student successufuly');

    }
public function teacherlistsearch(Request $request)
{
    $query=$request->get('query');
    if ($query) {
    # code...
    $teachers=teacher::where('firstname','LIKE','%'.$query.'%')
    ->orWhere('lastname','LIKE','%'.$query.'%')

    ->orderBy('firstname','asc')
    ->paginate(8);


            return view('admin.listteachers',compact('teachers'));
    }
}
    public function studentlistsearch(Request $request)
    {
        # code...
$academic_level=$request->academic_level;
$group=$request->group;

       if ($query=$request->get('query')) {


        ////////////////////////////////////
            if (!empty($academic_level) or !empty($group)) {
                # code...
                if (empty($academic_level)) {
                    # code...
                    $students=student::join('student', 'users.id', '=', 'quiz.user_id')
                    ->select('quiz.*','users.name','users.email')
                    ->where('firstname','LIKE','%'.$query.'%')

                    ->orderBy('title', $order)
                    ->paginate(5);
                    $students=student::join('users', 'users.id', '=', 'student.user_id')
->join('class_user','class_user.user_id', '=', 'student.user_id')
->join('classroom','classroom.id', '=', 'class_user.class_id')
->select('student.*','classroom.class_name')
->get();
$classrooms=classroom::all();


                } elseif (empty($order)) {
                    $quizs=quiz::join('users', 'users.id', '=', 'quiz.user_id')
                    ->select('quiz.*','users.name','users.email')
                    ->where('title','LIKE','%'.$query.'%')
                    ->Where('visibility',$visibility)
                    ->where('user_id', Auth::user()->id)

                    ->paginate(5);
                } else{
                    $quizs=quiz::join('users', 'users.id', '=', 'quiz.user_id')
                    ->select('quiz.*','users.name','users.email')
                    ->where('title','LIKE','%'.$query.'%')
                    ->where('user_id', Auth::user()->id)

                    ->orderBy('title', $order)
                    ->Where('visibility',$visibility)
                    ->paginate(5);



            }



                        /////////////////////////////////////////
                }}


$students=student::join('users', 'users.id', '=', 'student.user_id')
->join('class_user','class_user.user_id', '=', 'student.user_id')
->join('classroom','classroom.id', '=', 'class_user.class_id')
->select('student.*','classroom.class_name')
->get();
$classrooms=classroom::all();
        return view('admin.liststudent',compact('students','classrooms'));
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
    public function pageAddTeacher(Type $var = null)
    {$string = str_random(10);

        return view('admin.addteacher',compact('string'));

        # code...
    }
public function pageAddStudent()
{
$academic_level=academic_level::all();
$string = str_random(10);
            $countries=CountryListFacade::getList('en');
            $classrooms=classroom::all();
    return view('admin.addstudent',compact('academic_level','countries','string','classrooms'));
    # code...
}
public function AddTeachernew(Request $request)
{
    $request->validate([
        'teacher_id' => ['required', 'digits:16','unique:teachers'],

        'firstname' => ['required', 'string', 'alpha', 'max:255'],
        'lastname' => ['required', 'string','alpha', 'max:255'],
        'birth_date' => ['required'],

        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8'],



    ]);

    $user=User::create([
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => "teacher",

    ]);
//         $student=Student::create([
//     'user_id' => $user->id,
//     'firstname' => $request->firstname,
//     'lastname' => $request->lastname,
//     'birth_date' => $request->birth_date,
//     'sex' => $request->sex,
//     'address' => $request->address,
//     'nationality' => $request->nationality,
//     'academic_level' => $request->academic_level,
//     'student_id' => $request->student_id,


// ]);
$teacher=new teacher();
$teacher->user_id =$user->id;
$teacher->firstname =$request->firstname;
$teacher->lastname =$request->lastname;
$teacher->birth_date = $request->birth_date;
$teacher->sex = $request->sex;
$teacher->address = $request->address;
$teacher->grade =$request->grade;
$teacher->marital_situation =$request->marital_situation;


$teacher->teacher_id = $request->teacher_id;
$teacher->save();

return redirect()->route('teachers.list')->with('success','you have added a teacher successufuly');
    # code...
}
     public function AddStudentnew(Request $request)
     {


        $request->validate([
            'student_id' => ['required', 'digits:16'],

            'firstname' => ['required', 'string', 'alpha', 'max:255'],
            'lastname' => ['required', 'string','alpha', 'max:255'],
            'birth_date' => ['required'],
            'nationality' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],



        ]);

        $user=User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'student_id'=> $request->student_id,

        ]);
//         $student=Student::create([
//     'user_id' => $user->id,
//     'firstname' => $request->firstname,
//     'lastname' => $request->lastname,
//     'birth_date' => $request->birth_date,
//     'sex' => $request->sex,
//     'address' => $request->address,
//     'nationality' => $request->nationality,
//     'academic_level' => $request->academic_level,
//     'student_id' => $request->student_id,


// ]);
$student1=new student();
$student1->user_id =$user->id;
$student1->firstname =$request->firstname;
$student1->lastname =$request->lastname;
$student1->birth_date = $request->birth_date;
$student1->sex = $request->sex;
$student1->address = $request->address;
$student1->nationality =$request->nationality;
$student1->student_id = $request->student_id;
$student1->academic_level = $request->academic_level;
$student1->save();
$students=student::all();
        $point=new point();
        $point->student_id=$student->id;
        $point->points=10;
        $point->save();

// $class_user=new class_user();
// $class_user->user_id=$student1->user_id;
// $class_user->class_id=$request->class_id;
// $class_user->save();
return redirect()->route('students.list')->with('success','added student successufuly');


     }
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

    public function deleteStudent(student $student)
    {
        $user=User::where('id',$student->user_id);
        $user->delete();
        $student->delete();
        return redirect()->back()->with('success','delete student successufuly');
    }
public function savemoduleteacher(Request $request)

{
    $counttt=0;
    if ($request->allmod) {
    $module=['math','arabic','french','history','math','english'];
    $arr=[];
    foreach ($module as $item) {
        # code...


    $cteachers=class_teacher::where(['teacher_id'=>$request->teacher_id,'module'=>$item])->get();
    $classmodule=class_teacher::where(['class_id'=>$request->classroom_id,'module'=>$item])->first();

if (count($cteachers)==0) {
    # code..
    if ($classmodule==null) {
        # code...
        $arr[$counttt]=$item;

        $counttt++;

        $class_teacher=new class_teacher();
        $class_teacher->teacher_id=$request->teacher_id;
        $class_teacher->class_id=$request->classroom_id;
        $class_teacher->module=$item;
        // $class_teacher->year=$request->academic_year;
        $class_teacher->save();
    }
    else {
        # code...

        $classmodule->teacher_id=$request->teacher_id;
        $classmodule->class_id=$request->classroom_id;
        $classmodule->module=$item;
        // $class_teacher->year=$request->academic_year;
        $classmodule->save();
    }

}

}
}
    if ($request->module) {

        $class_teacher=new class_teacher();
        $cteachers=class_teacher::where(['teacher_id'=>$request->teacher_id,'module'=>$request->module])->get();
        $class_teacher->teacher_id=$request->teacher_id;
        $class_teacher->class_id=$request->classroom_id;
        $class_teacher->module=$request->module;

        $datee=Carbon::now();
        if ($datee->month>5) {
            # code...
                    $class_teacher->year=$datee->year-1;


        }else {
            # code...
            $class_teacher->year=$datee->year;


        }

        // $class_teacher->year=$request->academic_year;
        $class_teacher->save();
        return redirect()->back();
    }

    $module=$request->module;
    foreach ($module as $item) {
        # code...

    $class_teacher=new class_teacher();
    $cteachers=class_teacher::where(['teacher_id'=>$request->teacher_id,'module'=>$item])->get();

if (count($cteachers)==0) {
    # code...
    $class_teacher->teacher_id=$request->teacher_id;
    $class_teacher->class_id=$request->classroom_id;
    $class_teacher->module=$item;
    // $class_teacher->year=$request->academic_year;
    $class_teacher->save();
}

}
return redirect()->back();


    # code...
}

public function savestudenttoclass(Request $request)

{
    $student=student::find($request->student_id);
    $student_class=class_user::where(['user_id'=>$student->user_id,'class_id'=>$request->classroom_id])->first();
    $classroom=classroom::find($request->classroom_id);

        # code...
        if ($student_class==null) {
            # code...
            $student_class1= new class_user();
            $student_class1->class_id=$request->classroom_id;

            $student_class1->user_id=$student->user_id;
            $datee=Carbon::now();

            if ($datee->month>5) {
                # code...
                $acayear=  strval($datee->year).'-'. strval($datee->year-1);
                                        $student_class1->academic_year=$acayear;


            }else {
                # code...
                $acayear=  strval($datee->year+1).'-'. strval($datee->year);
                                        $student_class1->academic_year=$acayear;


            }
            // $class_teacher->year=$request->academic_year;
            $student_class1->save();
        }

return redirect()->route('classroom.view',compact('classroom'));

}




public function addstudtoclass(classroom $classroom,Request $request)
{      $query=$request->get('query');
    if ($query) {
    # code...
    $students=student::where('firstname','LIKE','%'.$query.'%')
    ->orWhere('lastname','LIKE','%'.$query.'%')
    ->orWhere('student_id','LIKE','%'.$query.'%')
    ->orderBy('firstname','asc')
    ->paginate(8);


    }else{
        $students = student::paginate(8);

    }



return view('admin.choosestudent',compact('students','classroom')) ;   }
    public function indacteclass(classroom $classroom,$data1,Request $request)
    {      $query=$request->get('query');
        if ($query) {
        # code...
        $teachers=teacher::where('firstname','LIKE','%'.$query.'%')
        ->orWhere('lastname','LIKE','%'.$query.'%')
        ->orWhere('teacher_id','LIKE','%'.$query.'%')
        ->orderBy('firstname','asc')
        ->paginate(8);


        }else{
            $teachers = teacher::paginate(8);

        }


        $module=['math','arabic','french','history','math','english'];

return view('admin.chooseteacher',compact('teachers','module','classroom','data1')) ;   }
    public function showEmployee(Request $request)   {
               if($request->keyword != ''){
                   $teacherss = Employee::where('name','LIKE','%'.$request->keyword.'%')->get();
                   }
                        return response()->json([         'teacherss' => $teachers      ]);    }


    public function teacherlist()
    {
        # code...

$teachers=teacher::orderBy('firstname','asc')
->paginate(8);

        return view('admin.listteachers',compact('teachers'));
    }

    public function studentlist()
    {
        # code...

$students=student::join('users', 'users.id', '=', 'student.user_id')

->select('student.*')
->orderBy('firstname','asc')
->paginate(8);
$academic_level=academic_level::all();

$classrooms=classroom::all();
        return view('admin.liststudent',compact('students','classrooms','academic_level'));
    }

    public function parentlist()
    {
        # code...

$parents=parents::orderBy('full_name','asc')
->paginate(8);
$academic_level=academic_level::all();
$classrooms=classroom::all();
        return view('admin.listparents',compact('parents'));
    }



    public function listquery(Request $request)
    {
        $query=$request->get('query')  ;
        $academic_level=$request->get('academic_level');
        $academic_year=$request->get('academic_year');
$group=$request->get('group');
        if ($query) {

  if ($academic_level && $academic_year && $group ) {
    $students=student::join('users', 'users.id', '=', 'student.user_id')
    ->join('class_user','class_user.user_id', '=', 'student.user_id')
    ->join('classroom','classroom.id', '=', 'class_user.class_id')
    ->where([['student.firstname','LIKE','%'.$query.'%'],['student.academic_level',$academic_level],['classroom.id',$group],['class_user.academic_year',$academic_year]])
    ->orWhere([['student.lastname','LIKE','%'.$query.'%'],['student.academic_level',$academic_level],['classroom.id',$group],['class_user.academic_year',$academic_year]])


    ->select('student.*','classroom.class_name','class_user.academic_year')

    ->orderBy('firstname','asc')
    ->paginate(8);
    $academic_level=academic_level::all();

    $classrooms=classroom::all();
            return view('admin.liststudent',compact('students','classrooms','academic_level'));
  }
  if (empty($academic_level) && $academic_year && empty( $group) ) {
    $students=student::join('users', 'users.id', '=', 'student.user_id')
    ->join('class_user','class_user.user_id', '=', 'student.user_id')
    ->join('classroom','classroom.id', '=', 'class_user.class_id')
    ->where([['student.firstname','LIKE','%'.$query.'%'],['class_user.academic_year',$academic_year]])
    ->orWhere([['student.lastname','LIKE','%'.$query.'%'],['class_user.academic_year',$academic_year]])


    ->select('student.*','classroom.class_name','class_user.academic_year')

    ->orderBy('firstname','asc')
    ->paginate(8);
    $academic_level=academic_level::all();

    $classrooms=classroom::all();
            return view('admin.liststudent',compact('students','classrooms','academic_level'));
  }
  if ($academic_level && empty($academic_year) && $group ) {
    $students=student::join('users', 'users.id', '=', 'student.user_id')
    ->join('class_user','class_user.user_id', '=', 'student.user_id')
    ->join('classroom','classroom.id', '=', 'class_user.class_id')
    ->where([['student.firstname','LIKE','%'.$query.'%'],['student.academic_level',$academic_level],['classroom.id',$group]])
    ->orWhere([['student.lastname','LIKE','%'.$query.'%'],['student.academic_level',$academic_level],['classroom.id',$group]])


    ->select('student.*','classroom.class_name','class_user.academic_year')

    ->orderBy('firstname','asc')
    ->paginate(8);
    $academic_level=academic_level::all();

    $classrooms=classroom::all();
            return view('admin.liststudent',compact('students','classrooms','academic_level'));
  }
  if ($academic_level && empty($academic_year) && empty($group) ) {
    $students=student::join('users', 'users.id', '=', 'student.user_id')
    ->join('class_user','class_user.user_id', '=', 'student.user_id')
    ->join('classroom','classroom.id', '=', 'class_user.class_id')
    ->where([['student.firstname','LIKE','%'.$query.'%'],['student.academic_level',$academic_level]])
    ->orWhere([['student.lastname','LIKE','%'.$query.'%'],['student.academic_level',$academic_level]])


    ->select('student.*','classroom.class_name','class_user.academic_year')

    ->orderBy('firstname','asc')
    ->paginate(8);
    $academic_level=academic_level::all();

    $classrooms=classroom::all();
            return view('admin.liststudent',compact('students','classrooms','academic_level'));
  }
  if (empty($academic_level) && empty($academic_year) && empty($group) ) {
    $students=student::join('users', 'users.id', '=', 'student.user_id')
    ->join('class_user','class_user.user_id', '=', 'student.user_id')
    ->join('classroom','classroom.id', '=', 'class_user.class_id')
    ->where('student.firstname','LIKE','%'.$query.'%')
    ->orWhere('student.lastname','LIKE','%'.$query.'%')
    ->select('student.*','classroom.class_name')

    ->orderBy('firstname','asc')
    ->paginate(8);
    $academic_level=academic_level::all();

    $classrooms=classroom::all();
            return view('admin.liststudent',compact('students','classrooms','academic_level'));
  }
  //elseif (condition) {
//     # code...
// } {
//     # code...
// }



        }else {

            if ($academic_level && $academic_year && $group ) {
                $students=student::join('users', 'users.id', '=', 'student.user_id')
                ->join('class_user','class_user.user_id', '=', 'student.user_id')
                ->join('classroom','classroom.id', '=', 'class_user.class_id')
                ->where([['student.academic_level',$academic_level],['classroom.id',$group],['class_user.academic_year',$academic_year]])
                ->orWhere([['student.academic_level',$academic_level],['classroom.id',$group],['class_user.academic_year',$academic_year]])


                ->select('student.*','classroom.class_name','class_user.academic_year')

                ->orderBy('firstname','asc')
                ->paginate(8);
                $academic_level=academic_level::all();

                $classrooms=classroom::all();
                        return view('admin.liststudent',compact('students','classrooms','academic_level'));
              }
              if (empty($academic_level) && $academic_year && empty( $group) ) {
                $students=student::join('users', 'users.id', '=', 'student.user_id')
                ->join('class_user','class_user.user_id', '=', 'student.user_id')
                ->join('classroom','classroom.id', '=', 'class_user.class_id')
                ->where([['class_user.academic_year',$academic_year]])
                ->orWhere([['class_user.academic_year',$academic_year]])


                ->select('student.*','classroom.class_name','class_user.academic_year')

                ->orderBy('firstname','asc')
                ->paginate(8);
                $academic_level=academic_level::all();

                $classrooms=classroom::all();
                        return view('admin.liststudent',compact('students','classrooms','academic_level'));
              }
              if ($academic_level && empty($academic_year) && $group ) {
                $students=student::join('users', 'users.id', '=', 'student.user_id')
                ->join('class_user','class_user.user_id', '=', 'student.user_id')
                ->join('classroom','classroom.id', '=', 'class_user.class_id')
                ->where([['student.academic_level',$academic_level],['classroom.id',$group]])
                ->orWhere([['student.academic_level',$academic_level],['classroom.id',$group]])


                ->select('student.*','classroom.class_name','class_user.academic_year')

                ->orderBy('firstname','asc')
                ->paginate(8);
                $academic_level=academic_level::all();

                $classrooms=classroom::all();
                        return view('admin.liststudent',compact('students','classrooms','academic_level'));
              }
              if ($academic_level && empty($academic_year) && empty($group) ) {
                $students=student::join('users', 'users.id', '=', 'student.user_id')
                ->join('class_user','class_user.user_id', '=', 'student.user_id')
                ->join('classroom','classroom.id', '=', 'class_user.class_id')
                ->where([['student.academic_level',$academic_level]])
                ->orWhere([['student.academic_level',$academic_level]])


                ->select('student.*','classroom.class_name','class_user.academic_year')

                ->orderBy('firstname','asc')
                ->paginate(8);
                $academic_level=academic_level::all();

                $classrooms=classroom::all();
                        return view('admin.liststudent',compact('students','classrooms','academic_level'));
              }


        }
        # code...
    }


}
//app\Http\Controllers\Admin\AdminController.php
