<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use App\Mail\OTPMail;
use Illuminate\Support\Facades\Mail;

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


    function SendOTPCode(Request $request)
    {
        $email = $request->input('email');
        $otp = rand(1000, 9999);

        $count = User::where('email', $email)
            ->count();
        $user = User::where('email', $email)->first();
        $name = $user->firstName;


        if ($count == '1') {
            Mail::to($email)->send(new OTPMail($otp, $name));
            User::where('email', $email)->update(['otp' => $otp]);

            return response()->json([
                'status' => 'send',
                'message' => '4 Digit OTP Code has been send to your email !'
            ], 200);
        } else {
            return response()->json([
                'status' => 'Faild',
                'message' => 'Unauthorized'
            ], 200);
        }
    }

    function VerifyOTP(Request $request)
    {
        $email = $request->input('email');
        $otp = $request->input('otp');

        $count = User::where('email', $email)
            ->where('otp', $otp)
            ->count();

        if ($count == '1') {
            User::where('email', $email)->update(['otp' => '0']);
            $token = JWTToken::createTokenPasswordSet($email);
            return response()->json([
                'status' => 'success',
                'message' => 'OTP Verification Successful',
                'token' => $token
            ], 200);
        } else {
            return response()->json([
                'status' => 'Faild',
                'message' => 'Unauthorized'
            ], 200);
        }
    }
    function ResetPassword(Request $request)
    {

        try {
            $email = $request->header(key: 'email');
            $pass = $request->input(key: 'password');

            User::where('email', $email)->update(['password' => $pass]);

            return response()->json([
                'status' => 'success',
                'message' => 'Successful'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'Faild',
                'message' => 'Unauthorized'
            ], 401);
        }
    }
}
