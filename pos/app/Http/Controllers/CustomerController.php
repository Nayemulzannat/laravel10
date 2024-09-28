<?php

namespace App\Http\Controllers;

use App\Models\customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    function customerPage()
    {
        return view('pages.dashboard.customer-page');
    }
    function customerList(Request $request)
    {
        $user_id = $request->header('userID');
        return $dataGet = customer::where('user_id', $user_id)->get();

        // return response()->json([
        //     'status' => $user_id,
        //     'message' => $dataGet
        // ], 200);
    }
    function customerCreate(Request $request)
    {
        $user_id = $request->header('userID');
        $name = $request->input('name');
        $mobile = $request->input('mobile');
        $email = $request->input('email');

        $result = customer::create([
            'name' => $name,
            'user_id' => $user_id,
            'mobile' => $mobile,
            'email' => $email,
        ]);
        if ($result) {
            return response()->json([
                'status' => 'success',
                'message' => 'Customer Create successfully',
            ], 200);
        } else {
            return response()->json([
                'status' => 'Error',
                'message' => 'Customer Not successfully',
            ], 401);
        }
    }
    function customerUpdate(Request $request)
    {
        $user_id = $request->header('userID');
        $customer_id = $request->input('id');
        $name = $request->input('name');
        $mobile = $request->input('mobile');
        $email = $request->input('email');

        // return response()->json([
        //     'user_id' => $user_id,
        //     'category_id' => $category_id,
        //     'name' => $name,
        // ], 200);

        $result = customer::where('user_id', $user_id)->where('id', $customer_id)->update([
            'name' => $name,
            'mobile' => $mobile,
            'email' => $email
        ]);
        if ($result) {
            return response()->json([
                'status' => 'success',
                'message' => 'Customer Update Successfully',
            ], 200);
        } else {
            return response()->json([
                'status' => 'Error',
                'message' => 'Customer Not  Update Successfully',
            ], 401);
        }
    }

    function customerDelete(Request $request)
    {
        $user_id = $request->header('userID');
        $customer_id = $request->input('id');

        // return response()->json([
        //     'user_id' => $user_id,
        //     'category_id' => $category_id,
        //     'name' => $name,
        // ], 200);

        $result = customer::where('id', $customer_id)->where('user_id', $user_id)->delete();

        if ($result) {
            return response()->json([
                'status' => 'success',
                'message' => 'Category Delete Successfully',
            ], 200);
        } else {
            return response()->json([
                'status' => 'Error',
                'message' => 'Category Not  Delete Successfully',
            ], 401);
        }
    }
}
