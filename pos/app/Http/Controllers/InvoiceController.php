<?php

namespace App\Http\Controllers;

use App\Models\invoice;
use App\Models\invoiceProduct;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    function invoiceCreate(Request $request)
    {

        DB::beginTransaction();

        try {
            $user_id = $request->header('userID');
            $total = $request->input('total');
            $discount = $request->input('discount');
            $vat = $request->input('vat');
            $payable = $request->input('payable');
            $customer_id = $request->input('customer_id');

            $invoice = invoice::create([
                'total' => $total,
                'discount' => $discount,
                'vat' => $vat,
                'payable' => $payable,
                'user_id' => $user_id,
                'customer_id' => $customer_id,
            ]);

            $invoiceID = $invoice->id;


            $products = $request->input('products');

            foreach ($products as $EachProduct) {
                invoiceProduct::create([
                    'invoice_id' => $invoiceID,
                    'user_id' => $user_id,
                    'product_id' => $EachProduct['product_id'],
                    'qty' =>  $EachProduct['qty'],
                    'sale_price' =>  $EachProduct['sale_price'],
                ]);
            }

            DB::commit();

            return 1;
        } catch (Exception $e) {
            DB::rollBack();
            return 0;
        }
    }

    function invoiceSelect(Request $request)
    {
        $user_id = $request->header('userID');
        return invoice::where('user_id', $user_id)->with('customer')->get();
    }
    function invoiceDetails()
    {
        $user_id = $request->header('userID');
    }
}
