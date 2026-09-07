<?php
namespace App\Services;

use App\Contracts\Users\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use InvalidArgumentException;

class UserService
{
    protected UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        $user = $this->userRepository->create($data);

        $token = $user->createToken('Personal Access Token')->accessToken;

        return [
            'user' => $user,
            'token' => $token
        ];
    }
    
    public function login(array $credentials)
    {
        if (!Auth::attempt($credentials)) {
            throw new InvalidArgumentException('Kredensial tidak valid');
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $token = $user->createToken('Personal Access Token')->accessToken;

        return [
            'user' => $user,
            'token' => $token
        ];
    }
}