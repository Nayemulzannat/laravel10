<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\tokenVerification;
use Illuminate\Support\Facades\Route;

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


Route::post('/user-registration', [UserController::class, 'UserRegistration']);
Route::post('/user-login', [UserController::class, 'UserlogIn']);
Route::post('/user-sendotp', [UserController::class, 'SendOTPCode']);

Route::post('/user-verifyotp', [UserController::class, 'VerifyOTP']);

Route::post('/user-resetpassword', [UserController::class, 'ResetPassword'])->middleware([tokenVerification::class]);



// User Logout
Route::get('/logout', [UserController::class, 'UserLogout']);

// Page Routes
Route::get('/', [HomeController::class, 'HomePage']);
Route::get('/userLogin', [UserController::class, 'LoginPage']);
Route::get('/userRegistration', [UserController::class, 'RegistrationPage']);
Route::get('/sendOtp', [UserController::class, 'SendOtpPage']);
Route::get('/verifyOtp', [UserController::class, 'VerifyOTPPage']);
Route::get('/dashboard', [DashboardController::class, 'DashboardPage'])->middleware([tokenVerification::class]);
Route::get('/resetPassword', [UserController::class, 'ResetPasswordPage'])->middleware([tokenVerification::class]);
