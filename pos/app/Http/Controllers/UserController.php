<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use App\Mail\OTPMail;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{

    function LoginPage(): View
    {
        return view('pages.auth.login-page');
    }

    function RegistrationPage(): View
    {
        return view('pages.auth.registration-page');
    }
    function SendOtpPage(): View
    {
        return view('pages.auth.send-otp-page');
    }
    function VerifyOTPPage(): View
    {
        return view('pages.auth.verify-otp-page');
    }

    function ResetPasswordPage(): View
    {
        return view('pages.auth.reset-pass-page');
    }

    function ProfilePage(): View
    {
        return view('pages.dashboard.profile-page');
    }


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
                'status' => 'success',
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
        ])->select('id')->first();

        $userID = $count->id;

        if ($count !== NULL) {
            $token = JWTToken::createToken($email, $userID);
            return response()->json([
                'status' => 'success',
                'message' => 'User Login Successful',
            ], 200)->cookie('token', $token, 60);
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
                'message' => 'OTP Code has been send to your email !'
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
            ], 200)
                ->cookie('token', $token, time() + 60 * 24 * 30);
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
            $email = $request->header('userEmail');
            $pass = $request->input('password');

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

    function UserLogout(Request $request)
    {

        return redirect(to: '/userLogin')->cookie('token', '', -1);
    }


    function userProfle(Request $request)
    {
        $email = $request->header('userEmail');

        $user = User::where('email', $email)->first();

        return response()->json([
            'status' => 'success',
            'message' => 'Request Successful',
            'data' => $user
        ], 200);
    }


    function userProfileUpdate(Request $request)
    {
        $email = $request->header('userEmail');
        $firstName =  $request->input('firstName');
        $lastName =  $request->input('lastName');
        $mobile =  $request->input('mobile');
        $password =  $request->input('password');
        try {
            User::where('email', $email)->update([
                'firstName' => $firstName,
                'lastName' => $lastName,
                'mobile' => $mobile,
                'password' => $password,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'User Update Successfully'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'Failed',
                'message' => 'User Update Failed'
                // 'message' => $e->getMessage()
            ], 200);
        }
    }
}
