<?php

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
use App\Subjects;
Route::get('/', function () {
	//dd(Auth::check());
	if (Auth::check()) {
		if (Auth::user()->type === "Teacher") {
			
		}
		elseif (Auth::user()->type === "Student") {
			
		}
		return view('home');
	}
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes(['register' => false]);

Route::get('teacher/submissions', 'TeachersController@submissions')->name('teacher.submissions');
Route::get('teacher/create/submissions', 'TeachersController@createSubmissions')->name('teacher.create.submissions');
Route::post('teacher/', 'TeachersController@storeSubmission')->name('questions.store');

Route::get('student/submissions', 'StudentsController@submissions')->name('student.submissions');

//subjects 
Route::get('/subjects/','SubjectsController@index');
Route::get('/subjects/{subject}','SubjectsController@show');
//joins a student to a submission
Route::post('student/submissions/join','ParticipantController@store');
Route::get('student/submissions/join','ParticipantController@join');
//see all the participants for a submission
Route::get('student/submissions/{submission}/participants','ParticipantController@index');

Route::get('rounds/{submission}/{round_id}/','RoundController@shouldStartRound');
Route::get('rounds/{submission}/{round_id}/startRound','RoundController@index');

Route::get('questions/{question}','QuestionsController@show'); //retrieves the question object