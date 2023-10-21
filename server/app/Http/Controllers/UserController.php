<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserController extends Controller
{
    protected $maxAttempts = 5;
    use ThrottlesLogins;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $validatedRequest = $request->validated();
        $validatedRequest['password'] = bcrypt($validatedRequest['password']);
        $validatedRequest['email'] = strtolower($validatedRequest['email']);

        $user = $this->userRepository->createUser($validatedRequest);

        return response()->json([
            'message' => 'User registered successfully'],
            200);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        if (method_exists($this, 'hasTooManyLoginAttempts') && $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            $seconds = $this->limiter()->availableIn(
                $this->throttleKey($request)
            );
            return response()->json([
                'message' => 'Too many invalid attempts. Try after ' . ceil($seconds / 60) . ' minutes',
            ], 429);
        }

        $authStatus = Auth::attempt(['email' => $request['email'], 'password' => $request['password']]);

        if ($authStatus) {
            $authUser = Auth::user();
            $user = $this->userRepository->getUser($authUser->id);
            $this->clearLoginAttempts($request);
            $user['token'] = $this->userRepository->createToken($authUser);

            return response()->json([
                'success' => $user,
                'message' => 'Logged in successfully.',
            ], 200);

        } else {
            return response()->json([
                'error' => 'Unauthorised',
                'remaining_invalid_attempts' => $this->getAttempts($request),
            ], 401);
        }
    }

    protected function getAttempts(Request $request): int
    {
        return $this->maxAttempts - $this->limiter()->attempts($this->throttleKey($request));
    }

    protected function throttleKey(Request $request): string
    {
        return Str::lower(request('email')) . '|' . $request->ip();
    }

}
