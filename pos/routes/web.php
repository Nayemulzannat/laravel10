<?php


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
