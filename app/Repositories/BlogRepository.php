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

    public function getBlogById(int $id): Blog
    {
        return Blog::with('category', 'comments.user', 'user')->findOrFail($id);
    }

    public function update($request): bool
    {
        return Blog::where('id', $request['id'])->update($request);
    }
}
