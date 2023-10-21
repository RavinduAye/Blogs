<?php

namespace App\Repositories\Blog;

interface BlogRepositoryInterface
{
    public function create($blog);

    public function getBlogPost($postId);

    public function update($postId, $blog);

    public function delete($postId);

    public function getOwnerBlogs($createdBy);

    public function getPublicBlogs();
}
