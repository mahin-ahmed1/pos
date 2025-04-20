<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenVerificationMiddleware;

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


Route::post('/user-registration',[UserController::class,'user_registration']);

Route::post('/user-login',[UserController::class,'userLogin']);

Route::post('/send-otp',[UserController::class,'sendOtp']);

Route::post('/verify-otp',[UserController::class,'VerifyOTP']);

Route::post('/reset-password',[UserController::class,'resetPass'])->middleware([TokenVerificationMiddleware::class]);


/// Front end routes


Route::get('/login',[UserController::class,'login']);
Route::get('/signup',[UserController::class,'signup']);
Route::get('/forget',[UserController::class,'forget']);
Route::get('/submit-otp',[UserController::class,'otpSubmit']);
Route::get('/set-password',[UserController::class,'setPassword']);