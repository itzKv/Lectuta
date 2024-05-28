<!DOCTYPE html>
<html>
<head>
    <title>Transcribe Audio</title>
</head>
<body>
    <form action="/transcribe" method="POST">
        @csrf
        <label for="audio_url">Audio URL:</label>
        <input type="text" id="audio_url" name="audio_url">
        <button type="submit">Transcribe</button>
    </form>

    @if(session('transcription_result'))
        <div>
            <h2>Transcription Result</h2>
            <p>{{ session('placeholder/transcription_test_result') }}</p>
        </div>
    @endif
</body>
</html>
