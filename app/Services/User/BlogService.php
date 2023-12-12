<?php
namespace App\Services\User;

use App\Models\Blog;
use App\Repositories\BlogRepository;
use App\Repositories\CategoryRepository;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class BlogService
{
    public function __construct(
        public BlogRepository $blogRepository,
        public CategoryRepository $categoryRepository,
    ) {
    }

    public function create(array $request, $file): Blog
    {
        try {
            $request = array_merge($request, array('image' =>$file ));
            return $this->blogRepository->create($request);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getBlog(int $id): Blog
    {
        try {
            return $this->blogRepository->getBlogById($id);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getRelatedBlog(int $id): Collection
    {
        try {
            return $this->blogRepository->getRelatedBlog($id);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function update(array $request): bool
    {
        try {
            return $this->blogRepository->update($request);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function deleteBlog(int $id): bool
    {
        try {
            return $this->blogRepository->deleteById($id);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
