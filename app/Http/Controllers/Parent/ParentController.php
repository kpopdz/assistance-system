<?php

namespace App\Http\Controllers\Parent;

use Illuminate\Http\Request;
use App\Models\user;
use App\Models\student;
use App\Models\UserOption;
use App\Models\Result;

use App\Models\quiz;
use App\Models\question;
use App\Models\option;
use App\Models\option_student;
use App\Models\parent_student;
use App\Models\parents;

use Auth;

use App\Http\Controllers\Controller;


class ParentController extends Controller
{

   public function __construct()
   {

   }
    public function index ()
    {            $user=Auth::user();
        $syudent;
        $ids=Auth::id();
      //  return dd($ids);
      $parent=Parents::where('user_id',$ids)->first();
            //  return dd(Auth::user()->parents->full_name);

      // $students=parent_student::where('parent_id',$parent->id)->get();
      $students=$parent->students;
   //    return dd($parent->students);

       return view ('parent.mychild',compact('students'));
     //return view ('home',['user'=>Auth::user()]);

    }
public function results2($user_id)
{
    # code...
    $results=Result::where('user_id',$user_id)->get();
    return view ('teacher.results',compact('results'));

}
}
//app\Http\Controllers\Admin\AdminController.php
