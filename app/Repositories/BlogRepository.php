<?php

namespace App\Repositories;

use App\Models\Blog;
use App\Models\User;
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
        return Blog::with('category', 'user', 'likes')->findOrFail($id);
    }

    public function update(int $id, array $request): bool
    {
        return Blog::where('id', $id)->update($request);
    }

    public function deleteById(int $id): bool
    {
        return Blog::where('id', $id)->delete();
    }

    public function getRelatedBlog(int $id): Collection
    {
        return Blog::with('user')
            ->whereRelation('user', 'status', User::STATUS_VERIFIED)
            ->inRandomOrder()->approved()
            ->where('id', '!=', $id)
            ->limit(config('constant.limit'))->get();
    }

    public function getBlogsList(array $request): LengthAwarePaginator
    {
        $builder = Blog::approved()
            ->with('user')
            ->whereRelation('user', 'status', User::STATUS_VERIFIED);
        if (data_get($request, 'query')) {
            $builder->where('title', 'like', '%' . $request['query'] . '%');
        }
        if (data_get($request, 'category_id')) {
            $builder->where('category_id', $request['category_id']);
        }
        return $builder->paginate(config('constant.paginate'));
    }

    public function getList(array $request): LengthAwarePaginator
    {
        $builder = Blog::with('user', 'category', 'likes');
        if (data_get($request, 'query')) {
            $builder->where('title', 'like', '%' . $request['query'] . '%');
        }
        if (data_get($request, 'category_id')) {
            $builder->where('category_id', $request['category_id']);
        }
        if (data_get($request, 'status') || isset($request['status'])) {
            $builder->where('status', $request['status']);
        }
        if (data_get($request, 'order_by')) {
            switch ($request['order_by']) {
                case 'like':
                    $builder->withCount('likes')->orderBy("likes_count", 'desc');
                    break;
                case 'newest':
                    $builder->orderBy('created_at', 'desc');
                    break;
            }
        }
        return $builder->paginate(config('constant.paginate'));
    }

    public function getBlogsByUser(int $id): LengthAwarePaginator
    {
        return Blog::where('user_id', $id)->paginate(config('constant.paginate'));
    }

    public function getBlogsByCategory(int $id): Collection
    {
        return Blog::where('category_id', $id)->get();
    }

    public function deleteBlogsByCategory(int $id): bool
    {
        return Blog::where('category_id', $id)->delete();
    }

    public function getBlogByMonth($request): array
    {
        $fields = [
            "count(id) as total",
            "DATE_FORMAT(created_at, '%m-%Y') as dates"
        ];
        $year = data_get($request, 'year') ?? now()->year;
        $blogsByMonth = Blog::popular($year)
            ->selectRaw(implode(', ', $fields))
            ->groupBy('dates')
            ->orderBy('dates', 'asc')
            ->get();
        $counts = collect($blogsByMonth)->sum('total');
        $data = $blogsByMonth->mapWithKeys(function ($item) {
            return [$item->dates => $item->total];
        });
        return ['data' => $data, 'total' => $counts];
    }
}
