<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserControler extends Controller
{
    public function showUsers()
    {
        $users = DB::table('users')->get();
        // return $users;
        return view('route.showuser', ['data' => $users]);
    }
    public function singleUser(string $id)
    {
        $users = DB::table('users')->where('id', $id)->get();
        return view('route.singleUser', ['data' => $users]);
    }
    public function deletUser(string $id)
    {
        $users = DB::table('users')
            ->where('id', $id)
            ->delete();
        if ($users) {
            return redirect()->route('showuser.us');
        }
    }
    public function addUser(Request $add)
    {
        $users = DB::table('users')->insert([
            'name' => $add->username,
            'phone' => $add->userphone,
            'email' => $add->useremail,
            'city' => $add->usercity,

        ]);
        if ($users) {
            return redirect()->route('showuser.us');
        }
    }

    public function updatePage(string $id)
    {
        $users = DB::table('users')->find($id);

        return view('route.update', ['data' => $users]);
    }
    public function updateUser(Request $update, $id)
    {
        $users = DB::table('users')
            ->where('id', $id)
            ->update([
                'name' => $update->username,
                'phone' => $update->userphone,
                'email' => $update->useremail,
                'city' => $update->usercity,
            ]);
        if ($users) {
            return redirect()->route('showuser.us');
        }
    }
}
