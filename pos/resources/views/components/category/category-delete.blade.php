<div class="modal animated zoomIn" id="delete-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h3 class=" mt-3 text-warning">Delete !</h3>
                <p class="mb-3">Once delete, you can't get it back.</p>
                <input class="d-none" id="deleteID" />
            </div>
            <div class="modal-footer justify-content-end">
                <div>
                    <button type="button" id="delete-modal-close" class="btn bg-gradient-success mx-2"
                        data-bs-dismiss="modal">Cancel</button>
                    <button onclick="itemDelete()" type="button" id="confirmDelete"
                        class="btn bg-gradient-danger">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    async function itemDelete() {
        let deleteID = $('#deleteID').val();

        showLoader();
        let res = await axios.post("/category-delete", {
            id: deleteID
        });

        hideLoader();

        if (res.status == 200 && res.data['status'] == 'success') {
            $("#delete-modal").modal('hide');
            successToast(res.data['message']);
            await getCategoryData();
        } else {
            errorToast(res.data['message']);
        }

    }
</script>
