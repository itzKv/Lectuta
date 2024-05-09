<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use getID3;

class AudioController extends Controller
{
    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        $audioPath = public_path('template/assets/audio');
        File::cleanDirectory($audioPath);
        return view ('audio.upload');
    }
    
    public function upload(Request $request)
    {
        $file = $request->file('file');
        $filenameWithExtension = $file->getClientOriginalName();
        $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);

        $getID3 = new getID3();
        $fileInfo = $getID3->analyze($file->getRealPath());
        $durationInSeconds = $fileInfo['playtime_seconds'];
        $duration = gmdate("i\m s\s", $durationInSeconds);

        $destinationPath = public_path('template/assets/audio');
        $file->move($destinationPath, $filenameWithExtension);

        return response()->json(['filenameWithExtension' => $filenameWithExtension, 'filename' => $filename, 'success' => 'Audio uploaded successfully!', 'duration' => $duration]);
    }

    public function delete(Request $request)
    {
        $audioPath = public_path('template/assets/audio');
        File::cleanDirectory($audioPath);

        return response()->json(['success' => 'Audio deleted successfully!']);
    }
}
