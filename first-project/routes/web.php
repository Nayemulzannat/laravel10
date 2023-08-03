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

Route::get('/', function () {                                               //index page route
    return view('index');
});

/* Route::get('/', function () {
    return view('index');
});
 */

 Route::get('/welcome', function () {                                           //wellcome page route
    return view('welcome');

});
 Route::get('/about/about/nayem', function () {
    return view('about');
})->name('about.us');

 Route::get('/contact/nayem', function () {                                      //contact page route
    return view('contact');
})->name('contact.us');

// Route::view('/contact','contact.us');

 Route::get('/section/nayem', function () {                                         //section page route
    return view('section');
    // return "this roll $roll";
})->name('section.us');