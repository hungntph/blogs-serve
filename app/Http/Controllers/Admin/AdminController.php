<?php

namespace App\Http\Controllers\Admin;

use App\Events\MessageNotify;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\BlogRepository;
use App\Repositories\UserRepository;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct(
        public UserService $userService,
        public UserRepository $userRepository,
        public BlogRepository $blogRepository,
    ) {
    }

    public function index()
    {
        $auth = auth()->user();
        $blogs = $this->blogRepository->getBlogByMonth();
        $users = $this->userRepository->getUserByMonth();
        return view("admin.dashboard", compact('auth', 'users', 'blogs'));
    }

    public function users(Request $request)
    {
        $auth = auth()->user();
        $users = $this->userService->getUserList($request->only('query'));
        return view("admin.user_list", compact('users', 'auth'));
    }

    public function blockUser($id)
    {
        $toggleBlock = $this->userService->toggleBlockUser($id);
        $user = $this->userRepository->getUserById($id);
        if ($toggleBlock) {
            if ($user->status == User::STATUS_BLOCKED) {
                event(new MessageNotify($user->id));
            }
            return back()->with('update-status-success', trans('message.update-status-success'));
        }
        return back()->with('update-status-failed', trans('message.update-status-failed'));
    }
}
