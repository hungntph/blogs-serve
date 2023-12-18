<?php
namespace App\Services\User;

use App\Repositories\LikeRepository;

class LikeService
{
    public function __construct(
        public LikeRepository $likeRepository
    ) {
    }
}
