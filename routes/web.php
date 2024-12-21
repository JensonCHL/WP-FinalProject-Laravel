<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\UserRegisterController;
use App\Http\Controllers\LoginController;

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
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::get('/register', [UserRegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [UserRegisterController::class, 'register']);
Route::get('/forum', [ForumController::class, 'index'])->name('forum.index');
Route::post('/forum/create', [ForumController::class, 'store'])->name('forum.store');
Route::post('/forum/like/{id}', [ForumController::class, 'like'])->name('forum.like');
Route::post('/forum/{id}/reply', [ReplyController::class, 'store'])->name('forum.reply');



