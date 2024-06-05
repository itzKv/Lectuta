<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use File;

class NotesController extends Controller
{
    public function index() {
        $createdAt = "2024-04-22"; // dari BE
        $filename = Session::get('filename'); // harusnya panggil dari database
        $notes = "
            <div class=\"notes-sub-heading mt-4 ms-4 me-4\">
                    <h3 style=\"color: #000000;\">Lorem ipsum dolor sit amet consectetur adipisicing elit.</h3>
                </div>
                <div class=\"notes-content ms-4 me-4\">
                    <ul>
                        <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum unde quam, fugiat, cumque, explicabo a modi mollitia ipsum sed repellendus qui adipisci laboriosam reiciendis voluptas est veniam atque cupiditate itaque? Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati, reiciendis hic fuga dolores expedita voluptatum saepe ipsum consectetur dicta voluptas incidunt dolorem sequi quia esse pariatur dolorum totam doloribus dignissimos.</li>
                        <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat aspernatur reprehenderit suscipit non, itaque nihil, dolorum aperiam voluptate odio laboriosam quia nam deserunt, cupiditate ut at commodi maiores ducimus eaque?</li>
                        <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus ipsam cupiditate sunt. Qui aspernatur sed laboriosam consequuntur quasi provident veritatis deleniti placeat, excepturi dicta cupiditate itaque, non officiis fugit doloremque.</li>
                        <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus explicabo, eum autem amet cumque similique. Minus illo nisi, esse cupiditate dolorum magnam, explicabo vel totam vitae ut saepe officia numquam!</li>
                        <li>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit reiciendis, odit pariatur fuga corporis qui quasi a, distinctio tenetur est, sapiente quidem doloremque sequi maxime vitae nulla error odio earum! Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nostrum tempore porro maiores repellendus. At repudiandae officia a enim aliquid atque eius, explicabo aspernatur libero corporis ea! Iure doloribus consequatur ex. Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde aliquid magnam iste ipsum saepe blanditiis, facere excepturi ut. Impedit numquam sed necessitatibus maiores. Voluptas quis vel id facilis dignissimos omnis.</li>
                        <li>Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis nihil commodi magnam deleniti. Mollitia harum, ipsum sit cum iure fugit maiores delectus ab praesentium eligendi! Doloribus tempore tempora pariatur voluptas!</li>
                    </ul>
            </div>
        "; // Dari BE
        return view('notes.generate', compact('filename', 'createdAt', 'notes'));
    }
}
