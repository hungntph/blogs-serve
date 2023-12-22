<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Services\User\UploadFileService;
use App\Services\User\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct(
        public UserService $userService,
        public UploadFileService $uploadFileService
    ) {
    }

    public function likeBlog(Request $request)
    {
        $liked = $this->userService->toggleLike($request->only('blog_id'));
        return response()->json($liked);
    }

    public function index()
    {
        $auth = auth()->user();
        return view("user.profile", compact('auth'));
    }

    public function update($id, UpdateProfileRequest $request)
    {
        if ($request->file('file')) {
            $oldFile = auth()->user()->avatar;
            $uploadFile = $this->uploadFileService->uploadFile($request->file('file'));
            $request = array_merge($request->only('name', 'phone', 'gender'), ['avatar' => $uploadFile]);
        } else {
            $request = $request->only('name', 'phone', 'gender');
        }
        $updateProfile = $this->userService->updateProfile($id, $request);
        if ($updateProfile) {
            if (isset($oldFile)) {
                $this->uploadFileService->deleteFile($oldFile);
            }
            return back()->with('profile-update-success', trans('message.profile-update-success'));
        }
        return back()->with('profile-update-failed', trans('message.profile-update-failed'));
    }

    public function changePassword()
    {
        $auth = auth()->user();
        return view("user.change-password", compact('auth'));
    }

    public function updatePassword(int $id, ChangePasswordRequest $request)
    {
        if (Hash::check($request['old-password'], auth()->user()->password)) {
            $changePassword = $this->userService->changePassword($id, $request->only('password'));
            if ($changePassword) {
                return back()->with('change-password-success', trans('message.change-password-success'));
            }
            return back()->with('change-password-failed', trans('message.change-password-failed'));
        } else {
            return back()->with('old-password-incorrect', trans('message.old-password-incorrect'));
        }
    }
}
