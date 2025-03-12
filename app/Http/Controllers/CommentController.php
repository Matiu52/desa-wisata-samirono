<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {

        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        Comment::create([
            'content' => $request->comment,
            'user_id' => auth()->id(),
            'post_id' => $post->id,
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan!');
    }
}