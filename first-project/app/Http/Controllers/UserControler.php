<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserControler extends Controller
{
    public function showUsers(){
        $users= DB::table('users')->get();
        // return $users;
        return view('route.showuser',[ 'data' => $users]); 
    }
    public function singleUser(string $id){
        $users = DB::table('users')->where('id',$id)->get();
        return view('route.singleUser',[ 'data' => $users]); 
    }
}
