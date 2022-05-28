<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\quizController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\QuestionOptionsController;
use App\Http\Controllers\Teacher\TeacherController;
use App\Http\Controllers\Parent\ParentController;
use Laravel\Socialite\Facades\Auth\Socialite;
use App\Http\Controllers\Student\StudentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});
Route::get('student/index', [StudentController::class , 'index'])->name("public.quizs");
Route::get('student/quiz/{quiz}/{data2}', [StudentController::class , 'passquiz'])->name('student.pass');
Route::get('student/result/{id}', [StudentController::class , 'show'])->name('results.show');
Route::post('student/quiz/answer', [StudentController::class , 'store'])->name('student.answer.test');
Route::get('student/myresult/{quiz}', [StudentController::class , 'showresult'])->name('myresult');


Route::get('quiz/{id}', [quizController::class , 'show']);

Route::get('/index', [quizController::class , 'index']);
/***********  teacher  ***** */
Route::get('/teacher/test', [quizController::class , 'addibput'])->name('teacher.test');
Route::post('teacher/quiz/question/store', [quizController::class , 'store5'])->name('quizs.test.create');
Route::get('/teacher/duplicate/{quiz}', [quizController::class , 'replicate'])->name('quiz.duplicate');
Route::get('teacher/profile', function () {
    return view('teacher.profile')->name('teacher.profile');
})->name('teacher.profile');
Route::post('/teacher/post',[TeacherController::class ,'profile'])->name('post.profile.m');
Route::post('/teacher/createclass',[TeacherController::class ,'CreateClass'])->name('create.class');

Route::get('teacher/myprofile', function () {
    return view('teacher.myprofile');

})->name('profile');
Route::get('/teacher/classes',[TeacherController::class ,'showClasses'])->name('teacher.classes');
Route::get('/teacher/myquizs',[TeacherController::class ,'MyQuizs'])->name('teacher.myquizs');
Route::get('/teacher/myquizs/{id}',[TeacherController::class ,'results'])->name('teacher.myquizs.results');


/***********teacher */

/***************parent */
Route::get('/parent/mychild',[ParentController::class ,'index'])->name('parent.child');
Route::get('/parent/results/{id}',[ParentController::class ,'results2'])->name('parent.result');


/***************parent */



Route::get('/form', [quizController::class , 'form']);

Route::get('quizs/{quiz}/question/create', [quizController::class , 'createQuestion'])->name('quizs.create.posts');
Route::get('quizs/{id}/publish', [quizController::class , 'finished'])->name('quizs.finishe');

Route::get('/edit/{quiz}', [quizController::class , 'editQuiz'])->name('quizs.edit.info');

Route::get('/hi', [quizController::class , 'index']);
Route::resource('quizs', quizController::class)->middleware('auth');
Route::get('/test', [quizController::class , 'index3']);
Route::get('/users', [UserController::class , 'index']);
Route::post('quizs/posts{quiz}', [quizController::class , 'store2'])->name('quizs.posts');
Route::get('quizs/{quiz}/question/{question}', [QuestionOptionsController::class , 'edit'])->name('question.edit');
Route::put('quizs/{quiz}/question/{question}/update', [QuestionOptionsController::class , 'update'])->name('question.update');
Route::delete('/question/option/{question}', [QuestionOptionsController::class , 'destroy'])->name('option.delete');

Auth::routes(['verify'=> true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/teacher/stepOneToFinish/{quiz}',[TeacherController::class ,'stepOneToFinish'])->name('steponetofinish');
Route::get('/teacher/addtofavorate/{quiz}',[TeacherController::class ,'addToFav2'])->name('addtofav');

Auth::routes();
// Route::get('quizs/{quiz}/question/{question}', function (quiz $quiz,question $question) {
//     return dd($quiz->id);
// })->name('home19971');
/*Route::get('/login/google/callback', function () {
    $googleuser = Socialite::driver('google')->user();

    $user = User::updateOrCreate([
        'google_id' => $googleuser->id,
    ], [
        'name' => $googleuser->name,
        'email' => $googleuser->email,
        'google_token' => $googleuser->token,
        'google_refresh_token' => $googleuser->refreshToken,
    ]);

    Auth::login($user);

    return redirect('/dashboard');
});*/

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
/*Route::get('/auth/redirect', function () {
    return Socialite::driver('google')->redirect();
});*/
Route::get('/login/google',[LoginController::class,'RedirectToGoogle'])->name('login.google');
Route::get('/login/google/callback',[LoginController::class,'hundleGoogleCallback']);

//Route::get('/auth/callback', function () {
 //   $user = Socialite::driver('google')->user();

    // $user->token
//});

//// teacher/////
Route::get('/users', [AdminController::class,'index']);
Route::get('/users/class', [UserController::class,'index2']);

Route::prefix('teacher')->group(function () {
    Route::get('/myquiz',[quizController::class , 'index']);
Route::view('/stepform', 'teacher.create');
//Route::view('/test', 'teacher.test');


Route::post('/stepform/show',[quizController::class ,'stepform'])->name('form2022');
Route::delete('quizs/{quiz}/delete/{question}', [quizController::class,'destroyque'])->name('question.delete');
Route::get('quizs/most-recent',[quizController::class,'indexMostResent'])->name('quiz.recent');
Route::get('quizs/search',[quizController::class,'search'])->name('quiz.search');
Route::get('autocomplete', [quizController::class,'autocomplete'])->name('autocomplete');
/* /////////////////////////////// */
Route::get('questions/{id}/import',[TeacherController::class,'importQuestion'])->name('question.list');
Route::post('questions/post/{id}',[TeacherController::class,'importoquiz'])->name('question.list.post');

});
Route::get('/lay', function () {
    return view("teacher.create");

});
Route::post('/quizs/{id}/addinfo',[quizController::class ,'saveOtherInfo'])->name('quiz.addinfo');





Route::get('/teacher/assigne',[TeacherController::class ,'showClasses'])->name('teacher.classes.assigne');
Route::post('/teacher/assigne/end{id}',[TeacherController::class ,'quizforclass'])->name('classes.assigne.end');
Route::get('/notify',[App\Http\Controllers\HomeController::class ,'notify'])->name('teacher.classes.notify');


