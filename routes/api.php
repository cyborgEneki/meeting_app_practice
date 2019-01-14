<?php
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api', 'cors')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'UserController@login');
Route::post('register', 'UserController@register');

Route::group(['middleware' => 'auth:api'], function ()
{
    Route::post('details', 'UserController@details');
    Route::apiResource('meetings.agendas', 'AgendaController');
    Route::apiResource('notes', 'NoteController');
    Route::apiResource('venues', 'VenueController');
    Route::apiResource('medias', 'MediaController');
    Route::apiResource('meetingtypes', 'MeetingtypeController');
    Route::apiResource('meetingseries', 'MeetingseriesController');
    Route::apiResource('followups', 'FollowupController');
    Route::apiResource('discussions', 'DiscussionController');
    Route::apiResource('agendas', 'AgendaController');
//    Route::apiresource('roles', 'RoleController');
    Route::apiresource('users', 'UserController');
    Route::get('simplemeetings', 'MeetingController@indexSimpleMeetings');
    Route::get('meetings/{meetingId}/notes', 'NoteController@getMeetingNotes')->name('meetingUserNote');
    Route::delete('meetings/{meetingId}/users/{userId}', 'MeetingController@detachUser');
    Route::get('meetings/{meetingId}/users/{userId}', 'MeetingController@attachUser');
    Route::post('meetings/attachuser', 'MeetingController@attachUser');
    Route::get('meetings/choices', 'MeetingController@choices');
    Route::get('meetings/search', 'MeetingController@search');
    Route::apiResource('meetings', 'MeetingController');
    Route::post('agendas/vote', 'AgendaController@vote');
});


