<?php

namespace App\Services;

use App\Exceptions\User\EmailIsNotVerifiedException;
use App\Exceptions\User\InvalidUserCredentialsException;
use App\Http\Requests\Api\v1\User\LoginRequest;
use App\Http\Requests\Api\v1\User\RegisterRequest;
use App\Repositories\Interfaces\IUserRepository;
use App\Services\Interfaces\IUserService;
use App\Services\Interfaces\IVerificationEmailService;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService implements IUserService
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
            'email' => Arr::get($request->validated(), 'email'),
            'password' => Hash::make(Arr::get($request->validated(), 'password'))
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
            'email' => Arr::get($request->validated(), 'email'),
            'password' => Arr::get($request->validated(), 'password')
        ];

        $user = $this->repository->get(Arr::get($data, 'email'));

        if (!$user->hasVerifiedEmail()) {
            throw new EmailIsNotVerifiedException();
        }

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

    public function setUserRole(int $userId, int $roleId): void
    {
        $user = $this->repository->getById($userId);
        $user->role_id = $roleId;
        $this->repository->save($user);
    }
}
