<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct(
        public UserService $userService,
    ) {
    }

    public function index()
    {
        $auth = auth()->user();
        return view("admin.dashboard", compact('auth'));
    }

    public function userList(Request $request)
    {
        $auth = auth()->user();
        $users = $this->userService->getUserList($request->only('query'));
        return view("admin.user-list", compact('users', 'auth'));
    }

    public function toggleBlock($id)
    {
        $toggleBlock = $this->userService->toggleBlockUser($id);
        if ($toggleBlock) {
            return back()->with('update-status-success', trans('message.update-status-success'));
        }
        return back()->with('update-status-failed', trans('message.update-status-failed'));
    }
}
