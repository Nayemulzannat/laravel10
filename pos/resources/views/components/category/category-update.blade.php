<div class="modal animated zoomIn" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Category</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">
                                <label class="form-label">Category Name *</label>
                                <input type="text" class="form-control" id="categoryNameUpdate">
                                <input class="d-none" id="updateID">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="update-modal-close" class="btn bg-gradient-primary" data-bs-dismiss="modal"
                    aria-label="Close">Close</button>
                <button onclick="categoryUpdate()" id="update-btn" class="btn bg-gradient-success">Update</button>
            </div>
        </div>
    </div>
</div>

<script>
    async function categoryUpdate() {
        let updateID = $('#updateID').val();
        let categoryNameUpdate = $('#categoryNameUpdate').val();
        if (categoryNameUpdate.length == 0) {
            errorToast("Category Required !")
        } else {
            showLoader();
            let res = await axios.post("/category-update", {
                id: updateID,
                name: categoryNameUpdate,
            })
            hideLoader();

            if (res.status == 200 && res.data['status'] == 'success') {
                $("#update-modal").modal('hide');
                // $('#categoryNameUpdate').val('');
                successToast(res.data['message']);

                await getCategoryData();
            } else {
                errorToast(res.data['message'])
            }
        }

    }
</script>
