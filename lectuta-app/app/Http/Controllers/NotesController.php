<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;

class NotesController extends Controller
{
    public function index() {
        $createdAt = "2024-04-22"; // dummy
        $filename = null;
        $notes = [];
        if ($handle = opendir(public_path('template/assets/audio'))) {

            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                    $filename = $entry; // NAME OF THE FILE
                    break;
                }
            }
            closedir($handle);
        }

        $dummyFilePath = public_path('template/assets/notes/dummy.txt');
        $dummyFileContents = file($dummyFilePath);

        if ($handle = opendir(public_path('template/assets/notes'))) {

            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                    $notes = $dummyFileContents;
                    break;
                }
            }
            closedir($handle);
        }

        return view('notes.generate', compact('filename', 'createdAt', 'notes'));
    }
}
