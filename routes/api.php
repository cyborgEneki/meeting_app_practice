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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');

Route::group(['middleware' => 'auth:api'], function ()
{
    Route::post('details', 'API\UserController@details');
    Route::apiResource('meetings', 'MeetingController');
    Route::apiResource('meetings.agendas', 'AgendaController');
    Route::apiResource('notes', 'NoteController');
    Route::apiResource('meetingtypes', 'MeetingtypeController');
    Route::apiResource('followups', 'FollowupController');
    Route::apiResource('discussions', 'DiscussionController');
    Route::apiResource('agendas', 'AgendaController');
    Route::get('simplemeetings', 'MeetingController@indexSimpleMeetings');
    Route::get('meetings/{meetingId}/users{userId}/notes', 'NoteController@getMeetingNoteUser');
});
