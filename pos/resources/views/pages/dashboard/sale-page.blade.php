@extends('layout.sidenav-layout')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 col-lg-4 p-2">
            <div class="shadow-sm h-100 bg-white rounded-3 p-3">
                <div class="row">
                    <div class="col-8">
                        <span class="text-bold text-dark">BILLED TO </span>
                        <p class="text-xs mx-0 my-1">Name: <span id="CName"></span> </p>
                        <p class="text-xs mx-0 my-1">Email: <span id="CEmail"></span></p>
                        <p class="text-xs mx-0 my-1">User ID: <span id="CId"></span> </p>
                    </div>
                    <div class="col-4">
                        <img class="w-50" src="{{"images/logo.png"}}">
                        <p class="text-bold mx-0 my-1 text-dark">Invoice </p>
                        <p class="text-xs mx-0 my-1">Date: {{ date('Y-m-d') }} </p>
                    </div>
                </div>
                <hr class="mx-0 my-2 p-0 bg-secondary" />
                <div class="row">
                    <div class="col-12">
                        <table class="table w-100" id="invoiceTable">
                            <thead class="w-100">
                                <tr class="text-xs">
                                    <td>Name</td>
                                    <td>Qty</td>
                                    <td>Total</td>
                                    <td>Remove</td>
                                </tr>
                            </thead>
                            <tbody class="w-100" id="invoiceList">

                            </tbody>
                        </table>
                    </div>
                </div>
                <hr class="mx-0 my-2 p-0 bg-secondary" />
                <div class="row">
                    <div class="col-12">
                        <p class="text-bold text-xs my-1 text-dark"> TOTAL: <i class="bi bi-currency-dollar"></i> <span id="total"></span></p>
                        <p class="text-bold text-xs my-2 text-dark"> PAYABLE: <i class="bi bi-currency-dollar"></i> <span id="payable"></span></p>
                        <p class="text-bold text-xs my-1 text-dark"> VAT(5%): <i class="bi bi-currency-dollar"></i> <span id="vat"></span></p>
                        <p class="text-bold text-xs my-1 text-dark"> Discount: <i class="bi bi-currency-dollar"></i> <span id="discount"></span></p>
                        <span class="text-xxs">Discount(%):</span>
                        <input onkeydown="return false" value="0" min="0" type="number" step="0.25" onchange="DiscountChange()" class="form-control w-40 " id="discountP" />
                        <p>
                            <button onclick="createInvoice()" class="btn  my-3 bg-gradient-primary w-40">Confirm</button>
                        </p>
                    </div>
                    <div class="col-12 p-2">

                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-4 col-lg-4 p-2">
            <div class="shadow-sm h-100 bg-white rounded-3 p-3">
                <table class="table  w-100" id="productTable">
                    <thead class="w-100">
                        <tr class="text-xs text-bold">
                            <td>Product</td>
                            <td>Pick</td>
                        </tr>
                    </thead>
                    <tbody class="w-100" id="productList">

                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-md-4 col-lg-4 p-2">
            <div class="shadow-sm h-100 bg-white rounded-3 p-3">
                <table class="table table-sm w-100" id="customerTable">
                    <thead class="w-100">
                        <tr class="text-xs text-bold">
                            <td>Customer</td>
                            <td>Pick</td>
                        </tr>
                    </thead>
                    <tbody class="w-100" id="customerList">

                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>




<div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Add Product</h6>
            </div>
            <div class="modal-body">
                <form id="add-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Product ID *</label>
                                <input type="text" class="form-control" id="PId">
                                <label class="form-label mt-2">Product Name *</label>
                                <input type="text" class="form-control" id="PName">
                                <label class="form-label mt-2">Product Price *</label>
                                <input type="text" class="form-control" id="PPrice">
                                <label class="form-label mt-2">Product Qty *</label>
                                <input type="text" class="form-control" id="PQty">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="modal-close" class="btn bg-gradient-primary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                <button onclick="add()" id="save-btn" class="btn bg-gradient-success">Add</button>
            </div>
        </div>
    </div>
</div>

@endsection