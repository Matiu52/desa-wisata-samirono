<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Services\CommentService;
use App\Http\Requests\Comment\StoreCommentRequest;
use App\Http\Requests\Comment\ReplyCommentRequest;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    protected $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function store(StoreCommentRequest $request, Post $post)
    {
        $this->commentService->storeComment($post, $request->validated());

        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan!');
    }

    public function reply(ReplyCommentRequest $request, Comment $comment)
    {
        $this->commentService->replyComment($comment, $request->validated());

        return back()->with('success', 'Balasan berhasil ditambahkan!');
    }

    public function destroy(Comment $comment)
    {
        if (Auth::user()->role_id === 1 || Auth::id() === $comment->user_id) {
            $this->commentService->deleteComment($comment);
            return back()->with('success', 'Komentar berhasil dihapus!');
        }

        return back()->with('error', 'Anda tidak memiliki izin untuk menghapus komentar.');
    }
}
