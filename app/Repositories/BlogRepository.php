<?php

namespace App\Repositories;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Collection;

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

    public function update(array $request): bool
    {
        return Blog::where('id', $request['id'])->update($request);
    }

    public function deleteById(int $id): bool
    {
        return Blog::where('id', $id)->delete();
    }

    public function getRelatedBlog(int $id): Collection
    {
        return Blog::inRandomOrder()
            ->where([
                ['status', Blog::STATUS_APPROVED],
                ['id', '!=', $id],
            ])->limit(4)->get();
    }
}
