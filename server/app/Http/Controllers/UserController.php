<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $maxAttempts = 5;

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

        $token = $user->userRepository->createToken($user);

        return response()->json([
            'success' => $success,
            'message' => 'user registered successfully'],
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
            $user = Auth::user();
            $this->clearLoginAttempts($request);
            $success['token'] = $user->createToken('MyApp')->accessToken;
            $success['id'] = $user->id;
            $success['first_name'] = $user->first_name;
            $success['last_name'] = $user->last_name;
            $success['email'] = $user->email;

        } else {
            return response()->json([
                'error' => 'Unauthorised',
                'remaining_invalid_attempts' => $this->getAttempts($request)],
                401);
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
