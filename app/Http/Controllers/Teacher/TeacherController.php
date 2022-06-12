<?php

namespace App\Http\Controllers\Teacher;
use App\Events\MyEvent;

use Illuminate\Http\Request;
use App\Models\user;
use Illuminate\Support\Facades\DB;
use App\Models\Teacher;
use App\Models\course;
use App\Models\course_quiz;

use App\Models\Classroom;
use App\Models\class_user;
use App\Models\quiz;
use App\Models\Result;
use App\Models\Question;
use App\Models\quiz_question;
use App\Models\assignment;
use App\Models\collection_quiz;
use App\Models\collection;
use App\Models\share_quiz;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewUserNotification;
use App\Events\NewNotification;





use Auth;


use App\Http\Controllers\Controller;


class TeacherController extends Controller
{

   public function __construct()
   {
       $this->middleware('isteacher');
   }
    public function showMyQuizs ()
    {
            $user=Auth::user();
            $id=Auth::id();
            $quizs=quiz::where('user_id', Auth::user()->id)->get();
           // $quizs=quiz::all();
            return view ('quiz.index',compact('quizs'));
    }

public function profile(Request $request)
{   // return dd($request->all());


 //   return dd($request->all());
  $teacher=new teacher();
 $user=Auth::user();
 $id=Auth::id();

$teacher->user_id=$id;
 $teacher->firstname=$request->firstname;
 $teacher->lastname=$request->lastname;
 $teacher->birth_date=$request->birthdate;
 $teacher->sex=$request->sex;
 $teacher->save();




return view('home');


}
public function showClasses()
{
    $user=Auth::user();
    $id=Auth::id();
    $quizs=quiz::where('user_id',$id)
    // ->where('publish',1)
    ->get();
    $users=User::whereId($id)->first();
    $class=Classroom::where('id',1)->first();

  //  return dd($users->teacher->count());
    return view('teacher.classes',compact('users','quizs'));
    $cc=User::with('classes')
    ->whereId($id)->first();
}
public function notify()
{
    if (auth()->user()) {
    $user=User::first();

    auth()->user()->notify(new NewUserNotification($user));
}
    # code...
}
public function quizforclass(Request $request,$id)
{    $class_id = $request->input('class_id');
    $user=Auth::user();

    $quiz=quiz::where('id',$id)->first();
    $users=User::join('class_user','class_user.user_id','=','users.id')
    ->where(['class_user.class_id'=>$class_id,'role'=>'student'])
    ->select('users.*')
    ->get();

    $quiz->save();
foreach ($class_id as $key => $value) {
    $assign=assignment::where(['quiz_id'=>$quiz->id,'class_id'=>$value])->first();

    if ($assign) {
        return redirect()->back()->with('error','you  assigne this quiz to selected classes before');
    }
    $assignment=new assignment();
    $assignment->quiz_id=$quiz->id;
    $assignment->class_id=$value;
    $assignment->dead_line=$request->dead_line;

    $assignment->save();
    $data=[            'user_id'=>$user['id'],
    'name'=>$user->name,
    'email'=>$user->email,
    'dead_line'=>$assignment->dead_line,
    'title'=>$quiz->title];
    event(new newNotification($data));
    Notification::send($users, new NewUserNotification($user,$assignment,$quiz));
// }foreach ($users as $user) {
//     auth()->user()->notify(new NewUserNotification($user,$assignment,$quiz));
//
}



     return redirect()->back()->with('success','assignment  successfully to the classes');

}

public function classlevel()
{$array=[];
    $array1=[];
    $array2=[];
    $user=Auth::user();

$i=0;
$j=0;
$k=0;


    $quizs=quiz::with(['resultavg','questionsumpoint'])
    ->where('user_id',$user->id)->distinct('id')->groupby('id')
    ->join('assignment','quiz.id','=','assignment.quiz_id')
    ->select('quiz.*')
    ->get();
    foreach ($quizs as $quiz) {
        # code...
        if ($quiz->result()->avg('fullpoint')!== null) {
            # code...
            if ($quiz->result()->avg('fullpoint')>(($quiz->totalPoint())*0.75)) {
                $array[$i]=$quiz;
                $i++;
            }elseif ($quiz->result()->avg('fullpoint')<(($quiz->totalPoint())*0.5)) {
                $array1[$j]=$quiz;
    $j++;        }else {
                # code...
                $array2[$k]=$quiz;
    $k++;
            }
        }


    }
        // $qu2=$quizs->result()->avg('fullpoint');

return view('teacher.stat.fullstate',compact('quizs','array','array1','array2'));    # code...
}

public function uploadcourse(Request $request)
{
    $request->validate([
        'name' => ['required'],

        'pdf' => ['required'],



    ]);
    $user=Auth::user();
    $id=Auth::id();
       $quiz_id = $request->input('quiz_id');


    $course=new course();
    $course->user_id=$id;

    $course->name=$request->name;
    $pdf_extension = $request->pdf->getClientOriginalExtension();
    // $quiz->  visibility = request('visibility');
    // $quiz->image= 'uploads/quiz/' . $filename;

     $pdf = $request->pdf;
     // $image->getClientOriginalName()
       $filename= time().'.'.$pdf->getClientOriginalName().$pdf_extension;
       $path='uploads/pdf';
       $request->pdf->move($path,$filename);
       $course->file_pdf= 'uploads/pdf/' . $filename;
       if ( $request->video !== null) {
        $video_extension = $request->video->getClientOriginalExtension();
        // $quiz->  visibility = request('visibility');
        // $quiz->image= 'uploads/quiz/' . $filename;

         $video = $request->video;
         // $image->getClientOriginalName()
           $filename= $video->getClientOriginalName();
           $path='uploads/video';
           $request->video->move($path,$filename);
           $course->file_video= 'uploads/video/' . $filename;
       }
$course->save();
foreach ($quiz_id as $key => $value) {
    $course_quiz=new course_quiz();
    $course_quiz->quiz_id=$value;
    $course_quiz->course_id=$course->id;
$course_quiz->save();
}
}
public function viewcourse(course $course)
{

    return view('teacher.create course', compact('course'));}

    public function viewcourses()
    {
        $user=Auth::user();
    $id=Auth::id();
        $courses=course::where('user_id',$id)->get();
        return view('teacher.listcourses', compact('courses'));

    }
    public function deletecourse(course $course)
    {
        $course->delete();
        return redirect()->back();
    }

    public function pageshare(quiz $quiz)
    {
        $user=Auth::user();
    $id=Auth::id();
        $teachers=User::where('role','teacher')
        ->where('id','!=',$id)->get();
        return view('teacher.sharequiz',compact('quiz','teachers'));
    }
    public function sharequiz(Request $request)
    {$ids=$request->teacher_id;
         if ($request->type_share=='teacher') {

foreach ($ids as $key => $value) {
    $teacher=teacher::where('user_id',$value)->first();
$share_quiz=new share_quiz();
$share_quiz->quiz_id=$request->quiz_id;
$share_quiz->teacher_id=$teacher->id;
$share_quiz->type_share=$request->type_share;
$share_quiz->save();
return redirect()->back()->with('success','you have share quiz this teachers');

}
dd($request->type_share);

    }else {
        foreach ($ids as $key => $value) {
            $teacher=teacher::where('user_id',$value)->first();
            $share_quiz=new share_quiz();
            $share_quiz->quiz_id=$request->quiz_id;
            $share_quiz->teacher_id=$teacher->id;
            $share_quiz->type_share='collaborators';
            $share_quiz->save();

    }

    }

    }
public function liveQuizforclass(Request $request,$id)
{

    $request->validate([
        'class_id' => ['required'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        'role' => 'required',
        'firstname' => ['required', 'string', 'alpha', 'max:255'],
        'lastname' => ['required', 'string','alpha', 'max:255'],
        'birth_date' => ['required'],
        'sex' => 'required',
        'nationality' => 'required',


    ]);

        $class_id = $request->input('class_id');
    // $duration=Carbon::createFromFormat('i', $request->duration)->format('H:i:s') ;
    // $quizDuration = Carbon::now()->addMinutes(  30  );
    // $dur=$duration->minute();
    $duration= $request->duration;

    $quiz=quiz::where('id',$id)->first();


    // $quiz->save();
foreach ($class_id as $key => $value) {
    $assign=assignment::where(['quiz_id'=>$quiz->id,'class_id'=>$value,'type_quiz'=>'live'])->first();

    if ($assign) {
        return redirect()->back()->with('error','you  Schedule this live quiz to selected classes before');
    }

    $assignment=new assignment();
    $assignment->quiz_id=$quiz->id;
    $assignment->class_id=$value;
    $assignment->type_quiz='live';

    $assignment->code_enter=$request->code_enter;
    $assignment->start_time=$request->start_time;
    $assignment->duration=$request->duration;


    $assignment->save();
}


     return redirect()->back()->with('success','Schedule quiz live  successfully to the classes');

}
public function CreateClass(Request $request)
{
    $user=Auth::user();
    $id=Auth::id();
    $classfetch=Classroom::where('class_name',$request->class_name)->first();
   // return(dd($classfetch));
    if ($classfetch==null) {
        $class = new Classroom();
        $class->class_name=$request->class_name;
        $class->save();
        $class_user=new class_user();
        $class_user->user_id=$id;
        $class_user->class_id=$class->id;
        $class_user->save();
        return redirect()->route('teacher.classes');

    }else {
        return redirect()->back()->with('error','that class   exist');
  }


}

public function MyQuizs()
{
    $id=Auth::id();

    $quizs=quiz::where('user_id',$id)
    ->join('assignment','quiz.id','=','assignment.quiz_id')
    ->select('quiz.*')
    ->distinct()
    ->get();
    # code...
    return view('teacher.myquizs',compact('quizs'));
}
public function results($id)
{
    $results=Result::where('quiz_id',$id)
    ->join('class_user','class_user.user_id','=','results.user_id')
    ->join('classroom','classroom.id','=','class_user.class_id')
    ->select('results.*','classroom.class_name')
    ->groupBy('class_name')
    ->get();
   // return dd(count($results));
    return view('teacher.results',compact('results'));

}
public function showresult($id)
{
    //

    $result = Result::find($id);

    return view('results.show', ['result' => $result]);

}
public function importQuestion($id)
{$quizs=quiz::where('visibility','Public')->get();
    $data=[];
    foreach ($quizs as $key => $value) {
        # code...
        $data[$key]=$value->id;
    }

    $questions=Question::join('quiz_question', 'questions.id', '=', 'quiz_question.question_id')

    ->select('questions.*')
     ->whereIn('quiz_id',$data)
     ->distinct()
    ->get();

//return dd($questions);
    return view ('teacher.listquestion',compact('questions','id'));


}
public function importoquiz(Request $request,$id)
{
    $quiz=quiz::where('id',$request->quizid)->first();
$quiz_question=new quiz_question();
$quiz_question->quiz_id=$request->quizid;
$quiz_question->question_id=$id;
$quiz_question->save();

return redirect()->route('quizs.show',compact('quiz'))->with('success','question imported successfully to the quiz');
    # code...
}
public function assigne()
{
    $user=Auth::user();
    $id=Auth::id();
    $classes= Classroom::join('class_user', 'users.id', '=', 'class_user.user_id')
    ->where('')
    ->select('quiz.*','users.name','users.email');
    # code...
}
public function stepOneToFinish(quiz $quiz)
{
    return view('teacher.finishquiz',compact('quiz'));

}

public function addToFav2(quiz $quiz)
{    $user=Auth::user();
    $id=Auth::id();
    $favorite=collection::where(
        ['name'=>'favorite','user_id'=>$id]
    )->first();
    //  return(dd($favorite));
    if ($favorite!=null){

        $collection_quiz=collection_quiz::where(
            ['quiz_id'=>$quiz,'collection_id'=>$favorite->id]
        )->first();
        if ($collection_quiz) {
            # code...
            return  redirect()->back();
        }else {
            # code...
            $collection_quiz=new collection_quiz();
            $collection_quiz->quiz_id=$quiz->id;
            $collection_quiz->collection_id=$favorite->id;
            $collection_quiz->save();
            return  redirect()->route('quizs.index');
        }



    }else {
        $favorite=new collection();
        $favorite->name="favorite";
        $favorite->user_id=$id;
        $favorite->save();

        $collection_quiz=collection_quiz::where(
            ['quiz_id'=>$quiz,'collection_id'=>$favorite->id]
        )->first();
        if ($collection_quiz) {
            # code...
            return  redirect()->back();
        }else {
            # code...
            $collection_quiz=new collection_quiz();
            $collection_quiz->quiz_id=$quiz->id;
            $collection_quiz->collection_id=$favorite->id;
            $collection_quiz->save();
            return  redirect()->route('quizs.index');
        }
        # code...
    }
}
public function duplicateQuiz(quiz $quiz)
{
    $user=Auth::user();
    $id=Auth::id();
    $quizCopy=$quiz->replicate();
    $quizCopy->user_id=$id;
    $quizCopy->created_at=Carbon::now();
    $quizCopy->save();
    foreach ($quiz->question as $question) {
$questionCopy=$question->replicate();
$questionCopy->save();

$quiz_question=new quiz_question();
$quiz_question->quiz_id=$quizCopy->id;
$quiz_question->question_id=$question->id;
$quiz_question->save();

foreach ($question->option as $option) {
    # code...
    $optionCopy=$option->replicate();
    $optionCopy->question_id=$questionCopy->id;

}

    }
    return dd($quizCopy,$questionCopy,$optionCopy);
    # code...
}
public function list()
{
    $id=Auth::id();
    $quizs=quiz::where('user_id',$id)
    ->join('assignment','quiz.id','=','assignment.quiz_id')
    ->select('quiz.*')
    ->distinct()
    ->get();
    # code...
    return view('teacher.stat.list',compact('quizs'));
}
public function quiz_stat(quiz $quiz)
{
    return view('teacher.stat.quiz',compact('quiz'));
}
public function createcollection(Request $request)
{    $id=Auth::id();

$collection=new collection();
$collection->name=$request->collection_name;
$collection->user_id=$id;
$collection->save();
if ($request->quiz_id) {
   $collection_quiz=new collection_quiz();
   $collection_quiz->collection_id=$collection->id;
   $collection_quiz->quiz_id=$request->quiz_id;
   $collection_quiz->save();
}
return  redirect()->back();
}


}
//app\Http\Controllers\Admin\AdminController.php
