@extends('layouts.frontend.master')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/min/dropzone.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/min/dropzone.min.js"></script>
<link href='https://unpkg.com/css.gg@2.0.0/icons/css/add.css' rel='stylesheet'>

<style>
/* Icon */
.gg-add {
   box-sizing: border-box;
   position: relative;
   display: block;
   width: 22px;
   height: 22px;
   border: 2px solid;
   transform: scale(var(--ggs,1));
   border-radius: 22px;
   margin: 0 auto;
}
.gg-add::after,
.gg-add::before {
   content: "";
   display: block;
   box-sizing: border-box;
   position: absolute;
   width: 10px;
   height: 2px;
   background: currentColor;
   border-radius: 5px;
   top: 8px;
   left: 4px
}
.gg-add::after {
   width: 2px;
   height: 10px;
   top: 4px;
   left: 8px
}

/* Dropzone */

.dropzone {
  border-radius: 13px;
  margin-left: auto;
  margin-right: auto;
  border: 2px dotted black;
  font-size: 1.6rem; 
  font-weight: 500;
  height: auto;
}
.btn{
  padding-left: 50px;
  padding-right: 50px;
  margin-left: 32px;
  margin-right: 32px;
}

.card-header h1{
  color: black;
  font-weight: 460;
  font-size: 1.9rem;
  letter-spacing: 1.6px;
}
h5 {
  color: black;
  font-weight: 400;
}
.container-fluid{
  padding-right: 0;
  padding-left: 0; 
}

</style>


<div class="container-fluid px-2 px-md-4">
    <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
      <span class="mask bg-gradient-primary opacity-1"></span>
      <div class="username container-fluid mb-2 ms-6 mt-2">
        <h4 class="text-white" style="font-size: 1.4rem">Not in lecture? Just</h4>
        <h1 class="text-white text-size" style="font-size: 5.9rem">Upload</h1>
      </div>
    </div>
    <hr>
    <div class="min-height-300 ms-auto text-center">
      <form action="{{ route('uploadAudio') }}" method="POST" enctype="multipart/form-data" id="audioUpload" class="dropzone text-black">
        @csrf
        <div class="dz-message mb-2 mt-2" data-dz-message><i class="gg-add mt-4" id="add-icon"></i></div>
        <div class="dz-message mb-2 mt-2" data-dz-message><span>Drop files to upload</span></div>
        <div class="dz-message mt-2" style="font-size: 0.9rem;" data-dz-message>
          <span class="text-primary">Browse</span><span> from your computer</span>
        </div>
      </form>     

      <h5 class="text-black mt-4" id="message"></h5>
    </div>

    <div class="min-height-200 ms-auto">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm text-center">
              <div class="card card-plain">
                  <div class="card-header" style="min-height: 175px;">
                    <h1 id="audioFileName" class="mt-2 mb-4">Audio File</h1>
                    <p id="audioFileDetail" class="mb-0">Details of the file</p>
                  </div>
              </div>
            </div>

            <div class="col-sm text-center">
              <div class="card card-plain">
                <div class="card-header" style="min-height: 175px;">
                  <form> <!-- Note: add route to edit audio -->
                    <h1 class="mt-2 mb-4">
                      Generate your <span class="text-primary">notes</span> now?
                    </h1>
                    <div class="button-container">
                      <!-- <button id="cancel-button" class="btn btn-white ml-2 mr-8" style="border:0.5px solid black;">Cancel</button> -->
                      <form action="" method="GET" id="editAudio">
                        @csrf
                        <input id="filepath" type="hidden" name="filepath" value="" autocomplete="off">
                        <button id="continue-button" class="btn btn-primary ml-8 mr-2">Continue</button>
                      </form>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  
</div>

<script>
    var maxFilesizeVal = 100; // 100MB
    var maxFilesVal = 1;
    Dropzone.options.audioUpload = {
        paramName:"file",
        maxFilesize: maxFilesizeVal, // MB
        maxFiles: maxFilesVal,
        resizeQuality: 1.0,
        acceptedFiles: ".mp3",
        addRemoveLinks: true,
        createImageThumbnails: true,
        timeout: 120000,
        dictDefaultMessafge: "Drop your files here or browse from your computer to upload",
        dictRemoveFile: 'Remove Audio',
        dictFileTooBig: 'File too big',
        dictFallbackMessage: "Your browser doesn't support drag and drop file uploads.",
        dictInvalidFileType: "Invalid file type. Only MP3 files are allowed.",
        dictMaxFilesExceeded: "You can only upload up to "+maxFilesVal+" files.",
        init: function() {
            this.on("complete", function(file) {
                $(".dz-remove").html("<div class='mt-4 mb-2'><span class='fa fa-trash text-danger' style='font-size: 1.5em; cursor: pointer; font-color: primary'></span></div>");
            });

            this.on("removedfile", function(file) {
              $('#message').text('Audio delete in progress...');
              $("#continue-button").prop("disabled", true);
              $.ajax({
                url: "/audio/upload", // Replace with your actual route path
                method: "DELETE", // Adjust based on your route (GET, POST, etc.)
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // Update UI on successful deletion (e.g., reset text, file input)
                    $('#audioFileName').text('Audio File');
                    $('#audioFileDetail').text('Details of the file');
                    $('#filepath').val('');
                    $('#message').text('Audio deleted successfully');
                    setTimeout(function() {
                      $('#message').text('');
                    }, 5000);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Error deleting audio:", textStatus, errorThrown);
                    // Handle errors (e.g., display error message)
                },
                complete: function() {
                    $("#continue-button").prop("disabled", false);
                }
            });
        });
        },
        maxfilesexceeded: function(file) {
            this.removeFile(file);
        },
        sending: function (file, xhr, formData) {
            $('#message').text('Audio Uploading...');
        },
        success: function (file, response) {
            $('#message').text(response.success);
            $('#audioFileName').text(response.filename);
            $('#audioFileDetail').text(response.duration);
            $('#filepath').val(response.filenameWithExtension);
        },
        error: function (file, response) {
            var errorMessage = '';
            if (typeof response === 'string') {
              errorMessage = response;
            } else if (typeof response === 'object') {
              errorMessage = response;
            } else {
              errorMessage = 'Something Went Wrong!';
            }
            $('#message').text(errorMessage);
            console.log(response);
            return false;
        },
        removefile: function(file) {
            this.removeFile(file);
            $('#message').text('Success delete');
        },
    };

    $('#continue-button').click(function() {
      if($('#filepath').val() == '') {
        $('#message').text('Please upload an audio file first.');
      } else {
        $("#continue-button").prop("disabled", true);
        $('#message').text('Generating notes...');
        $.ajax({
                url: "/notes", // Replace with your actual route path
                method: "POST", // Adjust based on your route (GET, POST, etc.)
                data: {
                    filename: $('#filepath').val()
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#message').text('Succesfully generating notes');
                    console.log(response);
                    window.location.href = "/notes?notesId=" + response.notesId;
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $('#message').text("Error generating audio:", textStatus, errorThrown);
                    // Handle errors (e.g., display error message)
                },
                complete: function() {
                    $("#continue-button").prop("disabled", false);
                }
            });
      }
    })


</script>

@endsection