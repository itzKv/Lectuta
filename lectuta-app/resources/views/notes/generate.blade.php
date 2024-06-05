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
                <h1 class="mt-4 mb-4 ms-4" style="color: #000000; size: 28px;">Title of the documents</h1>
            </div>
            <div class="col-lg-2">
                <div class="float-lg-end pe-4">
                    <p class="mt-2 me-2" id="notes-heading-dates">23/12/2024</p>
                </div>
            </div>
        </div>


        <hr>
    
        <div class="col-lg-12 ms-2" style="max-height: 380px; overflow-y: auto;">
            <div class="notes-sub-heading mt-4 ms-4 me-4">
                <h3 style="color: #000000;">Lorem ipsum dolor sit amet consectetur adipisicing elit.</h3>
            </div>
            <div class="notes-content ms-4 me-4">
                <ul>
                    <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum unde quam, fugiat, cumque, explicabo a modi mollitia ipsum sed repellendus qui adipisci laboriosam reiciendis voluptas est veniam atque cupiditate itaque? Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati, reiciendis hic fuga dolores expedita voluptatum saepe ipsum consectetur dicta voluptas incidunt dolorem sequi quia esse pariatur dolorum totam doloribus dignissimos.</li>
                    <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat aspernatur reprehenderit suscipit non, itaque nihil, dolorum aperiam voluptate odio laboriosam quia nam deserunt, cupiditate ut at commodi maiores ducimus eaque?</li>
                    <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus ipsam cupiditate sunt. Qui aspernatur sed laboriosam consequuntur quasi provident veritatis deleniti placeat, excepturi dicta cupiditate itaque, non officiis fugit doloremque.</li>
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus explicabo, eum autem amet cumque similique. Minus illo nisi, esse cupiditate dolorum magnam, explicabo vel totam vitae ut saepe officia numquam!</li>
                    <li>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit reiciendis, odit pariatur fuga corporis qui quasi a, distinctio tenetur est, sapiente quidem doloremque sequi maxime vitae nulla error odio earum! Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nostrum tempore porro maiores repellendus. At repudiandae officia a enim aliquid atque eius, explicabo aspernatur libero corporis ea! Iure doloribus consequatur ex. Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde aliquid magnam iste ipsum saepe blanditiis, facere excepturi ut. Impedit numquam sed necessitatibus maiores. Voluptas quis vel id facilis dignissimos omnis.</li>
                    <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis nihil commodi magnam deleniti. Mollitia harum, ipsum sit cum iure fugit maiores delectus ab praesentium eligendi! Doloribus tempore tempora pariatur voluptas!</li>
                </ul>
            </div>

            <div class="notes-sub-heading mt-4 ms-4 me-4">
                <h3 style="color: #000000;">Lorem ipsum amet consectetur elit.</h3>
            </div>
            <div class="notes-content ms-4 me-4">
                <ul>
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus explicabo, eum autem amet cumque similique. Minus illo nisi, esse cupiditate dolorum magnam, explicabo vel totam vitae ut saepe officia numquam!</li>
                    <li>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit reiciendis, odit pariatur fuga corporis qui quasi a, distinctio tenetur est, sapiente quidem doloremque sequi maxime vitae nulla error odio earum! Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nostrum tempore porro maiores repellendus. At repudiandae officia a enim aliquid atque eius, explicabo aspernatur libero corporis ea! Iure doloribus consequatur ex. Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde aliquid magnam iste ipsum saepe blanditiis, facere excepturi ut. Impedit numquam sed necessitatibus maiores. Voluptas quis vel id facilis dignissimos omnis.</li>
                    <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis nihil commodi magnam deleniti. Mollitia harum, ipsum sit cum iure fugit maiores delectus ab praesentium eligendi! Doloribus tempore tempora pariatur voluptas!</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jscroll/#.#.#/jquery.jscroll.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        e.preventDefault();
        $.ajax({
            url: '/audio/upload',
            type: 'GET',
            success: function(response) {
                $('#audioFileName').text(response.filename);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    })  
</script>

@endsection 