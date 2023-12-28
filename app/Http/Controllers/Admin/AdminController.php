<?php

namespace App\Http\Controllers\Admin;

use App\Events\MessageNotify;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\User\BlogService;
use App\Services\User\CategoryService;
use App\Services\User\CommentService;
use App\Services\User\UploadFileService;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct(
        public UserService $userService,
        public BlogService $blogService,
        public CategoryService $categoryService,
        public UploadFileService $uploadFileService,
        public CommentService $commentService,
        public UserRepository $userRepository,
    ) {
    }

    public function index()
    {
        $auth = auth()->user();
        return view("admin.dashboard", compact('auth'));
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

    public function blogs(Request $request)
    {
        $auth = auth()->user();
        $blogs = $this->blogService->blogList($request->only('query', 'category_id'));
        $categories = $this->categoryService->getCategories();
        return view("admin.blog_list", compact('blogs', 'auth', 'categories'));
    }

    public function edit($id)
    {
        $auth = auth()->user();
        $blog = $this->blogService->getBlog($id);
        $categories = $this->categoryService->getCategories();
        return view("admin.blog_detail", compact('blog', 'categories', 'auth'));
    }

    public function update($id, Request $request)
    {
        if ($request->file('file')) {
            $uploadFile = $this->uploadFileService->uploadFile($request->file('file'));
            $request = array_merge($request->only('category_id', 'title', 'content'), ['image' => $uploadFile]);
        } else {
            $request = $request->only('category_id', 'title', 'content');
        }
        $blog = $this->blogService->getBlog($id);
        $updateBlog = $this->blogService->update($id, $request);
        if ($updateBlog) {
            $this->uploadFileService->deleteFile($blog->image);
            return back()->with('blog-update-success', trans('message.update-success'));
        }
        return back()->with('blog-update-failed', trans('message.update-failed'));
    }

    public function destroy($id)
    {
        $blog = $this->blogService->getBlog($id);
        $delete = $this->blogService->deleteBlog($id);
        if ($delete) {
            $this->uploadFileService->deleteFile($blog->image);
            $this->commentService->deleteComment($id);
            return back()->with('delete-blog-success', trans('message.delete-blog-success'));
        }
        return back()->with('delete-blog-failed', trans('message.delete-blog-failed'));
    }

    public function approvedBlog($id)
    {
        $toggleApproved = $this->blogService->toggleApproved($id);
        if ($toggleApproved) {
            return back()->with('blog-update-success', trans('message.update-success'));
        }
        return back()->with('blog-update-failed', trans('message.update-failed'));
    }
}
