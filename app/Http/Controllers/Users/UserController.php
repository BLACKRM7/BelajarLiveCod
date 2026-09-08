<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\LoginRequest;
use App\Http\Requests\Users\RegisterRequest;
use App\Http\Resources\Users\UserResource;
use App\Services\Users\UserService;
use App\Traits\ApiResponseTrait;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ApiResponseTrait;

    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(RegisterRequest $request)
    {
        try {
            $result = $this->userService->register($request->validated());
            return $this->successResponse([
                'user' => new UserResource($result['user']),
                'token' => $result['token'],
            ], 'Registrasi berhasil', 201);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function login(LoginRequest $request)
    {
        try {
            $result = $this->userService->login($request->validated());
            return $this->successResponse([
                'user' => new UserResource($result['user']),
                'token' => $result['token'],
            ], 'Login berhasil');
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 401);
        }
    }

    public function profile(Request $request)
    {
        return $this->successResponse(new UserResource($request->user()), 'Data profil didapatkan');
    }
}