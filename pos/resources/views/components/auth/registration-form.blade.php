<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-10 center-screen">
            <div class="card animated fadeIn w-100 p-3">
                <div class="card-body">
                    <h4>Sign Up</h4>
                    <hr />
                    <div class="container-fluid m-0 p-0">
                        <div class="row m-0 p-0">
                            <div class="col-md-4 p-2">
                                <label>Email Address</label>
                                <input id="email" placeholder="User Email" class="form-control"
                                    type="email"onclick="removeClass()" />
                            </div>
                            <div class="col-md-4 p-2">
                                <label>First Name</label>
                                <input id="firstName" placeholder="First Name" class="form-control" type="text"
                                    onclick="removeClass()" />
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Last Name</label>
                                <input id="lastName" placeholder="Last Name" class="form-control" type="text"
                                    onclick="removeClass()" />
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Mobile Number</label>
                                <input id="mobile" placeholder="Mobile" class="form-control" type="mobile"
                                    onclick="removeClass()" />
                            </div>
                            <div class="col-md-4 p-2">
                                <label>Password</label>
                                <input id="password" placeholder="User Password" class="form-control" type="password"
                                    onclick="removeClass()" />
                            </div>
                        </div>
                        <div class="row m-0 p-0">
                            <div class="col-md-4 p-2">
                                <button onclick="onRegistration()"
                                    class="btn mt-3 w-100  bg-gradient-primary">Complete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    async function onRegistration() {
        // alert();
        // exit();
        let email = $('#email').val();
        let firstName = $('#firstName').val();
        let lastName = $('#lastName').val();
        let mobile = $('#mobile').val();
        let password = $('#password').val();

        // Reset previous errors
        // email.classList.add('is-invalid');
        // passwordField.classList.remove('is-invalid');



        if (email.length == 0 && firstName.length == 0 && lastName.length == 0 && mobile.length == 0 && password
            .length == 0) {

            $('#email,#password, #firstName, #lastName, #mobile').addClass('is-invalid');

        } else if (firstName.length == 0 && lastName.length == 0 && mobile.length == 0 && password
            .length == 0) {

            $('#password, #firstName, #lastName, #mobile').addClass('is-invalid');

        } else if (lastName.length == 0 && mobile.length == 0 && password.length == 0) {
            $('#password, #lastName, #mobile').addClass('is-invalid');

        } else if (mobile.length == 0 && password.length == 0) {
            $('#password, #mobile').addClass('is-invalid');

        } else if (password.length == 0) {
            $('#password').addClass('is-invalid');

        } else if (password.length < 4) {
            errorToast('Password is Must Be Four Charecther');
            $('#password').addClass('is-invalid');
        } else {
            showLoader();
            let res = await axios.post("/user-registration", {
                email: email,
                firstName: firstName,
                lastName: lastName,
                mobile: mobile,
                password: password
            });

            hideLoader();
            if (res.status == 200 && res.data['status'] == 'success') {
                successToast(res.data['message']);
                setTimeout(function() {
                    window.location.href = "/userLogin"
                }, 1000);
            } else {
                errorToast(res.data['message']);
            }

        }
    }

    function removeClass() {
        $('#email').removeClass('is-invalid');
        $('#firstName').removeClass('is-invalid');
        $('#lastName').removeClass('is-invalid');
        $('#mobile').removeClass('is-invalid');
        $('#password').removeClass('is-invalid');
    }
</script>
