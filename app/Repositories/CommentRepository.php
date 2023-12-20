<?php

namespace App\Repositories;

use App\Models\Comment;

class CommentRepository
{
    public function deleteComment(int $id): bool
    {
        return Comment::where('blog_id', $id)->delete();
    }

    public function create(array $comment): Comment
    {
        return Comment::create($comment);
    }

    public function update(int $id, array $request): bool
    {
        return Comment::findOrFail($id)->update($request);
    }

    public function delete(int $id): bool
    {
        return Comment::findOrFail($id)->delete();
    }

    public function getCommentById(int $id): Comment
    {
        return Comment::findOrFail($id);
    }
}
