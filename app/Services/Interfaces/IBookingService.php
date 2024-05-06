<?php

namespace App\Services\Interfaces;

use App\Http\Requests\Api\v1\Booking\CreateBookingRequest;
use App\Http\Requests\Api\v1\Booking\UpdateBookingRequest;
use Illuminate\Http\Request;

interface IBookingService
{
    public function create(CreateBookingRequest $request);

    public function getById(int $id);

    public function update(UpdateBookingRequest $request, int $id);

    public function delete(int $id);

    public function list(Request $request);
}
