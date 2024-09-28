<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
            <div class="card px-5 py-5">
                <div class="row justify-content-between ">
                    <div class="align-items-center col">
                        <h4>Category</h4>
                    </div>
                    <div class="align-items-center col">
                        <button data-bs-toggle="modal" data-bs-target="#create-modal"
                            class="float-end btn m-0 bg-gradient-primary">Create</button>
                    </div>
                </div>
                <hr class="bg-secondary" />
                <div class="table-responsive">
                    <table class="table" id="tableData">
                        <thead>
                            <tr class="bg-light">
                                <th>No</th>
                                <th>Category</th>
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
</div>


<script>
    $(document).ready(function() {
        getCategoryData();
    });


    async function getCategoryData() {
        showLoader();
        let res = await axios.post("/category-list");
        hideLoader();

        let tableData = $('#tableData');
        let tableList = $('#tableList');


        tableData.DataTable().destroy();
        tableList.empty();


        res.data.forEach(function(item, index) {
            let row = `<tr>
                  <td>${index+1}</td>
                    <td>${item['name']}</td>
                    <td>
                        <button data-id="${item['id']}" class="btn editBtn btn-sm btn-outline-success" onclick="editModal(${item['id']},'${item['name']}')">Edit</button>
                        <button class="btn deleteBtn btn-sm btn-outline-danger" onclick="deleteModal(${item['id']})">Delete</button>
                    </td>
                </tr>`;

            tableList.append(row);
        })

        new DataTable('#tableData')

    }

    function deleteModal(id) {
        $("#delete-modal").modal('show');
        $("#deleteID").val(id);

    }

    function editModal(id, name) {
        $("#update-modal").modal('show');
        $("#updateID").val(id);
        $("#categoryNameUpdate").val(name);
    }
</script>
