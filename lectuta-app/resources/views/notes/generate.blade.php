@extends('layouts.frontend.master')

@section('content')
<style>

#notes-heading-dates {
    color: #FFFFFF; 
    font-weight: bold; 
    font-size: 11px;
    letter-spacing: 0.1px;
}
.hr { 
  display: block;
  margin-top: 0.5em;
  margin-bottom: 0.5em;
  margin-left: auto;
  margin-right: auto;
  border-width: 3px;
  background: #FFFFFF;
} 

.notes-sub-heading {
    size: 18px;
    font-weight: 2px;
    color: #000000;
}
.notes-content {
    size: 14px;
}
</style>

<div class="container-fluid px-2 px-md-4">
    <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
      <span class="mask bg-gradient-primary opacity-1"></span>
      <div class="username container-fluid mb-2 ms-6 mt-2">
        <h4 class="text-white" style="font-size: 1.4rem">Take a look at your</h4>
        <h1 class="text-white text-size" style="font-size: 5.9rem">Notes</h1>
      </div>
    </div>
    <hr>
</div>
<div class="container-fluid px-2 px-md-4">
    <div class="min-height-500 border-radius-xl mt-4" style="background-color: #B8B8B8;">
        <div class="row">
            <div class="col-lg-10">
                <h1 id="filename" class="mt-4 mb-4 ms-4" style="color: #000000; size: 28px;">{!! $filename !!}</h1>
            </div>
            <div class="col-lg-2">
                <div class="float-lg-end pe-4">
                    <p id="created-date" class="mt-2 me-2" id="notes-heading-dates">{!! $createdAt !!}</p>
                </div>
            </div>
        </div>


        <hr>
    
        <div class="col-lg-12 ms-2" id="notes-body" style="max-height: 380px; overflow-y: auto;">
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