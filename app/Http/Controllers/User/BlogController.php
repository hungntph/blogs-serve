<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBlogRequest;
use App\Services\User\BlogService;
use App\Services\User\CategoryService;
use App\Services\User\UploadFileService;

class BlogController extends Controller
{
    public function __construct(
        public BlogService $blogService,
        public CategoryService $categoryService,
        public UploadFileService $uploadFileService,
    ) {
    }

    public function index()
    {
        $userId = auth()->user()->id;
        $categories = $this->categoryService->getCategories();
        return view("blogs.create_blog", compact('categories', 'userId'));
    }

    public function create(CreateBlogRequest $request)
    {
        if ($request->file('file')) {
            $uploadFile = $this->uploadFileService->uploadFile($request->file('file'));
        } else {
            $uploadFile = null;
        }
        $createBlog = $this->blogService->create($request->only('user_id', 'category_id', 'title', 'content'), $uploadFile);
        if ($createBlog) {
            return back()->with('create-success', trans('message.create-success'));
        }
        return back()->with('create-failed', trans('message.create-failed'));
    }
}
