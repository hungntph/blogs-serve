<?php
namespace App\Services\User;

use App\Repositories\CategoryRepository;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class CategoryService
{
    public function __construct(
        public CategoryRepository $categoryRepository
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
}
