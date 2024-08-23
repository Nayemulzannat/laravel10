<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function DashboardPage(): View
    {
        return view('pages.dashboard.dashboard-page');
    }
}
