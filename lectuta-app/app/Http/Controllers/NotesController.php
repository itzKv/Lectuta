<?php

namespace App\Http\Controllers;

use App\Services\AssemblyAiService;
use App\Services\GeminiAiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;
use DOMDocument;
use File;

class NotesController extends Controller
{
    protected $assemblyAiService;
    protected $geminiAiService;

    public function __construct(AssemblyAiService $assemblyAiService, GeminiAiService $geminiAiService)
    {
        $this->assemblyAiService = $assemblyAiService;
        $this->geminiAiService = $geminiAiService;
    }

    public function index(Request $request) {

        $userId = Auth::user()->id;
        $notesId = $request->input('notesId');

        // Find the note by user_id and notes_id in a single query
        $note = Note::where('user_id', $userId)
                    ->where('id', $notesId)
                    ->first();

        if ($note) { 
            $filename = $note->filename;
            $createdAt = $note->created_at->format('Y-m-d');
            $updatedAt = $note->updated_at->format('Y-m-d');
            $bodyHTML = $note->bodyHTML;
            return view('notes.generate', compact('notesId', 'filename', 'createdAt', 'updatedAt', 'bodyHTML'));
        } else {
            // Handle the case where the note is not found
            return response()->json(['error' => 'Note not found'], 404);
        }
    }

    public function generate(Request $request) {

        $request->validate([
            'filename' => 'required|string'
        ]);

        $filename = $request->input('filename');
        $filePath = public_path('template/assets/audio/' . $filename);

        $request->merge([
            'apiURL' => 'upload',
            'param' => $filePath
        ]);

        try {
            $response = $this->assemblyAiService->fetchFile($request);
            if (!$response) {
                return response()->json(['error' => 'Audio upload failed!'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        if (isset($response['upload_url'])) {
            $audioURL = $response['upload_url'];
        } else {
            return response()->json(['error' => 'Audio URL not found in response!'], 500);
        }
        
        $audio_language = $request->input('audio_language');

        if($audio_language == 'id') {
            $auto_language_detection = false;
        } else {
            $audio_language = 'en';
            $auto_language_detection = true;
        }

        $request->merge([
            'apiURL' => 'transcript',
            'audioURL' => $audioURL,
            'language_code' => $audio_language,
            'auto_language_detection' => $auto_language_detection
        ]);

        try {
            $response = $this->assemblyAiService->fetchData($request);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        $rawText = $response['text'];
        $basePrompt = "Command: Diatas merupakan text hasil speech to text dari sebuah lecture. Bisakah Anda merapihkannya menjadi sebuah catatan berbahasa indonesia? Perhatikan logika dari teksnya, benarkan jika ada yang salah. Kembangkan menjadi bullet_verbose. Buatlah html untuk notes tersebut agar saya dapat mengappend ke notes container di html saya dengan format: &lt;div class=\"notes-container\"&gt; --- Your Gemini Notes HTML lands here &lt;/div&gt;. Jangan ada preview atau basa-basi yang lain. Saya hanya perlu code htmlnya saja untuk saya salin dan tempel";
        $prompt = $rawText . $basePrompt;
        

        $request->merge([
            'prompt' => $prompt
        ]);

        try {
            $response = $this->geminiAiService->fetchData($request);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        $notesRes = $response['candidates'][0]['content']['parts'][0]['text'];
        $notes = $this->extractNotes($notesRes);

        $filename = pathinfo($request->input('filename'), PATHINFO_FILENAME);

        $note = new Note(); 
        $note->user_id = Auth::user()->id;
        $note->filename = $filename;
        $note->created_at = date('Y-m-d');
        $note->bodyHTML = $notes;
        $note->save();
        
        $audioPath = public_path('template/assets/audio');
        cleanDirectory($audioPath);

        $notesId = $note->id;

        return response()->json([
            'notesId' => $note->id,
            'notes' => $notes,
            'success' => true,
        ]);
    }

    private function extractNotes($notes) {

        $dom = new DOMDocument();

        // Load HTML content from the $notes variable
        $dom->loadHTML($notes);

        // Find the div with class "notes-container"
        $container = $dom->getElementsByTagName('div')->item(0);

        // Initialize an empty string to store the extracted content
        $extractedContent = '';

        // Loop through the child nodes of the container div
        foreach ($container->childNodes as $node) {
            // Serialize the node to HTML and append it to the extracted content
            $extractedContent .= $dom->saveHTML($node);
        }

        return $extractedContent;
    }

    public function myNotes(Request $request)
    {
        $userId = Auth::user()->id;
        $sortAttribute = $request->input('sort', 'updated_at');
        $sortOrder = $request->input('order', 'asc'); 
        $searchQuery = $request->input('search', '');	 

        $notes = Note::where('user_id', $userId)
            ->when($searchQuery, function($query) use ($searchQuery) {	
                return $query->where('filename', 'like', '%' . $searchQuery . '%');	
            })	
            ->orderBy($sortAttribute, $sortOrder)	
            ->get();	
            
        foreach ($notes as $note) {         
            $note->formatted_date = $note->updated_at->format('Y-m-d');

        }

        return view('notes.mynotes', compact('notes', 'sortAttribute', 'sortOrder', 'searchQuery'));
    }

    public function deleteNote(Request $request) {

        $userId = Auth::user()->id;
        $notesId = $request->input('noteId');

        // Find the note by user_id and notes_id in a single query
        $note = Note::where('user_id', $userId)
                    ->where('id', $notesId)
                    ->first();


        if ($note) {
            $note->delete();
            return response()->json(['success' => 'Note deleted successfully!']);
        } else {
            // Handle the case where the note is not found
            return response()->json(['error' => 'Note not found'], 404);
        }
    }

    public function updateTitle(Request $request) {

        $userId = Auth::user()->id;
        $notesId = $request->input('noteId');
        $newTitle = $request->input('filename');

        // Find the note by user_id and notes_id in a single query
        $note = Note::where('user_id', $userId)
                    ->where('id', $notesId)
                    ->first();

        if ($note) {
            $note->filename = $newTitle;
            $note->save();

            $request->merge([
                'notesId' => $notesId
            ]);
            return $this->index($request);
        } else {
            // Handle the case where the note is not found
            return response()->json(['error' => 'Note not found'], 404);
        }
    }
}
