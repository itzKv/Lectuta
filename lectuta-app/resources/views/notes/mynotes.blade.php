@extends('layouts.frontend.master')

@section('content')
<?php foreach ($notes as $note) : ?>
    <div class="container-fluid px-2 px-md-4" id="note-{{ $note->id }}">
        <div class="min-height-500 border-radius-xl mt-4" style="background-color: #f2edee;">
            <div class="row">
                <div class="col-lg-10">
                    <h1 id="filename" class="mt-4 mb-4 ms-4" style="color: #000000; size: 28px;">{!! $note->filename !!}</h1>
                </div>
                <div class="col-lg-2">
                    <button class="btn btn-danger delete-button" data-id="{{ $note->id }}">Delete</button>
                </div>
            </div>
        </div>
    </div>
  <?php endforeach; ?>

<script>
    $(document).ready(function() {
        const notes = @json($notes); 
        console.log("Collected Notes:", notes);
        
        $('.delete-button').click(function() {
            const noteId = $(this).data('id');
            $.ajax({
                url: `/notes/delete`,
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
    });
</script>   
@endsection 