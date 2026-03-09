<?php

namespace App\Services;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Traits\ApiResponseTrait;

class AuthService
{
    use ApiResponseTrait;
    protected $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function register($request)
    {
        $user = $this->userRepo->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        
        $token = $user->createToken('auth_token')->plainTextToken;

        return ['user' => $user, 'access_token' => $token, 'token_type' => 'Bearer'];
    }

    public function login($request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return $this->apiResponse(['message' => 'Invalid credentials'], 401);
        }

        $user = Auth::user();
        $token = $request->user()->createToken('auth_token')->plainTextToken;

        return ['user' => $user, 'access_token' => $token, 'token_type' => 'Bearer'];
    }
}
