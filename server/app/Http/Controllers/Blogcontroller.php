<?php

namespace App\Http\Controllers;

use App\Repositories\Blog\BlogRepositoryInterface;

use Illuminate\Http\Request;

class Blogcontroller extends Controller
{
    public function __construct(BlogRepositoryInterface $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    // public function createBlog(): JsonResponse
    // {
    
    // }

}
