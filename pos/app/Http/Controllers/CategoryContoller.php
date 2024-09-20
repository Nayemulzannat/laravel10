<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryContoller extends Controller
{
    function CategoryPage()
    {
        return view('pages.dashboard.category-page');
    }
}
