<?php
namespace App\Services\User;

use App\Models\Comment;
use App\Repositories\CommentRepository;
use Exception;

class CommentService
{
    public function __construct(
        public CommentRepository $commentRepository
    ) {
    }

    public function deleteComment(int $id): bool
    {
        try {
            return $this->commentRepository->deleteComment($id);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    
    public function createComment(array $request): array
    {
        try {
            $user = auth()->user();
            $commentData = [
                'user_id' => $user->id,
                'blog_id' => $request['blog_id'],
                'content' => $request['content'],
            ];
            $comment = $this->commentRepository->create($commentData);
            return [
                'comment' => $comment,
                'user'    => $user,
            ];
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function updateComment(int $id, array $request): bool
    {
        try {
            return $this->commentRepository->update($id, $request);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function delete(int $id): bool
    {
        try {
            return $this->commentRepository->delete($id);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getCommentById(int $id): Comment
    {
        try {
            return $this->commentRepository->getCommentById($id);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
