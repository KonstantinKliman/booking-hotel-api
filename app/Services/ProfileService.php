<?php

namespace App\Services;

use App\Exceptions\Profile\ProfileAlreadyExistsException;
use App\Exceptions\Profile\ProfileNotFoundException;
use App\Http\Requests\Api\v1\Profile\CreateProfileRequest;
use App\Http\Requests\Api\v1\Profile\UpdateProfileRequest;
use App\Models\Profile;
use App\Repositories\Interfaces\IProfileRepository;
use App\Services\Interfaces\IProfileService;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class ProfileService implements IProfileService
{
    private IProfileRepository $repository;

    /**
     * @param IProfileRepository $repository
     */
    public function __construct(IProfileRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param CreateProfileRequest $request
     * @return array
     */
    public function create(CreateProfileRequest $request): array
    {
        $profile = Profile::query()->where('user_id', $request->user()->id)->first();
        if ($profile) {
            throw new ProfileAlreadyExistsException($profile);
        }
        $data = [
            'user_id' => $request->user()->id,
            'first_name' => Arr::get($request->validated(), 'firstName'),
            'last_name' => Arr::get($request->validated(), 'lastName'),
            'phone' => Arr::get($request->validated(), 'phone'),
            'dob' => Carbon::createFromFormat('d-m-Y', Arr::get($request->validated(), 'dob'))->format('Y-m-d'),
            'account_type' => Arr::get($request->validated(), 'accountType'),
            'company_name' => Arr::get($request->validated(), 'companyName'),
            'country' => Arr::get($request->validated(), 'country'),
            'city' => Arr::get($request->validated(), 'city'),
            'full_address' => Arr::get($request->validated(), 'fullAddress'),
        ];
        $profile = $this->repository->create($data);
        return [
            'message' => $profile->wasRecentlyCreated ? 'Profile created successfully.' : 'Profile has already been created.',
            'profile' => [
                'id' => $profile->id,
                'firstName' => $profile->first_name,
                'lastName' => $profile->last_name,
                'phone' => $profile->phone,
                'dob' => $profile->dob,
                'accountType' => $profile->account_type,
                'companyName' => $profile->company_name,
                'country' => $profile->country,
                'city' => $profile->city,
                'fullAddress' => $profile->full_address
            ]
        ];
    }

    /**
     * @param int $id
     * @return void
     * @throws ProfileNotFoundException
     */
    private function isExistsById(int $id): void
    {
        if (!$this->repository->isExistsById($id)) {
            throw new ProfileNotFoundException();
        }
    }

    /**
     * @param int $id
     * @return array
     * @throws ProfileNotFoundException
     */
    public function getById(int $id): array
    {
        $this->isExistsById($id);

        $profile = $this->repository->getById($id);

        return [
            'id' => $id,
            'firstName' => Arr::get($profile, 'first_name'),
            'lastName' => Arr::get($profile, 'last_name'),
            'dob' => Arr::get($profile, 'dob'),
            'phone' => Arr::get($profile, 'phone'),
            'accountType' => Arr::get($profile, 'account_type'),
            'companyName' => Arr::get($profile, 'company_name'),
            'country' => Arr::get($profile, 'country'),
            'city' => Arr::get($profile, 'city'),
            'fullAddress' => Arr::get($profile, 'full_address'),
        ];
    }

    public function update(UpdateProfileRequest $request, int $id)
    {
        $this->isExistsById($id);

        $data = array_filter([
            'first_name' => Arr::get($request->validated(), 'firstName'),
            'last_name' => Arr::get($request->validated(), 'lastName'),
            'dob' => Carbon::createFromFormat('d-m-Y', Arr::get($request->validated(), 'dob'))->format('Y-m-d'),
            'phone' => Arr::get($request->validated(), 'phone'),
            'account_type' => Arr::get($request->validated(), 'accountType'),
            'company_name' => Arr::get($request->validated(), 'companyName'),
            'country' => Arr::get($request->validated(), 'country'),
            'city' => Arr::get($request->validated(), 'city'),
            'full_address' => Arr::get($request->validated(), 'fullAddress'),
        ]);

        $this->repository->update($data, $id);

        $profile = $this->repository->getById($id);

        return [
            'message' => 'Profile successfully updated.',
            'profile' => [
                'id' => $id,
                'firstName' => Arr::get($profile, 'first_name'),
                'lastName' => Arr::get($profile, 'last_name'),
                'phone' => Arr::get($profile, 'phone'),
                'dob' => Arr::get($profile, 'dob'),
                'accountType' => Arr::get($profile, 'account_type'),
                'companyName' => Arr::get($profile, 'company_name'),
                'country' => Arr::get($profile, 'country'),
                'city' => Arr::get($profile, 'city'),
                'fullAddress' => Arr::get($profile, 'full_address'),
            ]
        ];
    }

    public function delete(int $id)
    {
        $this->isExistsById($id);
        $this->repository->delete($id);
        return [
            'message' => 'Profile successfully deleted'
        ];
    }
}
