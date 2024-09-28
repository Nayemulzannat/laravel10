<div class="modal animated zoomIn" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Customer</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Customer Name <span style="color: red">*</span></label>
                                <input type="text" class="form-control" id="customerNameUpdate"
                                    onclick="removeClass()">

                                <label class="form-label mt-3">Customer Email <span style="color: red">*</span></label>
                                <input type="text" class="form-control" id="customerEmailUpdate"
                                    onclick="removeClass()">

                                <label class="form-label mt-3">Customer Mobile <span style="color: red">*</span></label>
                                <input type="text" class="form-control" id="customerMobileUpdate"
                                    onclick="removeClass()">

                                <input type="text" class="d-none" id="updateID">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="update-modal-close" class="btn bg-gradient-primary" data-bs-dismiss="modal"
                    aria-label="Close">Close</button>
                <button onclick="customerUpdate()" id="update-btn" class="btn bg-gradient-success">Update</button>
            </div>
        </div>
    </div>
</div>


<script>
    async function customerUpdate() {


        let updateID = $('#updateID').val();
        let customerNameUpdate = $('#customerNameUpdate').val();
        let customerEmailUpdate = $('#customerEmailUpdate').val();
        let customerMobileUpdate = $('#customerMobileUpdate').val();

        if (customerNameUpdate.length == 0 && customerEmailUpdate.length == 0 && customerMobileUpdate.length == 0) {
            $('#customerNameUpdate,#customerEmailUpdate, #customerMobileUpdate').addClass('is-invalid');

        } else if (customerEmailUpdate.length == 0 && customerMobileUpdate.length == 0) {
            $('#customerEmailUpdate, #customerMobileUpdate').addClass('is-invalid');

        } else if (customerNameUpdate.length == 0 && customerMobileUpdate.length == 0) {
            $('#customerNameUpdate, #customerMobileUpdate').addClass('is-invalid');

        } else if (customerNameUpdate.length == 0 && customerEmailUpdate.length == 0) {
            $('#customerNameUpdate, #customerEmailUpdate').addClass('is-invalid');

        } else if (customerNameUpdate.length == 0) {
            $('#customerNameUpdate').addClass('is-invalid');

        } else if (customerEmailUpdate.length == 0) {
            $('#customerEmailUpdate').addClass('is-invalid');

        } else if (customerMobileUpdate.length == 0) {
            $('#customerMobileUpdate').addClass('is-invalid');

        } else {
            showLoader();
            let res = await axios.post("/customer-update", {
                id: updateID,
                name: customerNameUpdate,
                email: customerEmailUpdate,
                mobile: customerMobileUpdate
            })
            hideLoader();

            if (res.status == 200 && res.data['status'] == 'success') {
                $("#update-modal").modal('hide');
                $('#update-form')[0].reset();
                successToast(res.data['message']);

                await getCustomerData();
            } else {
                errorToast(res.data['message'])
            }
        }

    }


    function removeClass() {
        $('#customerName').removeClass('is-invalid');
        $('#customerEmail').removeClass('is-invalid');
        $('#customerMobile').removeClass('is-invalid');
    }
</script>
