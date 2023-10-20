<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class EnsureIsBlogOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        $blogPostId = $request->route('post_id');
        $blogPost = BlogPost::where('id', $blogPostId)->first();

        if(!$blogPost) {
            return response()->json([
                'message' => 'Blog post not found'
            ], 404);
        }

        if($blogPost->created_by == $user->id) {
            return $next($request);
        } else {
            return response()->json([
                'message' => 'You are not authorized to perform this action'
            ], 401);
        }
    }
}
