<?php

namespace App\Repositories\Blog;

use App\Models\BlogPost;

class BlogRepository implements BlogRepositoryInterface
{
    public function create($blog)
    {
        return BlogPost::create($blog);
    }

    public function getBlogPost($postId)
    {
        return BlogPost::find($postId);
    }

    public function update($postId, $blog)
    {
        return BlogPost::where('id', $postId)->update($blog);
    }

    public function delete($postId)
    {
        return BlogPost::where('id', $postId)->delete();
    }

    public function getOwnerBlogs($userId)
    {
        return BlogPost::where('created_by',$userId)->get();
    }

    public function getPublicBlogs()
    {
        return BlogPost::all();
    }
}
