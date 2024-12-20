<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ForumController;


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
Route::get('/forum', [ForumController::class, 'index'])->name('forum.index');
Route::post('/forum/create', [ForumController::class, 'store'])->name('forum.store');
Route::post('/forum/like/{id}', [ForumController::class, 'like'])->name('forum.like');


