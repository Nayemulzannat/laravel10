<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6 center-screen">
            <div class="card animated fadeIn w-90  p-4">
                <div class="card-body">
                    <h4>EMAIL ADDRESS</h4>
                    <br />
                    <label>Your email address</label>
                    <input id="email" placeholder="User Email" class="form-control" type="email"
                        onclick="classRemove()" />
                    <br />
                    <button onclick="VerifyEmail()" class="btn w-100 float-end bg-gradient-primary">Next</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    async function VerifyEmail() {
        let email = $('#email').val();

        if (email.length == 0) {
            $('#email').addClass('is-invalid');
        } else {
            showLoader();
            let res = await axios.post("/user-sendotp", {
                email: email
            });
            hideLoader();
            if (res.status == 200 && res.data['status'] == 'send') {
                successToast(res.data['message']);
                sessionStorage.setItem('email', email);

                setTimeout(function (){
                    window.location.href = '/verifyOtp';
                }, 1000)

            } else {
                errorToast(res.data['message']);

            }
        }


    }


    function classRemove() {
        $('#email').removeClass('is-invalid');
    }
</script>
