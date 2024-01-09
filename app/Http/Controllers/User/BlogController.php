<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBlogRequest;
use App\Http\Requests\DeleteBlogRequest;
use App\Http\Requests\GetListBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Blog;
use App\Services\User\BlogService;
use App\Services\User\CategoryService;
use App\Services\User\CommentService;
use App\Services\User\UploadFileService;
use Illuminate\Support\Facades\Gate;

class BlogController extends Controller
{
    public function __construct(
        public BlogService $blogService,
        public CategoryService $categoryService,
        public UploadFileService $uploadFileService,
        public CommentService $commentService,
    ) {
    }

    public function index()
    {
        $auth = auth()->user();
        $categories = $this->categoryService->getCategories();
        return view("blogs.create_blog", compact('categories', 'auth'));
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
        $auth = auth()->user();
        $blog = $this->blogService->getBlog($id);
        $categories = $this->categoryService->getCategories();
        if (Gate::allows('edit', $blog)) {
            return view("blogs.edit_blog", compact('categories', 'blog', 'auth'));
        }
        abort(403);
    }

    public function update($id, UpdateBlogRequest $request)
    {
        if (Gate::allows('update', $request)) {
            if ($request->file('file')) {
                $uploadFile = $this->uploadFileService->uploadFile($request->file('file'));
                $request = array_merge($request->only('id', 'user_id', 'category_id', 'title', 'content'), ['image' => $uploadFile]);
            } else {
                $request = array_merge($request->only('id', 'user_id', 'category_id', 'title', 'content'));
            }
            $updateBlog = $this->blogService->update($id, $request);
            if ($updateBlog) {
                return back()->with('blog-update-success', trans('message.update-success'));
            }
            return back()->with('blog-update-failed', trans('message.update-failed'));
        }
        abort(403);
    }

    public function show(int $id)
    {
        $auth = auth()->user();
        $blog = $this->blogService->getBlog($id);
        $checkLike = $this->blogService->checklike($blog);
        $relatedBlogs = $this->blogService->getRelatedBlog($id);
        if ($blog->status == Blog::STATUS_NOT_APPROVED) {
            if (Gate::allows('show', $blog)) {
                return view("blogs.detail_blog", compact('blog', 'relatedBlogs', 'auth', 'checkLike'));
            }
            abort(403);
        }
        return view("blogs.detail_blog", compact('blog', 'relatedBlogs', 'auth', 'checkLike'));
    }

    public function destroy(DeleteBlogRequest $request, int $id)
    {
        if (Gate::allows('delete', $request)) {
            $deleted = $this->blogService->deleteBlog($id);
            if ($deleted) {
                if ($request['image']) {
                    $this->uploadFileService->deleteFile($request['image']);
                }
                $this->commentService->deleteComment($id);
                return redirect()->route('home')->with('delete-blog-success', trans('message.delete-blog-success'));
            }
            return back()->with('delete-blog-failed', trans('message.delete-blog-failed'));
        }
        abort(403);
    }

    public function getListBlog(GetListBlogRequest $request)
    {
        $auth = auth()->user();
        $blogs = $this->blogService->getBlogList($request->only('query', 'category_id'));
        $categories = $this->categoryService->getCategories();
        return view("user.home", compact('auth', 'blogs', 'categories'));
    }

    public function blogs()
    {
        $auth = auth()->user();
        $blogs = $this->blogService->getBlogsByUser($auth->id);
        return view("user.my_blogs", compact('auth', 'blogs'));
    }
}
