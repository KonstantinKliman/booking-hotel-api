<?php

namespace App\Services;

use App\DTO\ProfileDTO;
use App\Exceptions\Profile\ProfileNotFoundException;
use App\Repositories\Interfaces\IProfileRepository;
use App\Services\Interfaces\IProfileService;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class ProfileService implements IProfileService
{
    private IProfileRepository $repository;

    public function __construct(IProfileRepository $repository)
    {
        $this->repository = $repository;
    }

    public function store(ProfileDTO $dto, int $userId)
    {
        $data = array(
            'user_id' => $userId,
            'first_name' => $dto->firstName,
            'last_name' => $dto->lastName,
            'phone' => $dto->phone,
            'dob' => Carbon::createFromFormat('d-m-Y', $dto->dob)->format('Y-m-d'),
            'account_type' => $dto->accountType,
            'country' => $dto->country,
            'city' => $dto->city,
            'full_address' => $dto->fullAddress
        );
        $profile = $this->repository->create($data);
        return $profile;
    }

    /**
     * @throws ProfileNotFoundException
     */
    public function show(int $id)
    {
        if (!$this->repository->exists($id)) {
            throw new ProfileNotFoundException();
        }
        $profile = $this->repository->show($id);

        $profileDto = new ProfileDTO(
            Arr::get($profile, 'first_name'),
            Arr::get($profile, 'last_name'),
            Arr::get($profile, 'phone'),
            Arr::get($profile, 'dob'),
            Arr::get($profile, 'account_type'),
            Arr::get($profile, 'country'),
            Arr::get($profile, 'city'),
            Arr::get($profile, 'full_address'),
        );

        return $profileDto;
    }

    public function update(int $id)
    {

    }
}
