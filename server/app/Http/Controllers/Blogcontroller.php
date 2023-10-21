<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogRequest;
use App\Repositories\Blog\BlogRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class BlogController extends Controller
{
    public function __construct(BlogRepositoryInterface $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    public function create(BlogRequest $request): JsonResponse
    {
        $user = Auth::user();
        $validatedRequest = $request->validated();
        $validatedRequest['created_by'] = $user->id;
        $blog = $this->blogRepository->create($validatedRequest);

        if ($blog) {
            return response()->json([
                'message' => 'Blog created successfully',
                'blog' => $blog,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Blog creation failed',
            ], 400);
        }
    }

    public function update(BlogRequest $request): JsonResponse
    {
        $validatedRequest = $request->validated();
        $postId = $request->route('post_id');
        $blog = $this->blogRepository->getBlogPost($postId);

        if (!$blog) {
            return response()->json([
                'message' => 'Blog not found',
            ], 404);
        }

        $blogUpdated = $this->blogRepository->update($postId, $validatedRequest);

        if ($blogUpdated) {
            return response()->json([
                'message' => 'Blog updated successfully',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Blog updation failed',
            ], 400);
        }
    }

    public function delete(Request $request): JsonResponse
    {
        $postId = $request->route('post_id');
        $blog = $this->blogRepository->getBlogPost($postId);

        if (!$blog) {
            return response()->json([
                'message' => 'Blog not found',
            ], 404);
        }

        $blogDeleted = $this->blogRepository->delete($postId);

        if ($blogDeleted) {
            return response()->json([
                'message' => 'Blog deleted successfully',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Blog deletion failed',
            ], 400);
        }
    }

    public function getOwnerBlogs(Request $request): JsonResponse
    {
        $userId = $request->route('user_id');
        $blogs = $this->blogRepository->getOwnerBlogs($userId);

        return response()->json([
            'blogs' => $blogs,
        ]);

    }

    public function getPublicBlogs(Request $request): JsonResponse
    {
        $blogs = $this->blogRepository->getPublicBlogs();

        return response()->json([
            'blogs' => $blogs,
        ]);

    }

}
