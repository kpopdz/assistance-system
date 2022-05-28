<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Models\user;
use App\Models\Teacher;
use App\Models\Classroom;
use App\Models\class_user;
use App\Models\quiz;
use App\Models\Result;
use App\Models\Question;
use App\Models\quiz_question;
use App\Models\assignment;
use App\Models\collection_quiz;
use App\Models\collection;





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
    $quiz=quiz::where('id',$id)->first();

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
}


     return redirect()->back()->with('success','assignment  successfully to the classes');

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


}
//app\Http\Controllers\Admin\AdminController.php
