<?php

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

Route::get('/', function () {                                                    //index page route
    return view('index');
});



 Route::get('/welcome', function () {                                           //wellcome page route
    return view('welcome');

});




Route::view('/about/about/nayem','route.contact')->name('about.us');          //contact page route
Route::view('/contact/nayem','route.contact')->name('contact.us');                //contact page route
Route::view('/section/nayem','route.contact')->name('section.us');                    //section page route

