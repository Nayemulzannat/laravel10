<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class testController extends Controller
{
 
    public function about( string $id){
        return view('route.about',['id' => $id]);
    }
    public function contact(){
        return view('route.contact');
    }
    public function section(){
        return view('route.section');

    }
  
}
