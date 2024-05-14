@include('layouts.frontend.head')
<style>
    .alert {
        padding: 20px;
        background-color: #ffb6b0;
        margin-bottom: 15px;
    }
    </style>
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
      </div>
    </div>
  </div>
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto me-lg-auto ms-lg-5">
              <div class="card card-plain">
                <div class="card-header">
                  <h4 class="font-weight-bolder">Sign Up</h4>
                  <p class="mb-0">Enter your email and password to register</p>
                </div>
                <div class="card-body">
                  <form role="form">
                    @csrf
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Name</label>
                      <input type="text" class="form-control">
                    </div>
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Email</label>
                      <input type="email" class="form-control">
                    </div>
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Password</label>
                      <input type="password" class="form-control">
                    </div>
                    <div class="form-check form-check-info text-start ps-0">
                      <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                      <label class="form-check-label" for="flexCheckDefault">
                        I agree the <a href="javascript:;" class="text-dark font-weight-bolder">Terms and Conditions</a>
                      </label>
                    </div>
                    <div id="error-text"></div>
                    <div class="text-center">
                      <button type="button" id="btnSubmit" class="btn btn-lg bg-gradient-primary btn-lg w-100  mb-0">Sign Up</button>
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-2 text-sm mx-auto">
                    Already have an account?
                    <a href="{{ route('goToLogin') }}" class="text-primary text-gradient font-weight-bold">Sign in</a>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
              <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center" style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80'); background-size: cover`;">
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <script>
    $(document).ready(function() {
        $("#btnSubmit").click(function() {
          var name = $("input[type='text']").val();
          var email = $("input[type='email']").val();
          var password = $("input[type='password']").val();
          var checkbox = $("input[type='checkbox']").is(":checked");
          var error = "";

          if (name == "") {
            error += "Name is required<br>";
          }
          if (email == "" || !email.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
            error += "Email is required with format youremail@example.com<br>";
          }
          if (password == "" || !password.match(/^(?=.*[A-Z])(?=.*[0-9])/) || password.length < 8 || password.length > 12) {
            error += "Password is required with uppercase and number with 8-12 characters<br>";
          }
          if(checkbox == false){
            error += "You must agree to the terms and conditions<br>";
          }

          if (error != "") {
            $("#error-text").html('<div class="alert" role="alert"><strong>There were error(s) in your form:</strong><br>' + error + '</div>');
          } else {
            $("#error-text").html("");
            $.ajax({
              url: "/register",
              type: "POST",
              data: {
                name: name,
                email: email,
                password: password,
                _token: "{{ csrf_token() }}",
              },
              success: function(response) {
                if (response != null) {
                    window.location.href = "{{ route('home') }}";
                } else {
                  $("#error-text").html('<div class="alert" role="alert"><strong>There were error(s) in your form:</strong><br>' + response + '</div>');
                }
              },
              error: function(xhr, status, error) {
                $("#error-text").html('<div class="alert" role="alert"><strong>There were error(s) in your form:</strong><br>' + xhr.responseJSON.message + '</div>');
              }
            });
          }
        });
    });
  </script>
  