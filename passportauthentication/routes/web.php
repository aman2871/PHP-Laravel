<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PassportController;

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

Route::post('/login', [PassportController::class, 'login'])->name('login');

Route::get('/login', [PassportController::class, 'logindex'])->name('login');

Route::post('/register', [PassportController::class, 'register'])->name('register');

Route::get('/register', [PassportController::class, 'regindex'])->name('register');

Route::post('/image', [PassportController::class, 'imgupload']);

Route::get('/home', [PassportController::class, 'index']);

// Route::post('/home',[PassportController::class, 'imgedit']);

Route::post('/edit', [PassportController::class, 'imgedit']);

Route::post('/logout', [PassportController::class, 'logout']);
    // Route::get('/logout',[PassportController::class,'logout']);
    // Route::get('/logout', [PassportController::class, 'logout'])->name('api.logout');
