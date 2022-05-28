<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\quiz;
use App\Models\Question;
use App\Models\Option;
use DB;
class QuestionOptionsController extends Controller

{

    public function edit(quiz $quiz,question $question ){
        // return dd($quiz->id);
     /*   $tags=$quiz->tags;
        $res="";
        foreach ($tags as $tag) {
            $res=$res . $tag->name . ",";
        }*/
        $options=option::where('question_id',$question->id);
        return view('teacher.question.edit',compact('question','options' ,'quiz'));

    }
    public function update(Request $request,quiz $quiz,question $question)
     {
         //return dd($question->id);
        $questionText = $request->input('question');
        $optionArray = $request->input('options');
        $correctOptions = $request->input('correct');
        $newOptionArray = $request->input('newoptions');
        $newCorrectOptions = $request->input('newcorrect');
        $id = $request->input('option_id');
        // return dd($id);

        $optionDeleteds=option::where('question_id',$question->id)
         ->whereNotIn('id', $id)
        ->get()->each(function($optionDeleted) {
            $optionDeleted->delete();
        });
        // return dd($optionDeleted);

        $question->question_content = $questionText;
        $question->update();
        $data1 =[];
        $data2=[];

        //
        $i=0;
        $temp=0;
        foreach ($optionArray as $index => $opt) {
            $data1[]=$index;
            $option = option::find($id[$i]);

            $option->option_CONTENT = $opt;

            if ($correctOptions==null) {
                $option->iscorrect = 0;
            }else {
                foreach ($correctOptions as $correctOption) {
                    if($correctOption == $index+1) {
                        $option->iscorrect = 1;
                        $temp=1;
                    }

                    if ($temp==0) {
                        $option->iscorrect = 0;
                    }
                }            }



            $option->save();
            $i=$i+1;
            $temp=0;
        }
        if ($newOptionArray) {
            foreach ($newOptionArray as $index1 => $opt) {
                $option2 = new option();

                $option2->question_ID = $question->id;
                $option2->option_CONTENT = $opt;
                if ($newCorrectOptions) {
                    foreach ($newCorrectOptions as $newCorrectOption) {
                        if($newCorrectOption == $index1+1) {
                            $option2->iscorrect = 1;
                        }
                    }
                }


                $option2->save();
            }
        }

        // $quiz = quiz::find($question->quiz_id);

        return redirect()->route('quizs.show',compact('quiz'))->with('success','question updated successfully');

        //
       // $question = Question::find($id);
       // $question->topic_id = $topicID;
       // $question->question_text = $questionText;
       // $question->save();


        return redirect(route('questions.index'));
    }
    public function destroy(option $option){
        $option->delete();
        return redirect()->back()->with('success','option delete successfully');
     //   return redirect()->route('teacher.option.index')->with('success','quiz delete successfully');

    }

}
