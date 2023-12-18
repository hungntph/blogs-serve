<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\User\LikeService;

class LikeController extends Controller
{
    public function __construct(
        public LikeService $likeService
    ) {
    }
}
