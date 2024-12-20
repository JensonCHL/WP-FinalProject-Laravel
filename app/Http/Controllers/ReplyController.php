<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\ForumThread;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'text' => 'required|string|max:1000',
        ]);

        Reply::create([
            'forum_thread_id' => $id,
            'username' => $request->username,
            'text' => $request->text,
        ]);

        return redirect()->route('forum.index')->with('success', 'Reply added successfully!');
    }
}
