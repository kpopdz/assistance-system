<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\quiz;
use App\Models\Question;
use App\Models\Option;
use App\Models\quiz_question;
use App\Models\collection_quiz;
use App\Models\collection;

use DB;


use Auth;
class quizController extends Controller
{

    public function stepform(Request $request)
    {
return (dd($request->phone));
    }
    public function show (quiz $quiz)
    {

        return view('quiz.show',compact('quiz'));
    }
    public function search(Request $request)
    {
if ($query=$request->get('query')) {
    $quizs=quiz::where('title',$query)->paginate(8);
    return view('quiz.index',['quizs'=>$quizs]);
}


    }



/* ////////////////////////////////////////
here show my quizs and
all publish quizs
and yoc search with filter about


*/

    public function index (Request $request)
    {$user=Auth::user();
        $id=Auth::id();
        $favorite=collection::where(
            ['name'=>'favorite','user_id'=>$id]
        )->first();
       // $tags=DB::table('tagging_tagged')->where('tagging_tagged',$request->get('query'))->get();
       $visibility=$request->get('visibility');
       $order=$request->get('order');


       if ($query=$request->get('query')) {


            ////////////////////////////////////
                if (!empty($visibility) or !empty($order)) {
                    # code...
                    if (empty($visibility)) {
                        # code...
                        $quizs=quiz::join('users', 'users.id', '=', 'quiz.user_id')
                        ->select('quiz.*','users.name','users.email')
                        ->where('title','LIKE','%'.$query.'%')
                        ->where('user_id', Auth::user()->id)
                        ->orderBy('title', $order)
                        ->paginate(5);


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
                    }else{

        $quizs=quiz::join('users', 'users.id', '=', 'quiz.user_id')
        ->select('quiz.*','users.name','users.email')
        ->where('user_id', Auth::user()->id)
       // ->orderBy('title', $order)
        ->where('title','LIKE','%'.$query.'%')
        //->orWhere('visibilty',)
        ->paginate(5);
        return view ('quiz.index',compact('quizs'));


            }


           /* $quizs=quiz::where('visibility','LIKE','%'.$visibility.'%')
            ->where('title','LIKE','%'.$query.'%')
            ->orderBy('title', 'asc')
            ->paginate(8)*/

       // $quizs=quiz::all()->paginate(5);
                   }else{
                                   ////////////////////////////////////
                if (!empty($visibility) or !empty($order)) {
                    # code...
                    if (empty($visibility)) {
                        # code...
                        $quizs=quiz::join('users', 'users.id', '=', 'quiz.user_id')
                        ->select('quiz.*','users.name','users.email')
                        ->orderBy('title', $order)
                        ->where('user_id', Auth::user()->id)

                        ->paginate(5);


                    } elseif (empty($order)) {
                        $quizs=quiz::join('users', 'users.id', '=', 'quiz.user_id')
                        ->select('quiz.*','users.name','users.email')
                        ->Where('visibility',$visibility)
                        ->where('user_id', Auth::user()->id)

                        ->paginate(5);
                    } else{
                        $quizs=quiz::join('users', 'users.id', '=', 'quiz.user_id')
                        ->select('quiz.*','users.name','users.email')
                        ->orderBy('title', $order)
                        ->Where('visibility',$visibility)
                        ->where('user_id', Auth::user()->id)

                        ->paginate(5);



                }



                            /////////////////////////////////////////
                    }else {
                        # code...
                        $quizs=quiz::join('users', 'users.id', '=', 'quiz.user_id')
                        ->orderBy('title')
                        ->where('user_id', Auth::user()->id)
                        ->select('quiz.*','users.name','users.email')

                        ->paginate(5);
                    }

     //   $quizs=quiz::orderBy('title')
       // ->paginate(30);

       }
       return view('quiz.index',['quizs'=>$quizs,'favorite'=>$favorite]);


    }
    public function indexMostResent ()
    {$user=Auth::user();
        $id=Auth::id();
        $quizs=quiz::where('user_id', Auth::user()->id)->latest()->paginate(20);
       // $quizs=quiz::all();
        return view ('quiz.index',compact('quizs'));


    }
    public function addibput()
    {
        return view('teacher.test');
    }
    public function index3 ()
    {
        return view ('quiz.test');


    }
    public function create(){
        return view ('quiz.create');

    }
    public function createQuestion(quiz $quiz){
        return view ('teacher.test',compact('quiz'));

    }
    public function store2(Request $request,quiz $quiz){
        $user=Auth::user();
        $id=Auth::id();

$will_insert=[];
foreach ($request->input('IsCorrect') as $key => $value) {
    //if (!empty($request->input('IsCorrect'))) {
array_push($will_insert,['IsCorrect'=>$value]);
//}else {

//}

}
$first=$request->question_content;
$third=$request->input('IsCorrect');
$question = new question();
$question->quiz_id=$request->quiz_id;

$question->question_content=$first;

$question->question_point=$request->question_point;
$question->save();
$second=$request->option_content;
$data = $request->all();

$question->question_content=$first;

$i=0;
for ($i=0; $i < 4; $i++) {
    # code...


    $option=new option();

    $option->question_ID=$question->id;
    $str=$second[$i];
    $option->option_CONTENT=$str;
    $str1=$third[$i];

    $option ->iscorrect =$str1;
$option->save();

}

return redirect()->route('quizs.show',compact('quiz'))->with('success','question added successfully');
      //  $quiz -> save();
       //  return redirect()->route('quizs.index')->with('success','quiz added successfully');
    }

    public function saveOtherInfo(Request $request , $id)
    {
        $request->validate([

            'visibility'=>'required',
            'image' => 'required',
            // 'tags' => 'required',

          ]);
$quiz=quiz::where('id',$id)->first();
      $image_extension = $request->image->getClientOriginalExtension();
     // $quiz->  visibility = request('visibility');
     // $quiz->image= 'uploads/quiz/' . $filename;

      $image = $request->image;
      // $image->getClientOriginalName()
        $filename= time().'.'.$image->getClientOriginalName().$image_extension;
        $path='uploads/quiz';
        $request->image->move($path,$filename);
        // $tags = explode(",", $request->tags);
        $quiz->visibility = request('visibility');
        $quiz->image= 'uploads/quiz/' . $filename;
        $quiz -> save();
        return redirect()->route('quizs.show' ,compact('quiz'))->with('success','quiz added successfully');




           }
    public function store(Request $request){
        $user=Auth::user();
        $id=Auth::id();

     $request->validate([
        'title'=>'required',
        'description'=>'required',
        // 'visibility'=>'required',
        // 'image' => 'required',
         'tags' => 'required',
        // 'publish'=>'required',
      ]);


      $tags = explode(",", $request->tags);


      //  $quiz=quiz::create([$request->all()]);

           $quiz = new quiz();
          $quiz -> user_id=$id;
        $quiz -> title = request('title');
        $quiz -> description= request('description');


//         if ($request->has('save'))
// {
// $quiz->publish=0;
// }
// else if ($request->has('publish'))
// {
//     $quiz->publish=1;
// }
   // 	$quiz->tag($tags);



        $quiz -> save();
        $quiz->tag($tags);
        $quiz -> save();


         return redirect()->route('quizs.show' ,compact('quiz'))->with('success','quiz added successfully');
    }
    public function finished($id)
    { $quiz=quiz::find($id);
        $quiz->publish=1;
        $quiz->save();
        return  redirect()->route('quizs.show' ,compact('quiz'))->with('success','quiz was publish');
    }
    public function edit(quiz $quiz){
        $tags=$quiz->tags;
        $res="";
        foreach ($tags as $tag) {
            $res=$res . $tag->name . ",";
        }
        return view('teacher.edit',compact('quiz','res'));

    }
    public function update(Request $request ,quiz $quiz){

        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'visibility'=>'required',
            'image' => 'required',
            'tags' => 'required',
            'publish'=>'required',
        ]);
        $quiz -> title = request('title');
        $quiz -> description= request('description');
        $quiz->  visibility = request('visibility');
            $input=$request->all();
            $tags = explode(",", $request->tags);

            if ($request->has('image')) {
                $image = $request->image;

                $image_extension = $request->image->getClientOriginalExtension();

              //  / $image->getClientOriginalName()
                $filename= time().'.'.$image->getClientOriginalName().$image_extension;
                $path='uploads/quiz';
                $request->image->move($path,$filename);
              //  $tags = explode(",", $request->tags);

            }else{
                unset($input['image']);
            }





            $quiz->update();
            DB::table('tagging_tagged')->where('taggable_id',$quiz->id)->delete();
        //    $quiz->tags->delete();
        $quiz->image= 'uploads/quiz/' . $filename;
        if ($request->has('save'))
        {
            $request->save=0;
        }
        else if ($request->has('publish'))
        {
            $request->publish=1;
        }
            $quiz->tag($tags);
            $quiz->update();
             return redirect()->route('quizs.index')->with('success','quiz updated successfully');
    }
    public function destroy(quiz $quiz){
        $quiz->delete();
        return redirect()->route('quizs.index')->with('success','quiz delete successfully');

    }
    public function destroyque(quiz $quiz,question $question ){
        // $id=$question->quiz_question->quiz_id;
        $quiz_question=quiz_question::where(['quiz_id'=>$quiz->id ,'question_id'=>$question->id])
        ->first();
        $quiz_question->delete();
        return redirect()->route('quizs.show',compact('quiz'))->with('success','question delete successfully');

    }


    public function form ()
    {

        return view ('test/form');

    }


    public function add ()
    {
     // dd(request('name'));

     $quiz = new quiz();

     $quiz -> quiz_name = request('name');
     $quiz ->  start_date= request('date');


     $quiz -> save();



        return view ('test/form');

    }
    public function addElement(Request $request ,quiz $quiz){

        for ($i = 1; $i <= $request->num; $i++){
            echo("<h1>hello</h1>");

        }
    }
/* /////////////////////////
 Create a Question  in table quiz and in quiz_question
and table question


///////////////////// */
    public function store5(Request $request ,quiz $quiz)
    {
        //
        $questionText = $request->input('question');
        $optionArray = $request->input('options');
        $correctOptions = $request->input('correct');

        $question = new Question();
        $question->question_content = $questionText;
        $question->question_point=$request->point;

                $question->save();
                $id=$question->id;

                $quiz_question=new quiz_question();
                $quiz_question->quiz_id=$request->quiz_id;
                $quiz_question->quiz_id=$request->quiz_id;

                $quiz_question->question_id=$id;
                $quiz_question->save();



        foreach ($optionArray as $index => $opt) {
            $option = new option();

            $option->question_ID = $id;
            $option->option_CONTENT = $opt;
            foreach ($correctOptions as $correctOption) {
                if($correctOption == $index+1) {
                    $option->iscorrect = 1;
                }
            }

            $option->save();
        }
        $id=$quiz_question->quiz_id;
        $quiz=quiz::find($id);
        return redirect()->route('quizs.show',compact('quiz'))->with('success','question added successfully');
    }
    public function replicate(quiz $quiz)
    {
        $tags=$quiz->tags;
        $res="";
        foreach ($tags as $tag) {
            $res=$res . $tag->name . ",";
        }
        return view('teacher.duplicate',compact('quiz','res'));

        # code...
    }


public function editQuiz(quiz $quiz)
{
                    return view('quiz.quizedit');
}
}
