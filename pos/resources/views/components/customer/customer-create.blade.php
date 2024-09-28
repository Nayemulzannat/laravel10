<div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Customer</h5>
            </div>
            <div class="modal-body">
                <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Customer Name <span style="color: red">*</span></label>
                                <input type="text" class="form-control" id="customerName" onclick="removeClass()">
                                <label class="form-label">Customer Email <span style="color: red">*</span></label>
                                <input type="text" class="form-control" id="customerEmail" onclick="removeClass()">
                                <label class="form-label">Customer Mobile <span style="color: red">*</span></label>
                                <input type="text" class="form-control" id="customerMobile" onclick="removeClass()">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="modal-close" class="btn bg-gradient-primary" data-bs-dismiss="modal"
                    aria-label="Close">Close</button>
                <button onclick="customerSave()" id="save-btn" class="btn bg-gradient-success">Save</button>
            </div>
        </div>
    </div>
</div>
<script>
    async function customerSave() {
        let customerName = $('#customerName').val();
        let customerEmail = $('#customerEmail').val();
        let customerMobile = $('#customerMobile').val();

        if (customerName.length == 0 && customerEmail.length == 0 && customerMobile.length == 0) {
            $('#customerName,#customerEmail, #customerMobile').addClass('is-invalid');

        } else if (customerEmail.length == 0 && customerMobile.length == 0) {
            $('#customerEmail, #customerMobile').addClass('is-invalid');

        } else if (customerName.length == 0 && customerMobile.length == 0) {
            $('#customerName, #customerMobile').addClass('is-invalid');

        } else if (customerName.length == 0 && customerEmail.length == 0) {
            $('#customerName, #customerEmail').addClass('is-invalid');

        } else if (customerName.length == 0) {
            $('#customerName').addClass('is-invalid');

        } else if (customerEmail.length == 0) {
            $('#customerEmail').addClass('is-invalid');

        } else if (customerMobile.length == 0) {
            $('#customerMobile').addClass('is-invalid');

        } else {
            $('#modal-close').click();

            showLoader();
            let res = await axios.post("/customer-create", {
                name: customerName,
                email: customerEmail,
                mobile: customerMobile
            });

            hideLoader();
            if (res.status == 200 && res.data['status'] == 'success') {

                successToast(res.data['message']);
                $('#save-form')[0].reset();
                // $('#categoryName').val('');
                await getCustomerData();


            } else {
                errorToast(res.data['message']);
            }
        }

    }

    function removeClass() {
        $('#customerName').removeClass('is-invalid');
        $('#customerEmail').removeClass('is-invalid');
        $('#customerMobile').removeClass('is-invalid');
    }
</script>
