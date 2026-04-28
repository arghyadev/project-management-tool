<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Support\ApiResponse;

class AuthController extends Controller
{
    use ApiResponse;
    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->validated();

        if (! Auth::attempt($credentials)) {
            return $this->error('Invalid credentials.', 422);
        }

        /** @var \App\Models\User $user */
        $user = $request->user();
        $token = $user->createToken('pmo-spa')->plainTextToken;

        return $this->success([
            'user' => $user,
            'roles' => $user->roles?->pluck('code') ?? [],
            'token' => $token,
        ], 'Authenticated successfully.');
    }

    public function me(Request $request): JsonResponse
    {
        return $this->success(['user' => $request->user()]);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()?->currentAccessToken()?->delete();

        return $this->success([], 'Logged out successfully.');
    }
}
