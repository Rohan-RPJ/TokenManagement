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
use App\StudentCalls;

Route::get('/', function () {
	//dd(Auth::check());
	if (Auth::check()) {
		if (Auth::user()->type === "Teacher") {
			$unReadNotifCount = 0;
			return view('home', compact('unReadNotifCount'));
		}
		elseif (Auth::user()->type === "Student") {
			$unReadNotifCount = StudentCalls::getUnReadNotifCount();
			//dd($unReadNotifCount);
			return view('home', compact('unReadNotifCount'));
		}
		
	}
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes(['register' => false]);

Route::get('teacher/submissions', 'TeachersController@submissions')->name('teacher.submissions');
Route::get('teacher/profile', 'TeachersController@profile')->name('teacher.profile');
Route::get('teacher/create/submissions', 'TeachersController@createSubmissions')->name('teacher.create.submissions');
Route::post('teacher/', 'TeachersController@storeSubmission')->name('questions.store');
Route::get('teacher/update/submissions', 'TeachersController@updateSubmission')->name('submission.update');
Route::get('teacher/remove/submissions', 'TeachersController@removeSubmission')->name('submission.remove');
Route::get('teacher/call/students/', 'TeachersController@callStudent')->name('student.call');
Route::get('teacher/notifications', 'TeachersController@showNotifications')->name('teacher.notifications');
Route::get('teacher/profile', 'TeachersController@profile')->name('teacher.profile');

Route::get('student/submissions', 'StudentsController@submissions')->name('student.submissions');
Route::get('student/notifications', 'StudentsController@showNotifications')->name('student.notifications');
Route::get('student/profile', 'StudentsController@profile')->name('student.profile');

//subjects
Route::get('/subjects/','SubjectsController@index');
Route::get('/subjects/{subject}','SubjectsController@show');
//joins a student to a submission
Route::post('student/submissions/join','ParticipantController@store')->name('participant.join');
Route::get('student/submissions/join','ParticipantController@join');
//see all the participants for a submission
Route::get('student/submissions/{submission}/participants','ParticipantController@index');

Route::get('rounds/{submission}/{round_id}/','RoundController@shouldStartRound');
Route::get('rounds/{submission}/{round_id}/startRound','RoundController@index')->name("round.start");
Route::post('rounds/{submission}/{round_id}/','RoundController@submitAnswers')->name("round.submit");
Route::get('rounds/{submission}/{round_id}/{participant}/forcesubmit','RoundController@forceFireRoundCompletedEvent')->name('round.force');

Route::get('questions/{question}','QuestionsController@show'); //retrieves the question object

Route::get('createfcfs/{student}/{submission}','TokenController@createFCFS')->name('token.fcfs');

Route::get('participantstatus/{participant}/{round}/status/','ParticipantStatusController@getStatus')->name('participantstatus.status');

Route::get('participantstatus/{participant}/{round}/updateStatus','ParticipantStatusController@updateStatus')->name('participantstatus.update');

Route::get('participantstatus/{participant}/{round}/create','ParticipantStatusController@create')->name('participantstatus.create');

Route::get('participantstatus/{submission}/{round}/{statuscode}','ParticipantStatusController@count')->name('participantstatus.count');

Route::view('loading','round.loading')->name('round.wait');

Route::get('tokens/{participant}/{round}','TokenController@getTokenForSubmissionRound')->name('token.get');
Route::get('tokens/redirect/{participant}/{round}','TokenController@redirectToNotification')->name('token.redirect');
