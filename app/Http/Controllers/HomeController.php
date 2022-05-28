<?php

namespace App\Http\Controllers;
use App\Models\user;
use App\Notifications\NewUserNotification;


use Illuminate\Http\Request;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function notify()
    {
        if (auth()->user()) {
        $user=User::first();

        auth()->user()->notify(new NewUserNotification($user));
    }
        # code...
    }
}
