<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
    public function register(RegisterRequest $request): JsonResponse
    {
        $validatedRequest = $request->validated();
        $validatedRequest['password'] = bcrypt($validatedRequest['password']);
        $validatedRequest['email'] = strtolower($validatedRequest['email']);

        $user = $this->userRepository->createUser($validatedRequest);

        return response()->json([
            'success' => $success,
            'message' => 'user is registered'],
        200);
    }

    public function login(LoginRequest $request): JsonResponse
    {

    }
}
