<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
            <div class="card px-5 py-5">
                <div class="row justify-content-between ">
                    <div class="align-items-center col">
                        <h4>Product</h4>
                    </div>
                    <div class="align-items-center col">
                        <button data-bs-toggle="modal" data-bs-target="#create-modal"
                            class="float-end btn m-0  bg-gradient-primary">Create</button>
                    </div>
                </div>
                <hr class="bg-dark " />
                <table class="table" id="tableData">
                    <thead>
                        <tr class="bg-light">
                            <th>No</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Unit</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tableList">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        getProductData();
    });
    async function getProductData() {
        showLoader();
        let res = await axios.post("/product-list");
        hideLoader();


        let tableData = $('#tableData');
        let tableList = $('#tableList');


        tableData.DataTable().destroy();
        tableList.empty();

        res.data.forEach(function(item, index) {
            let row = `<tr>
                  <td>${index+1}</td>
                   <td><img class="w-15 h-auto" alt="" src="${item['img_url']}"></td>
                    <td>${item['name']}</td>
                    <td>${item['price']}</td>
                    <td>${item['unit']}</td>
                    <td>
                        <button data-id="${item['id']}" class="btn editBtn btn-sm btn-outline-success" onclick="editModal(${item['id']},'${item['img_url']}')">Edit</button>
                        <button class="btn deleteBtn btn-sm btn-outline-danger" onclick="deleteModal(${item['id']},'${item['img_url']}')">Delete</button>
                    </td>
                </tr>`;
            tableList.append(row)
        });
        new DataTable('#tableData')
    }


    function deleteModal(id, img_url) {
        $("#delete-modal").modal('show');

        $("#deleteID").val(id);
        $("#deleteFilePath").val(img_url);
    }
</script>
