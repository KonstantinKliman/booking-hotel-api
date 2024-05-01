<?php

namespace App\Http\Controllers\Api\v1;

use App\Enums\RoleType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Profile\CreateProfileRequest;
use App\Http\Requests\Api\v1\Profile\UpdateProfileRequest;
use App\Services\Interfaces\IProfileService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

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

    public function get(int $id): JsonResponse
    {
        return response()->json($this->service->getById($id));
    }

    public function update(UpdateProfileRequest $request,int $id)
    {
        return response()->json($this->service->update($request, $id));
    }

    public function delete(int $id)
    {
        return response()->json($this->service->delete($id));
    }
}
