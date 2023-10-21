<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class EnsureIsUser
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
        $userId = $request->route('user_id');
        if ($userId) {
            $isExist = User::find($userId);
            if ($isExist) {
                return $next($request);
            }
        } else {
            $email = $request->email;
            $isExist = User::where('email', $email)->first();
            if ($isExist) {
                return $next($request);
            }
        }

        return response()->json([
            'message' => 'User not found',
        ], 404);
    }
}
