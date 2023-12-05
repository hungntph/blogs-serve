<?php
namespace App\Services\User;

use App\Models\Blog;
use App\Repositories\BlogRepository;
use App\Repositories\CategoryRepository;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class BlogService
{

    public BlogRepository $blogRepository;
    public CategoryRepository $categoryRepository;

    public function __construct(
        BlogRepository $blogRepository,
        CategoryRepository $categoryRepository
    ) {
        $this->blogRepository = $blogRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function getCategory(): Collection
    {
        try {
            return $this->categoryRepository->getAll();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function create(array $request, string $image): Blog
    {
        try {
            return $this->blogRepository->create($request, $image);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
