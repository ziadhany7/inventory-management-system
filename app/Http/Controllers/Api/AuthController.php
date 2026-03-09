<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Traits\ApiResponseTrait;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;

class AuthController extends Controller
{
    use ApiResponseTrait;
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    public function register(RegisterRequest $request)
    {
        $register = $this->authService->register($request);

        return $this->apiResponse(['user' => $register['user'], 'access_token' => $register['access_token'], 'token_type' => 'Bearer'], 201, 'User registered successfully');
    }

    public function login(LoginRequest $request)
    {
        $login = $this->authService->login($request);

        return $this->apiResponse(['user' => $login['user'], 'access_token' => $login['access_token'], 'token_type' => 'Bearer'], 200, 'User logged in successfully');
    }
}
