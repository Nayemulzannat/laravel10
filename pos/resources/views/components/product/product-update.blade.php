<div class="modal animated zoomIn" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Product</h5>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">

                                <label class="form-label">Category</label>
                                <select type="text" class="form-control form-select" id="productCategoryUpdate">
                                    <option value="">Select Category</option>
                                </select>

                                <label class="form-label mt-2">Name</label>
                                <input type="text" class="form-control" id="productNameUpdate">

                                <label class="form-label mt-2">Price</label>
                                <input type="text" class="form-control" id="productPriceUpdate">

                                <label class="form-label mt-2">Unit</label>
                                <input type="text" class="form-control" id="productUnitUpdate">
                                <br />
                                <img class="w-15" id="oldImg" src="{{asset('images/default.jpg')}}" />
                                <br />
                                <label class="form-label mt-2">Image</label>
                                <input oninput="oldImg.src=window.URL.createObjectURL(this.files[0])" type="file" class="form-control" id="productImgUpdate">

                                <input type="text" class="d-none" id="updateID">
                                <input type="text" class="d-none" id="filePath">


                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button id="update-modal-close" class="btn bg-gradient-primary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                <button onclick="productPpdate()" id="update-btn" class="btn bg-gradient-success">Update</button>
            </div>

        </div>
    </div>
</div>


<script>
    categoryDropdown()
    async function categoryDropdown() {
        let res = await axios.post('/category-list');
        res.data.forEach(function(item, index) {
            let option = `<option value="${item['id']}">${item['name']}</option>`
            $('#productCategoryUpdate').append(option);
        });
    }

    async function productPpdate() {

        let updateID = $('#updateID').val();
        let filePath = $('#filePath').val();
        let productCategoryUpdate = $('#productCategoryUpdate').val();
        let productNameUpdate = $('#productNameUpdate').val();
        let productPriceUpdate = $('#productPriceUpdate').val();
        let productUnitUpdate = $('#productUnitUpdate').val();
        let productImgUpdate = $('#productImgUpdate')[0].files[0];



        if (productCategoryUpdate.length == 0 && productNameUpdate.length == 0 && productPriceUpdate.length == 0 && productUnitUpdate.length == 0 && !productImgUpdate) {
            $('#productCategoryUpdate,#productNameUpdate, #productPriceUpdate, #productUnitUpdate, #productImgUpdate').addClass('is-invalid');

        } else if (productNameUpdate.length == 0 && productPriceUpdate.length == 0 && productUnitUpdate.length == 0 && !productImgUpdate) {
            $('#productNameUpdate, #productPriceUpdate, #productUnitUpdate, #productImgUpdate').addClass('is-invalid');

        } else if (productPriceUpdate.length == 0 && productUnitUpdate.length == 0 && !productImgUpdate) {
            $('#productPriceUpdate, #productUnitUpdate, #productImgUpdate').addClass('is-invalid');

        } else if (productUnitUpdate.length == 0 && !productImgUpdate) {
            $('#productUnitUpdate, #productImgUpdate').addClass('is-invalid');

        } else if (!productImgUpdate) {
            $('#productImgUpdate').addClass('is-invalid');

        } else if (productUnitUpdate.length == 0) {
            $('#productUnitUpdate').addClass('is-invalid');

        } else if (productPriceUpdate.length == 0) {
            $('#productPriceUpdate').addClass('is-invalid');

        } else if (productNameUpdate.length == 0) {
            $('#productNameUpdate').addClass('is-invalid');

        } else if (productCategoryUpdate.length == 0) {
            $('#productCategoryUpdate').addClass('is-invalid');

        } else {

            let formData = new FormData();
            formData.append('updateID', updateID);
            formData.append('filePath', filePath);
            formData.append('category_id', productCategoryUpdate);
            formData.append('name', productNameUpdate);
            formData.append('price', productPriceUpdate);
            formData.append('unit', productUnitUpdate);
            formData.append('img_url', productImgUpdate); // Append the image file

            const config = {
                headers: {
                    'content-type': 'multipart/from-data'
                }
            }
            showLoader();
            let res = await axios.post("/product-update", formData, config)
            hideLoader();

            if (res.status == 200 && res.data['status'] == 'success') {
                successToast(res.data['message']);
                $('#save-form')[0].reset();
                // $('#categoryName').val('');
                await getProductData();
            } else {
                errorToast(res.data['message']);
            }

        }

    }
</script>