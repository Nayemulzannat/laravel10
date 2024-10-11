<div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Product</h5>
            </div>
            <div class="modal-body">
                <form id="save-form">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 p-1">

                                <label class="form-label">Category</label>
                                <select type="text" class="form-control form-select" id="productCategory" onclick="removeClass();">
                                    <option value="">Select Category</option>
                                </select>

                                <label class="form-label mt-2">Name</label>
                                <input type="text" class="form-control" id="productName" onclick="removeClass();">

                                <label class="form-label mt-2">Price</label>
                                <input type="text" class="form-control" id="productPrice" onclick="removeClass();">

                                <label class="form-label mt-2">Unit</label>
                                <input type="text" class="form-control" id="productUnit" onclick="removeClass();">

                                <br />
                                <img class="w-15" id="newImg" src="{{ asset('images/default.jpg') }}" />
                                <br />

                                <label class="form-label">Image</label>
                                <input oninput="newImg.src=window.URL.createObjectURL(this.files[0])" type="file"
                                    class="form-control" id="productImg" onclick="removeClass();">

                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="modal-close" class="btn bg-gradient-primary mx-2" data-bs-dismiss="modal"
                    aria-label="Close">Close</button>
                <button onclick="productCreate()" id="save-btn" class="btn bg-gradient-success">Save</button>
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
            $('#productCategory').append(option);
        });
    }
    async function productCreate() {
        let productCategory = $('#productCategory').val();
        let productName = $('#productName').val();
        let productPrice = $('#productPrice').val();
        let productUnit = $('#productUnit').val();
        let productImg = $('#productImg')[0].files[0];



        if (productCategory.length == 0 && productName.length == 0 && productPrice.length == 0 && productUnit.length == 0 && !productImg) {
            $('#productCategory,#productName, #productPrice, #productUnit, #productImg').addClass('is-invalid');

        } else if (productName.length == 0 && productPrice.length == 0 && productUnit.length == 0 && !productImg) {
            $('#productName, #productPrice, #productUnit, #productImg').addClass('is-invalid');

        } else if (productPrice.length == 0 && productUnit.length == 0 && !productImg) {
            $('#productPrice, #productUnit, #productImg').addClass('is-invalid');

        } else if (productUnit.length == 0 && !productImg) {
            $('#productUnit, #productImg').addClass('is-invalid');

        } else if (!productImg) {
            $('#productImg').addClass('is-invalid');

        } else if (productUnit.length == 0) {
            $('#productUnit').addClass('is-invalid');

        } else if (productPrice.length == 0) {
            $('#productPrice').addClass('is-invalid');

        } else if (productName.length == 0) {
            $('#productName').addClass('is-invalid');

        } else if (productCategory.length == 0) {
            $('#productCategory').addClass('is-invalid');

        } else {

            let formData = new FormData();
            formData.append('category_id', productCategory);
            formData.append('name', productName);
            formData.append('price', productPrice);
            formData.append('unit', productUnit);
            formData.append('img_url', productImg); // Append the image file

            const config = {
                headers: {
                    'content-type': 'multipart/from-data'
                }
            }
            showLoader();
            let res = await axios.post("/product-create", formData, config)
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


    function removeClass() {
        $('#productCategory').removeClass('is-invalid');
        $('#productName').removeClass('is-invalid');
        $('#productPrice').removeClass('is-invalid');
        $('#productUnit').removeClass('is-invalid');
        $('#productImg').removeClass('is-invalid');
    }
</script>