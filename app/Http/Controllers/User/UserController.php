<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(
        public UserService $userService,
    ) {
    }

    public function likeBlog(Request $request)
    {
        $liked = $this->userService->toggleLike($request->only('blog_id'));
        return response()->json($liked);
    }
}
