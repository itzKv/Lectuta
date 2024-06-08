@extends('layouts.frontend.master')

@section('content')
<style>
.notes

#notes-heading-dates {
    color: #FFFFFF; 
    font-weight: bold; 
    font-size: 11px;
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
.notes-content h1, h2 {
    font-size: 1.8rem;
    color: #000000;
    line-height: 1.5;
    font-family: "PT Sans", Roboto, Tahoma, sans-serif;
}

#notes-body {
    color: #000000;
    font-family: "PT Sans", Roboto, Tahoma, sans-serif;
}

#notes-container {
    min-height: 560px !important;
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
            <div class="col-lg-10">
                <h1 id="filename" class="mt-4 mb-4 ms-4" style="color: #000000; font-size: 28px;">{!! $filename !!}</h1>
            </div>
            <div class="col-lg-2">
                <div class="float-lg-end pe-4">
                    <p id="created-date" class="mt-2 me-2" id="notes-heading-dates">{!! $createdAt !!}</p>
                </div>
            </div>
        </div>

        <form class="row" action="/notes/updateTitle" method="POST">
            @csrf
            <input type="hidden" name="noteId" value="{{ $notesId }}">
            <div class="row mb-2">
                <label for="title" class="ac-center col-lg-1 mr-2">New Title:</label>
                <input type="text" class="ac-center col-lg-5" name="filename" value="{{ $filename }}">
                <button type="submit" class="ac-center col-lg-1 btn btn-primary">Update</button>
            </div>
        </form>

        <hr class="dark horizontal">
    
        <div class="col-lg-12 notes-content" id="notes-body" style="max-height: 380px; overflow-y: auto;">
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
