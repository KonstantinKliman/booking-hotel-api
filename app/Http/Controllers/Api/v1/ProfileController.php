<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Profile\CreateProfileRequest;
use App\Http\Requests\Api\v1\Profile\UpdateProfileRequest;
use App\Services\Interfaces\IProfileService;
use Illuminate\Http\JsonResponse;

class ProfileController extends Controller
{
    private IProfileService $service;

    public function __construct(IProfileService $service)
    {
        $this->service = $service;
    }

    public function create(CreateProfileRequest $request): JsonResponse
    {
        return response()->json($this->service->create($request), 201);
    }

    public function get(int $profileId)
    {
        return response()->json($this->service->getById($profileId));
    }

    public function update(UpdateProfileRequest $request, int $profileId)
    {
        return response()->json($this->service->update($request, $profileId));
    }

    public function delete(int $profileId)
    {
        return response()->json($this->service->delete($profileId));
    }
}
