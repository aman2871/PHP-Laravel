<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostDetailsController;
use App\Http\Controllers\RazorpayController;
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

Route::get('markasread', function () {
    auth()->user()->unReadNotifications->markAsRead();
    return redirect()->back();
})->name('markasread');
Auth::routes();
Auth::routes();
// 
Route::get('/home', [HomeController::class, 'index'])->middleware('subscriptioncheck');

Route::get('/home/{tags_id}', [HomeController::class, 'filterpost'])->name('home');

Route::post('/tag', [HomeController::class, 'addtag'])->name('home');

Route::get('/delete/{id}', [HomeController::class, 'destroy'])->name('home')->middleware('tagcheck');

Route::post('/post', [HomeController::class, 'createpost'])->name('home');

Route::get('/postdetails/{id}', [PostDetailsController::class, 'postdetails']);

Route::post('/comment/{id}', [HomeController::class, 'addcomment']);

Route::get('razorpay', [RazorpayController::class, 'razorpay'])->name('razorpay');

Route::post('payment', [RazorpayController::class, 'payment'])->name('payment');

Route::post('pay', [RazorpayController::class, 'pay'])->name('home');
Route::get('success', [RazorpayController::class, 'success'])->name('home');
