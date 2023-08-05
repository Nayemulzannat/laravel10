<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\View\View;

class testController extends Controller
{
    public function about( string $id){
        return view('route.about',['id' => $id]);

        // return view('route.about', ['about' => about::findOrFail($id)]);

    }
    public function contact(){
        return view('route.contact');

    }
    public function section(){
        return view('route.section');

    }
  
}
