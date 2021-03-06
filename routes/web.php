<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/movies', [App\Http\Controllers\MovieController::class, 'index'])->name('movies');

    Route::post('/movies/search/', [App\Http\Controllers\MovieController::class, 'show']);
    Route::get('/movies/stream/', [App\Http\Controllers\MovieController::class, 'streamMovie']);
});
