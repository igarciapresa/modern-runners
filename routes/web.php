<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
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

//Route::get('/home', function () {
//    return view('home');});

Route::get('/login', [LoginController::class, 'stravaAuth']);
Route::get('/logout', [LoginController::class, 'logOut']);
Route::get('/home', [LoginController::class, 'getToken']);
Route::get('/dashboard', [ActivityController::class, 'getUserActivities']);
Route::get('/getActiveEvents', [EventController::class, 'getActiveEvents']);
Route::get('/getLatestEvents', [EventController::class, 'getLatestEvents']);
Route::get('/getCurrentEvent', [EventController::class, 'getCurrentEvent']);
Route::get('/getEventActivities/{id}', [EventController::class, 'getActivities']);
Route::get('/getActiveEventsActivities', [EventController::class, 'getActiveEventsActivities']);
Route::get('/getLatestEventsActivities', [EventController::class, 'getLatestEventsActivities']);
Route::get('/getUserActivities/{page}', [UserController::class, 'getUserActivities']);
Route::get('/getAuthUser', [UserController::class, 'getAuthUser']);
Route::post('/addEvent', [EventController::class, 'addEvent']);
Route::put('/updateUser/{id}', [UserController::class, 'update']);
Route::get('/getTeammates', [UserController::class, 'getTeammates']);
Route::put('/updateEvent/{id}', [EventController::class, 'update']);
Route::delete('/deleteEvent/{id}', [EventController::class, 'destroy']);
Route::put('/updateUser/{id}', [UserController::class, 'update']);
Route::delete('/deleteUser/{id}', [UserController::class, 'destroy']);
Route::get('/loadRanking', [UserController::class, 'ranking']);
Route::post('/storeMessage', [MessageController::class, 'store']);
Route::get('/getMessages', [MessageController::class, 'getAll']);
Route::post('/answerMail', [MailController::class, 'answerMail']);