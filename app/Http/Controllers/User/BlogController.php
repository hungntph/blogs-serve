<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBlogRequest;
use App\Services\User\BlogService;

class BlogController extends Controller
{
    public BlogService $blogService;

    public function __construct(
        BlogService $blogService
    ) {
        $this->blogService = $blogService;
    }

    public function formCreateBlog()
    {
        $getCategory = $this->blogService->getCategory();
        return view("blogs.create_blog", compact('getCategory'));
    }

    public function createBlog(CreateBlogRequest $request)
    {
        $file = $request->file('file');
        $path = "image";
        $image = $file->getClientOriginalName();
        $file->move($path, $image);
        $createBlog = $this->blogService->create($request->only('categories', 'title', 'content'), $image);
        if ($createBlog) {
            return back()->with('create-success', trans('message.create-success'));
        }
        return back()->with('create-failed', trans('message.create-failed'));
    }
}
