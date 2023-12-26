<?php

use App\Events\Hello;
use App\Events\PrivateTest;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Google\GoogleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/broadcast', function() {
     Hello::dispatch();
     return 'sent';
});

Route::get('/broadcast-private', function() {

     PrivateTest::dispatch();
     return 'ini private';
});

Route::get('/login/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('/login/google/callback', [GoogleController::class, 'handleGoogleCallback']);
