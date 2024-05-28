<!DOCTYPE html>
<html>
<head>
    <title>Transcription Result</title>
</head>
<body>
    @if($transcription['status'] === 'completed')
        <div>
            <h2>Transcription Result</h2>
            <p>{{ $transcription['text'] }}</p>
        </div>
    @else
        <div>
            <h2>Transcription in Progress</h2>
            <p>Please refresh the page after a few moments.</p>
        </div>
    @endif
</body>
</html>
