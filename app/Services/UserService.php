<?php

namespace App\Services;

use App\DTO\UserDTO;
use App\Exceptions\User\InvalidUserCredentialsException;
use App\Models\User;
use App\Repositories\Interfaces\IUserRepository;
use App\Services\Interfaces\IUserService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService implements IUserService
{
    private IUserRepository $repository;

    public function __construct(IUserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param UserDTO $dto
     * @return User
     */
    public function register(UserDTO $dto): User
    {
        $data = [
            'email' => $dto->email,
            'password' => Hash::make($dto->password)
        ];
        $user = $this->repository->create($data);
        event(new Registered($user));
        return $user;
    }


    /**
     * @param UserDTO $dto
     * @return string
     * @throws InvalidUserCredentialsException
     */
    public function login(UserDTO $dto): string
    {
        $data = [
            'email' => $dto->email,
            'password' => $dto->password
        ];

        $user = $this->repository->get($dto->email);

        if (!empty($user)){
            if (Auth::attempt($data)) {
                return $user->createToken('api-token')->plainTextToken;
            }
        }

        throw new InvalidUserCredentialsException();
    }
}
