<?php

namespace App\Repositories;

use App\Models\Blog;

class BlogRepository
{
    const MODEL = Blog::class;

    public function create(array $request, string $image): Blog
    {
        $userId = auth()->user()->id;
        $blogInfo = [
            'user_id' => $userId,
            'category_id' => $request['categories'],
            'title' => $request['title'],
            'content' => $request['content'],
            'image' => $image,
        ];
        return Blog::create($blogInfo);
    }
}
