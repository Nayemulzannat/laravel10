<?php

namespace App\Http\Controllers;

use App\Models\categorie;
use Illuminate\Http\Request;

class CategoryContoller extends Controller
{
    function CategoryPage()
    {
        return view('pages.dashboard.category-page');
    }


    function categoryList(Request $request)
    {
        $user_id = $request->header('userID');
        return $dataGet = categorie::where('user_id', $user_id)->get();

        // return response()->json([
        //     'status' => $user_id,
        //     'message' => $dataGet
        // ], 200);
    }
    function categoryCreate(Request $request)
    {
        $user_id = $request->header('userID');
        $name = $request->input('name');

        $result = categorie::create([
            'name' => $name,
            'user_id' => $user_id
        ]);
        if ($result) {
            return response()->json([
                'status' => 'success',
                'message' => 'Category Create successfully',
            ], 200);
        } else {
            return response()->json([
                'status' => 'Error',
                'message' => 'Category Not successfully',
            ], 401);
        }
    }
    function updateCategory(Request $request)
    {
        $user_id = $request->header('userID');
        $category_id = $request->input('id');
        $name = $request->input('name');

        // return response()->json([
        //     'user_id' => $user_id,
        //     'category_id' => $category_id,
        //     'name' => $name,
        // ], 200);

        $result = categorie::where('user_id', $user_id)->where('id', $category_id)->update([
            'name' => $name
        ]);
        if ($result) {
            return response()->json([
                'status' => 'success',
                'message' => 'Category Update Successfully',
            ], 200);
        } else {
            return response()->json([
                'status' => 'Error',
                'message' => 'Category Not  Update Successfully',
            ], 401);
        }
    }

    function deleteCategory(Request $request)
    {
        $user_id = $request->header('userID');
        $category_id = $request->input('id');

        // return response()->json([
        //     'user_id' => $user_id,
        //     'category_id' => $category_id,
        //     'name' => $name,
        // ], 200);

        $result = categorie::where('id', $category_id)->where('user_id', $user_id)->delete();

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
