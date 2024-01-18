<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Services\User\BlogService;
use App\Services\User\CategoryService;
use App\Services\User\CommentService;
use App\Services\User\UploadFileService;
use Illuminate\Http\Request;

class AdminBlogController extends Controller
{
    public function __construct(
        public BlogService $blogService,
        public CategoryService $categoryService,
        public UploadFileService $uploadFileService,
        public CommentService $commentService,
        public UserRepository $userRepository,
    ) {
    }

    public function blogs(Request $request)
    {
        $auth = auth()->user();
        $blogs = $this->blogService->blogList($request->only('query', 'category_id', 'order_by', 'status'));
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
            if ($blog->image) {
                $this->uploadFileService->deleteFile($blog->image);
            }
            return back()->with('blog-update-success', trans('message.update-success'));
        }
        return back()->with('blog-update-failed', trans('message.update-failed'));
    }

    public function destroy(Request $request)
    {
        $blog = $this->blogService->getBlog($request['id']);
        $delete = $this->blogService->deleteBlog($request['id']);
        if ($delete) {
            if ($blog->image) {
                $this->uploadFileService->deleteFile($blog->image);
            }
            $this->commentService->deleteComment($request['id']);
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
