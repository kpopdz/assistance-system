<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use DB;



class UserController extends Controller
{
    public function index ()
    {
     //   $users=user::all();
     //   return view ('users.index',compact('users'));
     return view ('home',['user'=>Auth::user()]);

    }
public function index2()
{
$users=DB::table('users')
->join('teachers', 'users.id', '=', 'teachers.user_id')
->join('student', 'users.id', '=', 'student.user_id')
->where('class_id','=',1)
->get();
return view ('users',combact('users'));

}

}
