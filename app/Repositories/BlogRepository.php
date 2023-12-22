<?php

namespace App\Repositories;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class BlogRepository
{
    public function create(array $request): Blog
    {
        return Blog::create($request);
    }

    public function getBlogById(int $id): Blog
    {
        return Blog::with('category', 'comments.user', 'user', 'likes')->findOrFail($id);
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
        return Blog::inRandomOrder()->approved()->where('id', '!=', $id)->limit(config('constant.limit'))->get();
    }

    public function getBlogsList(array $request): LengthAwarePaginator
    {
        $builder = Blog::approved()->with('user');
        if (isset($request['query'])) {
            $builder->where('title', 'like', '%'. $request['query'] .'%');
        }
        if (isset($request['category_id'])) {
            $builder->where('category_id', $request['category_id']);
        }
        return $builder->paginate(config('constant.paginate'));
    }
}
