<?php

namespace App\Repositories;

use App\Models\Blog;

class BlogRepository
{
    const MODEL = Blog::class;

    public function create(array $request): Blog
    {
        return Blog::create($request);
    }
}
