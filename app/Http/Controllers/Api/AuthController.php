<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Http\Traits\ApiResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use ApiResponse;

    public function register(RegisterRequest $request)
    {
        $user = User::create($request->validated());

        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->success(
            'Registration successful.',
            [
                'user' => new UserResource($user),
                'token' => $token,
            ],
            201
        );
    }

    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return $this->error('Invalid credentials.', null, 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->success(
            'Login successful.',
            [
                'user' => new UserResource($user),
                'token' => $token,
            ]
        );
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->success('Logged out successfully.');
    }
}