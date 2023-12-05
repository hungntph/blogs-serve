<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository
{
    const MODEL = Category::class;

    public function getAll(): Collection
    {
        return Category::select('id', 'name')->get();
    }
}
