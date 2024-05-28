<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AssemblyAI_APIService;

class AssemblyAI_Controller extends Controller
{
    protected $assemblyAIService;

    public function __construct(AssemblyAI_APIService $assemblyAIService)
    {
        $this->assemblyAIService = $assemblyAIService;
    }

    public function transcribe(Request $request)
    {
        $audioUrl = $request->input('audio_url');
        $transcription = $this->assemblyAIService->transcribe($audioUrl);

        // Store the transcription ID in the session
        session(['transcription_id' => $transcription['id']]);

        return redirect()->route('transcription.result');
    }

    public function showTranscriptionResult()
    {
        $transcriptionId = session('transcription_id');
        $transcription = $this->assemblyAIService->getTranscription($transcriptionId);

        return view('placeholder/transcription_test_result', ['transcription' => $transcription]);
    }
}
