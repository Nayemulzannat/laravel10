<?php

namespace App\Http\Controllers;

use App\Models\categorie;
use App\Models\customer;
use App\Models\invoice;
use App\Models\product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function DashboardPage(): View
    {
        return view('pages.dashboard.dashboard-page');
    }

    function Summary(Request $request): array
    {

        $user_id = $request->header('userID');

        $product = product::where('user_id', $user_id)->count();
        $Category = categorie::where('user_id', $user_id)->count();
        $Customer = customer::where('user_id', $user_id)->count();
        $Invoice = invoice::where('user_id', $user_id)->count();
        $total =  Invoice::where('user_id', $user_id)->sum('total');
        $vat = Invoice::where('user_id', $user_id)->sum('vat');
        $payable = Invoice::where('user_id', $user_id)->sum('payable');

        return [
            'product' => $product,
            'category' => $Category,
            'customer' => $Customer,
            'invoice' => $Invoice,
            'total' => round($total, 2),
            'vat' => round($vat, 2),
            'payable' => round($payable, 2)
        ];
    }
}
