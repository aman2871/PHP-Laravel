<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
    return view('login');
});

Route::get('list', [UserController::class, 'list']);
Route::get('create', [UserController::class, 'create']);
// Route::post('loginsubmit', [UserController::class, 'loginsubmit']);
Route::post('loginsubmit', [UserController::class, 'loginsubmit']);
Route::post('createsubmit', [UserController::class, 'createsubmit']);
Route::get('login', [UserController::class, 'login']);
Route::get('/delete/{id}', [UserController::class, 'destroy']);
Route::get('/edit/{id}', [UserController::class, 'edit']);
Route::post('/editsubmit', [UserController::class, 'editsubmit']);
