<?php

namespace App\Services;

use App\Exceptions\Profile\ProfileNotFoundException;
use App\Http\Requests\Api\v1\Profile\CreateProfileRequest;
use App\Http\Requests\Api\v1\Profile\UpdateProfileRequest;
use App\Http\Resources\Api\v1\ProfileResource;
use App\Models\Profile;
use App\Repositories\Interfaces\IProfileRepository;
use App\Repositories\Interfaces\IUserRepository;
use App\Services\Interfaces\IProfileService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProfileService implements IProfileService
{
    private IProfileRepository $repository;

    private IUserRepository $userRepository;

    public function __construct(IProfileRepository $repository, IUserRepository $userRepository)
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
    }

    public function create(CreateProfileRequest $request)
    {
        $this->userRepository->updateUserRole($request->user()->id, (int)$request->validated('roleType'));

        $data = array_filter([
            'user_id' => $request->user()->id,
            'first_name' => $request->validated('firstName'),
            'last_name' => $request->validated('lastName'),
            'phone' => $request->validated('phone'),
            'dob' => $request->validated('dob'),
            'company_name' => $request->validated('companyName'),
            'country' => $request->validated('country'),
            'city' => $request->validated('city'),
        ]);

        $profile = $this->repository->create($data);

        return new ProfileResource($profile);
    }

    public function getById(int $id)
    {
        try {
            $profile = $this->repository->findOrFail($id);
            return new ProfileResource($profile);
        } catch (ModelNotFoundException $e) {
            throw new ProfileNotFoundException();
        }
    }

    public function update(UpdateProfileRequest $request, int $id)
    {
        $data = array_filter([
            'user_id' => $request->user()->id,
            'first_name' => $request->validated('firstName'),
            'last_name' => $request->validated('lastName'),
            'phone' => $request->validated('phone'),
            'dob' => $request->validated('dob'),
            'company_name' => $request->validated('companyName'),
            'country' => $request->validated('country'),
            'city' => $request->validated('city'),
        ]);

        $this->repository->update($data, $id);

        $profile = $this->repository->getById($id);

        return new ProfileResource($profile);
    }

    public function delete(int $id)
    {
        $this->repository->delete($id);
    }
}
