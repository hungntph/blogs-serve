<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\User\CommentService;

class CommentController extends Controller
{
    public function __construct(
        public CommentService $commentService,
    ) {
    }
}
