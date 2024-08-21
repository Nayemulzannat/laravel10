<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function UserRegistration(Request $request)
    {

        try {
            User::create([
                'firstName' => $request->input('firstName'),
                'lastName' => $request->input('lastName'),
                'email' => $request->input('email'),
                'mobile' => $request->input('mobile'),
                'password' => $request->input('password'),
            ]);

            return response()->json([
                'staus' => 'Success',
                'message' => 'User Registration Successfully'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'Failed',
                'message' => 'User Registration Failed'
                // 'message' => $e->getMessage()
            ], 200);
        }
    }

    function UserlogIn(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        // return $count = User::where('email', $email)
        //     ->where('password', $password)
        //     ->count();

        $count = User::where([
            ['email', '=', $email],
            ['password', '=', $password],
        ])->count();

        if ($count) {
            $token = JWTToken::createToken($email);
            return response()->json([
                'status' => 'success',
                'message' => 'User Login Successful',
                'token' => $token
            ], 200);
        } else {
            return response()->json([
                'status' => 'Faild',
                'message' => 'User Login Faild'
            ], 200);
        }
    }
}
