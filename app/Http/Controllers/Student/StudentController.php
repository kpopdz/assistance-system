<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Models\user;
use App\Models\student;
use App\Models\UserOption;
use App\Models\Result;

use App\Models\quiz;
use App\Models\question;
use App\Models\option;
use App\Models\option_student;
use App\Models\quiz_question;
use App\Models\assignment;

use Carbon\Carbon;

use App\Http\Controllers\Controller;
use Auth;


class StudentController extends Controller
{

   public function __construct()
   {
       $this->middleware('auth');
   }
    public function index ()
    {
        $user=Auth::user();
        $id=Auth::id();
        $user1=user::find($id);
        $data=[];
        $data2=[];

        foreach ($user1->classes as $key => $value) {
            $data[$key]=$value->id;

        }
               $quizs=quiz::join('assignment', 'assignment.quiz_id', '=', 'quiz.id')
               ->join('users', 'users.id', '=', 'quiz.user_id')
               ->join('teachers','users.id', '=', 'teachers.user_id')
               ->whereIn('assignment.class_id',$data)
               ->select('quiz.*','assignment.id AS deadline_id','teachers.firstname','teachers.lastname')
               ->get()
               ;
               foreach ($quizs as $key => $value) {
                $data2[$key]=assignment::find($value->deadline_id);
            }
            // return dd($data2);
       return view ('student.quizs',compact('quizs','data2'));
     //return view ('home',['user'=>Auth::user()]);

    }
public function point(int $sum,Option $option)
{
    if ($option->iscorrect==0) {
return $sum=sum+0;    }else {
    return $sum=$sum+1;
    }
    # code...
}
public function passquiz(quiz $quiz,assignment $data2)

{
    $id2=$quiz->id;
    //$questions=question::where('quiz_id',$id)->get();
    $user=Auth::user();
    $id=Auth::id();
    $result=Result::where('user_id',$id)
    ->where('quiz_id',$id2)->get();
    //  return dd((Carbon::now())< ($quiz->dead_line));
    if ((Carbon::now())<($data2->dead_line)) {
        if (count($result)) {
            return redirect()->back()->with('error','you are passed the quiz');
                            }

         return view ('student.passquiz',compact('quiz','data2'));
}else {
    return redirect()->back()->with('error','this quiz is close');
}



}
public function saveAnswer(Request $request)
{           $user=Auth::user();
$sum=0;
     $id=Auth::id();
     $user=Auth::user();
   // $student= User::find(2)->student;
     $user1=User::where('id',$id)->first();
   $student=$user1->student;
  //  return dd($student);
    $options=$request->choice;
    foreach ($options as $option) {
        $answer=new option_student();

        $answer->student_id=$student->id;
        $answer->option_id=$option;
        $point= Option::find($option);
       /* if ($point->iscorrect==0) {
             $sum=sum+0;    }else {
                 $sum=$sum+$point->question->question_point;
                }*/
        StudentController::point($sum,$point);
    $answer->save();
   }



return dd($sum);


}

/******************************* */
public function store(Request $request)
{
    //
    $score = 0;
    $questions = $request->option;
    $perfectanswer=0;
  //  return dd($request->all());

   // return dd($questions);


    if ($questions) {
        foreach ($questions as $key => $value) {
            $question = Question::find($key);
           // return dd($request->all());

            $userCorrectAnswers = 0;
            foreach ($value as $answerKey => $answerValue) {
                if ($answerValue == 1) {
                    $userCorrectAnswers++;
                } else {
                    $userCorrectAnswers--;
                }
            }
            if ($question->correctOptionsCount() == $userCorrectAnswers) {
                $score=$score+$question->question_point;
                $perfectanswer++;
            }elseif (($question->correctOptionsCount() > $userCorrectAnswers) && ($userCorrectAnswers > 0)) {
                # code...
                $score=$score+((($question->question_point)*$userCorrectAnswers)/$question->correctOptionsCount());

            }
        }
        $result = new Result();
        $result->user_id = Auth::user()->id;
        $result->quiz_id = $request->input('quiz_id');
        $result->correct_answers = $score;
        $result->questions_count = count($request->input('question_id'));
        $result->save();

        foreach ($questions as $key => $value) {
            foreach ($value as $answerKey => $answerValue) {
                $userOption = new UserOption();
                $userOption->user_id = Auth::user()->id;
                $userOption->result_id = $result->id;
                $userOption->question_id = $key;
                $userOption->quiz_id = $request->input('quiz_id');
                $userOption->option_id = $answerKey;
                $userOption->save();
            }
        }

        return redirect(route('results.show', $result->id));
        } else {
        return redirect()->back();
    }



}


public function show($id)
{
    //

    $result = Result::find($id);

    return view('results.show', ['result' => $result]);

}


/*********************************** */
public function showresult(quiz $quiz)
{
  //  return dd($quiz);

    $id2=$quiz->id;
        //$questions=question::where('quiz_id',$id)->get();
        $user=Auth::user();
        $id=Auth::id();
        $result=Result::where('user_id',$id)
        ->where('quiz_id',$id2)->first();
        if (empty($result)) {
     return redirect()->back()->with('error','you dont pass the quiz');
       }        return view('results.show', ['result' => $result]);




}

}
//app\Http\Controllers\Admin\AdminController.php
