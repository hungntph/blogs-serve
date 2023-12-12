<?php

namespace App\Repositories;

use App\Models\Comment;

class CommentRepository
{
    const MODEL = Comment::class;

    public function deleteComment(int $id): bool
    {
        return Comment::where('blog_id', $id)->delete();
    }
}
