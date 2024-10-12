<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    function InvoicePage(): View
    {
        return view('pages.dashboard.invoice-page');
    }

    function SalePage(): View
    {
        return view('pages.dashboard.sale-page');
    }
}
