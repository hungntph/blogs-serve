<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function createBlog()
    {
        return view("blogs.create_blog");
    }
}
