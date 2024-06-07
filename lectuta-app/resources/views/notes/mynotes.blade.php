@extends('layouts.frontend.master')

@section('content')

<style>
    .delete-button {
        float: right;
        margin-top: 10px;
    }
    .note-container {
        background-color: #f2edee;
        border-radius: 10px;
        padding: 15px;
        margin-bottom: 10px;
    }
    .form-inline-custom {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .form-control-custom {
        border: 2px solid #ccc;
        border-radius: 4px;
        padding: 8px;
        width: auto;
    }
</style>

<div class="container mt-4">
    <h1 class="mb-4">Notes</h1>

    <!-- Search and Sorting Form -->
    <form method="GET" action="{{ route('goToMyNotes') }}" class="form-inline-custom mb-4">
        <input type="text" name="search" class="form-control form-control-custom mb-2 mr-sm-2" placeholder="Search notes" value="{{ $searchQuery }}">
        
        <select name="sort" class="form-control form-control-custom mb-2 mr-sm-2">
            <option value="created_at" {{ $sortAttribute == 'created_at' ? 'selected' : '' }}>Sort by Created At</option>
            <option value="filename" {{ $sortAttribute == 'filename' ? 'selected' : '' }}>Sort by Filename</option>
            <!-- Add more sorting options as needed -->
        </select>

        <select name="order" class="form-control form-control-custom mb-2 mr-sm-2">
            <option value="asc" {{ $sortOrder == 'asc' ? 'selected' : '' }}>Ascending</option>
            <option value="desc" {{ $sortOrder == 'desc' ? 'selected' : '' }}>Descending</option>
        </select>

        <button type="submit" class="btn btn-primary mb-2">Apply</button>
        </form>

    @foreach ($notes as $note)
        <div class="note-container" id="note-{{ $note->id }}">
            <div class="row">
                <div class="col-md-10">
                    <h2 class="mt-2 mb-2" style="color: #000;">{{ $note->filename }}</h2>
                    <p>Created at: {{ $note->created_at }}</p>
                </div>
                <div class="col-md-2 text-right">
                    <button class="btn btn-danger delete-button" data-id="{{ $note->id }}">Delete</button>
                </div>
            </div>
        </div>
    @endforeach
</div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
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