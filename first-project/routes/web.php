<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\testController;



Route::get('/', function () {                                                    //index page route
    return view('index');
});



 Route::get('/welcome', function () {                                           //wellcome page route
    return view('welcome');

});




Route::get('/about/{id}',[testController::class,'about'])->name('about.us');          //contact page route
Route::get('/contact/nayem',[testController::class,'contact'])->name('contact.us');                //contact page route
Route::get('/section/nayem',[testController::class,'section'])->name('section.us');                    //section page route

