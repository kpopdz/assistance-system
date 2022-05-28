<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
public function _registerOrLoginUser($data)
{
    $user=User::where('email','=',$data->email)->first();
    if (!$user) {
        $user=new User();
        $user->name=$data->name;
        $user->email=$data->email;
        $user->google_id=$data->id;
        $user->save();
    }
        Auth::login($user);

}


    public function RedirectToGoogle()
{
    return Socialite::driver('google')->redirect();
}
public function hundle()
{
//try {
    $user=Socialite::driver('google')->user();
   /* $user = User::where('google_id',$googl_user->email)->first();
    if ($user) {
        Auth::login($user);
        return redirect('/home');
    }else {
        $new=User::query()->create([
                                    'name'=>$user->name,
                                    'email'=>$user->name,
                                    'google_id'=>$user->google_id,
                                    'password'=>Crypt::encrypt("12345"),
        ]);
                                     Auth::login($new);
                                     return redirect('/home');

    }
} catch (\Throwable $th) {
    abort(404);
}*/
}

}
