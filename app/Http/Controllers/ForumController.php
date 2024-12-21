<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ForumThread;


class ForumController extends Controller
{
    // Get Forum Thread
    public function index()
    {
        $threads = ForumThread::orderBy('created_at', 'desc')->get();
        return view('forum.index', compact('threads'));
    }
    // Submit forum thread
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'text' => 'required|string',
        ]);

        ForumThread::create([
            'username' => $request->username,
            'title' => $request->title,
            'text' => $request->text,
            'replies_count' => 0,
            'likes_count' => 0,
        ]);

        return redirect()->route('forum.index')->with('success', 'Thread created successfully!');
    }
    // public function like($id)
    // {
    //     $thread = ForumThread::findOrFail($id);
    //     $thread->increment('likes_count');

    //     return response()->json([
    //         'likes_count' => $thread->likes_count,
    //     ]);
    // }
}
