@extends('layouts.frontend.master')

@section('content')
<style>

.container-notes {
    min-height: 560px !important;
}
#filename {
    font-family: "PT Sans", Roboto, Tahoma, sans-serif;
}

.open-button{
    cursor: pointer;
    text-decoration: none;
}

.delete-button:hover {
    cursor: pointer;
}
.z-index, h6: hover {
    color: --bs-primary;
}
</style>


<div class="container-fluid px-2 px-md-4">
    <div class="page-header min-height-300 border-radius-xl mt-3" style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
        <span class="mask bg-gradient-primary opacity-1"></span>
            <div class="username container-fluid mb-2 ms-6 mt-2">
                <h4 class="text-white" style="font-size: 1.4rem">Hey, review your</h4>
                <h1 class="text-white text-size" style="font-size: 5.9rem">Notes Collection</h1>
        </div>
    </div>
</div>

<div class="container-fluid container-notes px-2 px-md-4">
    <div class="row mt-6">
        <?php foreach ($notes as $note) : ?>
            <?php
                // Generate a random image ID
                $imageId = rand(1, 1000);
                // Construct the URL for the random image using Lorem Picsum
                $imageUrl = "https://picsum.photos/id/{$imageId}/500/300";
            ?>

            <div class="col-lg-4 col-md-2 mt-4 mb-6">
                <div class="card z-index-2">
                    <a class="open-button" data-id="{{ $note->id }}">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                            <div class="border-radius-lg py-3 pe-1" style="background-image: url('{!!  $imageUrl !!}'); background-size: cover; background-position: center;">
                                <div class="chart">
                                    <canvas id="chart-bars" class="chart-canvas" height="305" width="529" style="display: block; box-sizing: border-box; height: 170px; width: 293.9px;"></canvas>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <h6 class="mb-0" style="color: #000000; font-size: 26px;">{!! $note->filename !!}</h6>
                            <hr class="dark horizontal">
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="text-sm ms-2">{!! $note->formatted_date !!}</p>
                                <button class="btn btn-danger bg-gradient-primary btn-sm delete-button" data-id="{{ $note->id }}"><i class="material-icons" style="font-size: 1rem;">delete</i></button>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
    $(document).ready(function() {
        const notes = @json($notes);  
        console.log("Collected Notes:", notes);
        
        $('.delete-button').click(function() {
            const noteId = $(this).data('id');
            $.ajax({
                url: "/notes/delete",
                method: 'DELETE',
                data: {
                    noteId: noteId
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $(`#note-${noteId}`).remove();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error(textStatus, errorThrown);
                }
            });
        });
        $(".open-button").click(function() {
            const noteId = $(".open-button").data('id');
            window.location.href = `/notes?notesId=${noteId}`;
        });
    });
</script>   
@endsection