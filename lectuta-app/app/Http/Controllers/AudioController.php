<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AudioController extends Controller
{
    public function index()
    {
        return view ('audio.upload');
    }
    
    public function upload(Request $request)
    {
        if($request->hasFile('file')) {
            return response()->json(['success' => ' Audio File Uploaded Successfully']);
        }
        else {
            return response()->json(['error' => 'Audio File Upload Failed']);
        }
    }
}
