<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7 animated fadeIn col-lg-6 center-screen">
            <div class="card w-90  p-4">
                <div class="card-body">
                    <h4>SIGN IN</h4>
                    <br />
                    <input id="email" placeholder="User Email" class="form-control" type="email" />
                    <br />
                    <input id="password" placeholder="User Password" class="form-control" type="password" />
                    <br />
                    <button onclick="SubmitLogin()" class="btn w-100 bg-gradient-primary">Next</button>
                    <hr />
                    <div class="float-end mt-3">
                        <span>
                            <a class="text-center ms-3 h6" href="{{ url('/userRegistration') }}">Sign Up </a>
                            <span class="ms-1">|</span>
                            <a class="text-center ms-3 h6" href="{{ url('/sendOtp') }}">Forget Password</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    async function SubmitLogin() {
        let emailField = document.getElementById('email');
        let passwordField = document.getElementById('password');

        // Get values
        let email = emailField.value.trim();
        let password = passwordField.value.trim();

        // Reset previous errors
        emailField.classList.remove('is-invalid');
        passwordField.classList.remove('is-invalid');

        if (email.length == 0 && password.length == 0) {
            // errorToast('Email is required');
            emailField.classList.add('is-invalid');
            passwordField.classList.add('is-invalid');
        } else if (email.length == 0) {
            emailField.classList.add('is-invalid');
        } else if (password.length == 0) {
            // errorToast('Password is required');
            passwordField.classList.add('is-invalid');

        } else if (password.length < 4) {
            errorToast('Password is Must Be Four Charecther');
            passwordField.classList.add('is-invalid');
        } else {
            showLoader();
            let res = await axios.post("/user-login", {
                email: email,
                password: password
            });
            hideLoader()
            if (res.status === 200 && res.data['status'] === 'success') {
                window.location.href = "/dashboard";
            } else {
                errorToast(res.data['message']);
            }
        }
    }
</script>
