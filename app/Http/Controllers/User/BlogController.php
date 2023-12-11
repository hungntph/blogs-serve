<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Services\User\BlogService;
use App\Services\User\CategoryService;
use App\Services\User\UploadFileService;
use Illuminate\Support\Facades\Gate;

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

    public function edit(int $id)
    {
        $blog = $this->blogService->getBlog($id);
        $categories = $this->categoryService->getCategories();
        if (Gate::allows('edit', $blog)) {
            return view("blogs.edit_blog", compact('categories', 'blog'));
        }
        abort(403);
    }

    public function update(UpdateBlogRequest $request)
    {
        if (Gate::allows('update', $request)) {
            if ($request->file('file')) {
                $uploadFile = $this->uploadFileService->uploadFile($request->file('file'));
                $request = array_merge($request->only('id', 'user_id', 'category_id', 'title', 'content'), ['image' => $uploadFile]);
            } else {
                $request = array_merge($request->only('id', 'user_id', 'category_id', 'title', 'content'));
            }
            $updateBlog = $this->blogService->update($request);
            if ($updateBlog) {
                return back()->with('blog-update-success', trans('message.update-success'));
            }
            return back()->with('blog-update-failed', trans('message.update-failed'));
        }
        abort(403);
    }

    public function show(int $id)
    {
        $blog = $this->blogService->getBlog($id);
        if (!$blog) {
            return abort(403);
        }
        if (Gate::allows('show', $blog)) {
            return view("blogs.detail_blog", compact('blog'));
        }
        abort(403);
    }
}
