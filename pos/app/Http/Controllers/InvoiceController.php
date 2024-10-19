<?php

namespace App\Http\Controllers;

use App\Models\customer;
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
    function invoiceDetails(Request $request)
    {
        $user_id = $request->header('userID');
        $cus_id = $request->input('cus_id');
        $inv_id = $request->input('inv_id');

        // return response()->json([
        //     'user_id' => $user_id,
        //     'cus_id' => $cus_id,
        //     'inv_id' => $inv_id,
        // ], 200);
        $customerDetails = customer::where('user_id', $user_id)->where('id', $request->input('cus_id'))->first();
        $invoiceTotal = invoice::where('user_id', '=', $user_id)->where('id', $request->input('inv_id'))->first();
        $invoiceProduct = invoiceProduct::where('invoice_id', $request->input('inv_id'))
            ->where('user_id', $user_id)->with('product')
            ->get();
        return array(
            'customer' => $customerDetails,
            'invoice' => $invoiceTotal,
            'product' => $invoiceProduct,
        );
    }

    function invoiceDelete(Request $request)
    {
        DB::beginTransaction();
        try {
            $user_id = $request->header('userID');
            invoiceProduct::where('invoice_id', $request->input('inv_id'))
                ->where('user_id', $user_id)
                ->delete();
            invoice::where('id', $request->input('inv_id'))->delete();
            DB::commit();
            return 1;
        } catch (Exception $e) {
            DB::rollBack();
            return 0;
        }
    }
}
