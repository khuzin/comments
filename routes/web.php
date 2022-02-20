<?php

use App\Http\Controllers\General\CommentController;
use App\Http\Controllers\General\UserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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



Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/comment', [CommentController::class, 'store'])->middleware('auth');
Route::get('/comments', [CommentController::class, 'index']);
Route::get('/user',[UserController::class,'index']);
