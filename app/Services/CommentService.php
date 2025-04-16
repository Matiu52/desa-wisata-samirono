<?php
namespace App\Services;

use App\Models\Comment;
use App\Models\Post;

class CommentService
{
    public function storeComment(Post $post, array $data)
    {
        return Comment::create([
            'content' => $data['comment'],
            'user_id' => auth()->id(),
            'post_id' => $post->id,
        ]);
    }

    public function replyComment(Comment $comment, array $data)
    {
        return $comment->replies()->create([
            'content' => $data['reply'],
            'user_id' => auth()->id(),
            'post_id' => $comment->post_id,
        ]);
    }

    public function deleteComment(Comment $comment)
    {
        return $comment->delete();
    }
}