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

Route::controller(testController::class)->group(function(){
    Route::get('/about/{id?}','about')->name('about.us');          //contact page route
    Route::get('/contact/nayem','contact')->name('contact.us');                //contact page route
    Route::get('/section/nayem','section')->name('section.us');                    //section page route
});

Route::get('/user/', [UserControler::class, 'showUsers'])->name('showuser.us');
Route::get('/singleUser/{id}', [UserControler::class, 'singleUser'])->name('singleUser.us');



