<?php
namespace App\Services\User;

use App\Models\Category;
use App\Repositories\BlogRepository;
use App\Repositories\CategoryRepository;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoryService
{
    public function __construct(
        public CategoryRepository $categoryRepository,
        public BlogRepository $blogRepository,
        public UploadFileService $uploadFileService,
    ) {
    }

    public function getCategories(): Collection
    {
        try {
            return $this->categoryRepository->getAll();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function adminGetCategories(array $request): LengthAwarePaginator
    {
        try {
            return $this->categoryRepository->adminGetCategories($request);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function create(array $request): Category
    {
        try {
            return $this->categoryRepository->create($request);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getCategoryById(int $id): Category
    {
        try {
            return $this->categoryRepository->getCategoryById($id);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function update(int $id, array $request): bool
    {
        try {
            return $this->categoryRepository->update($id, $request);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function delete(int $id): bool
    {
        try {
            $blogs = $this->blogRepository->getBlogsByCategory($id);
            $deleteCategory = $this->categoryRepository->delete($id);
            if ($deleteCategory) {
                $deleteBlogs = $this->blogRepository->deleteBlogsByCategory($id);
                if ($deleteBlogs) {
                    foreach ($blogs as $blog) {
                        if ($blog->image) {
                            $this->uploadFileService->deleteFile($blog->image);
                        }
                    }
                }
                return true;
            }
            return false;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
