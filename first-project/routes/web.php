<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\testController;
use App\Http\Controllers\UserControler;



Route::get('/', function () {                                                    //index page route
    return view('index');
});



//  Route::get('/welcome', function () {                                           //wellcome page route
//     return view('welcome');

// });

Route::controller(testController::class)->group(function () {
    Route::get('/about/{id?}', 'about')->name('about.us');          //contact page route
    Route::get('/contact/nayem', 'contact')->name('contact.us');                //contact page route
    Route::get('/section/nayem', 'section')->name('section.us');                    //section page route
});

Route::controller(UserControler::class)->group(function () {
    Route::get('/user','showUsers')->name('showuser.us');
    Route::get('/singleUser/{id}','singleUser')->name('singleUser.us');
    Route::get('/deletUser/{id}','deletUser')->name('deleteUser.us');
    Route::post('/adduser','addUser')->name('addUser.us');
    // Route::post('/updateUser/{id}', [UserControler::class, 'updateUser'])->name('updateUser.us');
    Route::post('/update/{id}','updateUser')->name('update.user');
    Route::get('updatePage/{id}', 'updatePage')->name('updatePage');
});



Route::view('newuser', '/route.addUser');
