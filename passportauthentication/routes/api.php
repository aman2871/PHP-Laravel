<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PassportController;

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


// Route::post('/register', [PassportController::class, 'register']);

// Route::post('/login', [PassportController::class, 'login']);
// // Route::gett('/logout', [PassportController::class, 'logout']);

// Route::get('/login', [PassportController::class, 'login']);


// //  after using this middleware every user in the users table can access the getTaskList function in PAssportController.....
// Route::middleware('auth:api')->get('/details', [PassportController::class, 'getTaskList']);
// Route::middleware('auth:api')->post('/logout', [PassportController::class, 'logout']);




// Route::group(['middleware' => 'auth:api', 'namespace' => 'Api'], function () {

//     Route::get('/user', [PassportController::class, 'allusers']);
// });
// Route::group(['namespace' => 'Api'], function () {

//     Route::post('/login', [PassportController::class, 'login'])->name('api.login');
//     Route::get('/login', [PassportController::class, 'logindex'])->name('api.login');
//     Route::post('/register', [PassportController::class, 'register'])->name('api.register');
//     Route::get('/register', [PassportController::class, 'regindex'])->name('api.register');
//     // Route::get('/logout', [PassportController::class, 'logout'])->name('api.logout');
// });