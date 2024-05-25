<?php

namespace App\Services;

use App\Exceptions\User\InvalidUserCredentialsException;
use App\Http\Requests\Api\v1\Auth\LoginRequest;
use App\Http\Requests\Api\v1\Auth\RegisterRequest;
use App\Repositories\Interfaces\IUserRepository;
use App\Services\Interfaces\IAuthService;
use App\Services\Interfaces\IVerificationEmailService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService implements IAuthService
{
    private IUserRepository $repository;
    private IVerificationEmailService $service;

    public function __construct(IUserRepository $repository, IVerificationEmailService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * @param RegisterRequest $request
     * @return array
     */
    public function register(RegisterRequest $request): array
    {
        $data = [
            'email' => $request->validated('email'),
            'password' => Hash::make($request->validated('password'))
        ];
        $user = $this->repository->create($data);
        $this->service->sendVerificationLink($user);
        return [
            'message' => 'User successfully registered. To continue registration, check your email.',
            'user' => [
                'id' => $user->id,
                'email' => $user->email,
            ]
        ];
    }


    /**
     * @param LoginRequest $request
     * @return array
     * @throws InvalidUserCredentialsException
     */
    public function login(LoginRequest $request): array
    {
        $data = [
            'email' => $request->validated('email'),
            'password' => $request->validated('password')
        ];

        $user = $this->repository->get($data['email']);

        if (!empty($user)) {
            if (Auth::attempt($data)) {
                return [
                    'message' => 'User successfully logged in.',
                    'token' => $user->createToken('api-token')->plainTextToken
                ];
            }
        }

        throw new InvalidUserCredentialsException();
    }
}
