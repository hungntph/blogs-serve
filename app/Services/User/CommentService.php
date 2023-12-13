<?php
namespace App\Services\User;

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
}
