<?php

namespace App\Http\Controllers\Api\v1;

use App\DTO\ProfileDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Profile\CreateProfileRequest;
use App\Services\Interfaces\IProfileService;
use Illuminate\Support\Arr;

class ProfileController extends Controller
{
    private IProfileService $service;

    public function __construct(IProfileService $service)
    {
        $this->service = $service;
    }

    public function store(CreateProfileRequest $request)
    {
        $dto = new ProfileDTO(
            Arr::get($request->validated(), 'firstName'),
            Arr::get($request->validated(), 'lastName'),
            Arr::get($request->validated(), 'phone'),
            Arr::get($request->validated(), 'dob'),
            Arr::get($request->validated(), 'accountType'),
            Arr::get($request->validated(), 'country'),
            Arr::get($request->validated(), 'city'),
            Arr::get($request->validated(), 'fullAddress'),
        );
        $profile = $this->service->store($dto, $request->user()->id);
        return response()->json([
            'message' => $profile->wasRecentlyCreated ? 'Profile created successfully.' : 'Profile has already been created.',
            'profile' => [
                'id' => $profile->id,
                'firstName' => $profile->first_name,
                'lastName' => $profile->last_name,
                'phone' => $profile->phone,
                'dob' => $profile->dob,
                'accountType' => $profile->account_type,
                'country' => $profile->country,
                'city' => $profile->city,
                'fullAddress' => $profile->full_address
            ]
        ], 201);
    }

    public function show(int $id)
    {
        $profileDto = $this->service->show($id);
        return response()->json([
            'profile' => [
                'id' => $id,
                'data' => $profileDto
            ]
        ]);
    }

    public function update(int $id)
    {
        $this->service->update($id);
    }
}
