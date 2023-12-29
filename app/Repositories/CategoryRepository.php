<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoryRepository
{
    public function getAll(): Collection
    {
        return Category::select('id', 'name')->get();
    }

    public function adminGetCategories(array $request): LengthAwarePaginator
    {
        $builder = Category::with('blogs');
        if (data_get($request, 'query')) {
            $builder->where('name', 'like', '%'. $request['query'] .'%');
        }
        return $builder->paginate(config('constant.paginate'));
    }

    public function create(array $request): Category
    {
        return Category::create($request);
    }

    public function getCategoryById(int $id): Category
    {
        return Category::findOrFail($id);
    }

    public function update(int $id, array $request): bool
    {
        return Category::findOrFail($id)->update($request);
    }

    public function delete(int $id): bool
    {
        return Category::findOrFail($id)->delete();
    }
}
