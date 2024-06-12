@extends('layouts.frontend.master')

@section('content')
<style>
#notes-heading-dates {
    color: #000000; 
    font-size: 16px;
    letter-spacing: 0.1px;
}

.notes-sub-heading {
    font-size: 18px;
    font-weight: 2px;
    color: #000000;
}
.notes-content {
    font-size: 14px;
    margin-left: 1.8rem;
}
.notes-content h1 {
    font-size: 2rem;
    color: #000000;
    line-height: 1.5;
    font-family: "PT Sans", Roboto, Tahoma, sans-serif;
}
.notes-content h2 {
    font-size: 1.75rem;
    color: #000000;
    line-height: 1.5;
    font-family: "PT Sans", Roboto, Tahoma, sans-serif;
}
.notes-content h3, h4 {
    font-size: 1.5rem;
    color: #000000;
    line-height: 1.5;
    font-family: "PT Sans", Roboto, Tahoma, sans-serif;
}
.notes-content ul {
    font-size: 1.2rem;
    color: #000000;
    line-height: 1.5;
    font-family: "PT Sans", Roboto, Tahoma, sans-serif;
}

li {
    font-size: 1rem ;
    font-weight: 300 ;
    color: #000000 ;
    line-height: 1.625 ;
    font-family: "PT Sans", Roboto, Tahoma, sans-serif;
}

#notes-body {
    color: #000000;
    font-family: "PT Sans", Roboto, Tahoma, sans-serif;
    max-height: 340px;
    overflow-y: auto;
    box-sizing: border-box;
    padding-right: 4rem; /* Adjust padding as needed */
}

#notes-container {
    min-height: 560px !important;
    box-sizing: border-box;
}

#filename {
    color: #000000; 
    font-size: 46px;
    letter-spacing: 0.15rem;
}

.form-container label {
    font-weight: bold;
}
.form-container input[type="text"] {
    margin-bottom: 1rem;
}
.form-container button {
    background-color: #007bff;
    border: none;
}
.form-container button:hover {
    background-color: #0056b3;
}
.w-20p {
    width: 20%;
}
.w-80p {
    width: 80%;
}
.ac-center {
    align-content: center;
}
.form-label {
    width: 100%;
}

@media (max-width: 768px) {
    .form-label {
        width: 100%;
    }

    .col-form-label, .btn {
        width: 100%;
        text-align: left;
    }
}

.custom-form-container {
    max-width: 600px;
    width: 100%;
    margin: 0 auto;
    padding: 10px;
}

</style>

<div class="container-fluid px-2 px-md-4">
    <div class="page-header min-height-300 border-radius-xl mt-3" style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
        <span class="mask bg-gradient-primary opacity-1"></span>
        <div class="username container-fluid mb-2 ms-6 mt-2">
            <h4 class="text-white" style="font-size: 1.4rem">Take a look at your</h4>
            <h1 class="text-white text-size" style="font-size: 5.9rem">Notes</h1>
        </div>
    </div>
</div>

<div class="container-fluid px-2 px-md-4">
        <div class="border-radius-xl mt-4" id="notes-container" style="background-color: #f2edee;">
            <div class="row">
                <div class="col-lg-12 position-relative">
                    <h1 id="filename" class="text-center mt-4 mb-2 w-100">{!! $filename !!}</h1>
                    <div class="position-absolute top-0 end-0 me-4 mt-2">
                        <p id="notes-heading-dates">{!! $createdAt !!}</p>
                    </div>
                    <div class="col-lg-12 justify-content-between">
                        <div class="custom-form-container mt-1">
                            <form class="row g-3" action="/notes/updateTitle" method="POST">
                                @csrf
                                <input type="hidden" name="noteId" value="{{ $notesId }}">
                                <div class="row d-flex align-items-center">
                                    <label for="title" class="ac-center col-lg-2 ms-2 text-center">New Title:</label>
                                    <div class="col-lg-7">
                                        <input type="text" class="form-label b" name="filename" value="{{ $filename }}">
                                    </div>
                                    <div class="col-lg-2">
                                        <button type="submit" class="btn btn-primary btn-sm mt-2">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

            <hr class="dark horizontal">

            <div class="col-lg-12 notes-content" id="notes-body">
                {!! $bodyHTML !!}
            </div>
        </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jscroll/#.#.#/jquery.jscroll.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Check if $filename exists
        @if(isset($filename))
            console.log("Filename exists:", {!! json_encode($filename) !!});
        @else
            console.log("Filename does not exist.");
        @endif
    });
</script>
@endsection
