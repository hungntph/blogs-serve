<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Services\User\BlogService;
use App\Services\User\CategoryService;
use App\Services\User\UploadFileService;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    public function __construct(
        public CategoryService $categoryService,
        public BlogService $blogService,
        public UploadFileService $uploadFileService,
    ) {
    }

    public function categories(Request $request)
    {
        $auth = auth()->user();
        $categories = $this->categoryService->adminGetCategories($request->only('query'));
        return view('admin.category_list', compact('auth', 'categories'));
    }

    public function index()
    {
        $auth = auth()->user();
        return view('admin.category_create', compact('auth'));
    }

    public function create(CreateCategoryRequest $request)
    {
        $create = $this->categoryService->create($request->only('name'));
        if ($create) {
            return back()->with('create-category-success', trans('message.create-category-success'));
        }
        return back()->with('create-category-failed', trans('message.create-category-failed'));
    }

    public function edit(int $id)
    {
        $auth = auth()->user();
        $category = $this->categoryService->getCategoryById($id);
        return view('admin.category_edit', compact('auth', 'category'));
    }

    public function update(int $id, UpdateCategoryRequest $request)
    {
        $update = $this->categoryService->update($id, $request->only('name'));
        if ($update) {
            return back()->with('update-category-success', trans('message.update-category-success'));
        }
        return back()->with('update-category-failed', trans('message.update-category-failed'));
    }

    public function destroy(Request $request)
    {
        $delete = $this->categoryService->delete($request['id']);
        if ($delete) {
            return back()->with('delete-category-success', trans('message.delete-category-success'));
        }
        return back()->with('delete-category-failed', trans('message.delete-category-failed'));
    }
}
