<!DOCTYPE html>
<html lang="en">
@include('layouts.frontend.head')
<body>
  
<div class="container-fluid px-2 px-md-4">
      <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
        <span class="mask  bg-gradient-primary  opacity-6"></span>
        <div class="container-fluid text-center mb-5">
            <h1 class="text-white">Welcome to LECTUTA</h1>
        </div>
      </div>
      <div class="card card-body mx-3 mx-md-4 mt-n6">
        <div class="row align-items-center">
            <div class="col-3 mt-4">
                <div class="row  align-items-center">
                    <div class="col-xl-3 mb-xl-0">
                        <div class="card-header p-0 mt-n4 mx-3">
                            <a >
                            <img src="{{asset('../template/assets/img/lec-welcome/welcome.png')}}">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-9 mt-4">
            At LECTUTA, we believe in simplifying the note-taking process to enhance learning and productivity. Our app is designed to transform spoken lectures into concise, organized notes effortlessly. With our voice-to-text technology, users can capture lectures in real-time and have them summarized instantly. Moreover, LECTUTA categorizes notes efficiently, making it easy to locate and review important information. Whether you're a student striving for academic success or a professional seeking efficient note-taking solutions, LECTUTA is your trusted companion. Join us in revolutionizing the way you capture knowledge and streamline your learning experience.
            </div>
        </div>
        <div class="row align-items-center mt-5">
            <h2 class="col-7 mt-4">
                Takes your notes now!
            </h2>
            <div class="col-md-5 mt-4">
                <div class="row gap-2">
                    <a href="{{ route('goToLogin') }}" class="col-md-5 btn bg-gradient-primary mb-0 ">Sign in</a>
                    <a href="{{ route('goToRegister') }}" class="col-md-5 btn bg-gradient-primary mb-0">Sign Up</a>
                </div>
            </div>
        </div>
      </div>
      @include('layouts.backend.admin.footer')
</div>  
</body>
</html>