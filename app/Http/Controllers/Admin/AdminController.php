<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\user;
use App\Models\Question;

use App\Http\Controllers\Controller;


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



}
//app\Http\Controllers\Admin\AdminController.php
