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
            <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 start-0 text-center justify-content-center flex-column">
              <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center" style="background-image: url('../template/assets/img/illustrations/illustration-signup.jpg'); background-size: cover;">
              </div>
            </div>
            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-5">
              <div class="card card-plain">
                <div class="card-header">
                  <h4 class="font-weight-bolder">Sign In</h4>
                  <p class="mb-0">Hello, Welcome to Lectuta!</p>
                </div>
                <div class="card-body">
                  <form role="form">
                    @csrf
                    <div class="input-group input-group-outline mb-3">
                      <label class="form-label">Email</label>
                      <input type="email" class="form-control">
                    </div>
                    <div class="input-group input-group-outline">
                      <label class="form-label">Password</label>
                      <input type="password" class="form-control">
                    </div>
                    <div class=" col-12 d-flex justify-content-end">
                      <a href="{{ route('goToForgot') }}" class="text-secondary">Forgot Password?</a>
                    </div>
                    <div id="error-text"></div>
                    <div class="text-center">
                      <button type="button" id="btnSubmit" class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-3 mb-0">Sign In</button>
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-2 text-sm mx-auto">
                    Don't have an account?
                    <a href="{{ route('goToRegister') }}" class="text-primary text-gradient font-weight-bold">Sign up</a>
                  </p>
                </div>
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
          var email = $("input[type='email']").val();
          var password = $("input[type='password']").val();
          var error = "";

          if (email == "") {
            error += "Email is required<br>";
          }
          if (password == "") {
            error += "Password is required<br>";
          }

          if (error != "") {
            $("#error-text").html('<div class="alert" role="alert"><strong>There were error(s) in your form:</strong><br>' + error + '</div>');
          } else {
            $("#error-text").html("");
            $.ajax({
              url: "/login",
              type: "POST",
              data: {
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
                console.log(xhr)
                $("#error-text").html('<div class="alert" role="alert"><strong>There were error(s) in your form:</strong><br>' + xhr.responseJSON.message + '</div>');
              }
            });
          }
        });
    });
  </script>
  