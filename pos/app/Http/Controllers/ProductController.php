<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

use Illuminate\View\View;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{

    function productPage()
    {
        return view('pages.dashboard.product-page');
    }


    function productCreate(Request $request)
    {
        $user_id = $request->header('userID');
        $category_id = $request->input('category_id');
        $name = $request->input('name');
        $price = $request->input('price');
        $unit = $request->input('unit');

        $img = $request->file('img_url');
        $t = time();
        $file_name = $img->getClientOriginalName();
        $img_name = "{$user_id}-{$t}-{$file_name}";
        $img_url = "uploads/{$img_name}";

        $img->move(public_path('uploads'), $img_name);

        $result = product::create([
            'user_id' => $user_id,
            'category_id' => $category_id,
            'name' => $name,
            'price' => $price,
            'unit' => $unit,
            'img_url' => $img_url
        ]);

        if ($result) {
            return response()->json([
                'status' => 'success',
                'message' => 'Product Create Successfully',
            ], 200);
        } else {
            return response()->json([
                'status' => 'Error',
                'message' => 'Product Not Successfully',
            ], 401);
        }
    }
    function productList(Request $request)
    {
        $user_id = $request->header('userID');
        return $dataGet = product::where('user_id', $user_id)->get();
    }


    function productDelete(Request $request)
    {
        $user_id = $request->header('userID');
        $product_id = $request->input('id');

        $filePath = $request->input('file_path');
        
        File::delete($filePath);


        $result = product::where('id', $product_id)->where('user_id', $user_id)->delete();

        if ($result) {
            return response()->json([
                'status' => 'success',
                'message' => 'Product Delete Successfully',
            ], 200);
        } else {
            return response()->json([
                'status' => 'Error',
                'message' => 'Product Not  Delete Successfully',
            ], 401);
        }
    }

    // function productUpdate(Request $request)
    // {
    //     $user_id = $request->header('userID');
    //     $category_id = $request->input('category_id');
    //     $name = $request->input('name');
    //     $price = $request->input('price');
    //     $unit = $request->input('unit');

    //     $img = $request->file('img_url');
    //     $t = time();
    //     $file_name = $img->getClientOriginalName();
    //     $img_name = "{$user_id}-{$t}-{$file_name}";
    //     $img_url = "uploads/{$img_name}";

    //     $img->move(public_path('uploads'), $img_name);

    //     $result = product::where('user_id', $user_id)->where('id', $category_id)->update([
    //         'name' => $name,
    //         'price' => $price,
    //         'unit' => $unit,
    //         'img_url' => $img_url
    //     ]);

    //     if ($result) {
    //         return response()->json([
    //             'status' => 'success',
    //             'message' => 'Product Create Successfully',
    //         ], 200);
    //     } else {
    //         return response()->json([
    //             'status' => 'Error',
    //             'message' => 'Product Not Successfully',
    //         ], 401);
    //     }
    // }
}
