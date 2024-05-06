<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Booking\CreateBookingRequest;
use App\Http\Requests\Api\v1\Booking\UpdateBookingRequest;
use App\Services\Interfaces\IBookingService;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    private IBookingService $service;

    public function __construct(IBookingService $service)
    {
        $this->service = $service;
    }

    public function create(CreateBookingRequest $request)
    {
        return response()->json($this->service->create($request), 201);
    }

    public function getById(int $bookingId)
    {
        return response()->json($this->service->getById($bookingId));
    }

    public function update(UpdateBookingRequest $request, int $bookingId)
    {
        return response()->json($this->service->update($request, $bookingId));
    }

    public function delete(int $bookingId)
    {
        return response()->json($this->service->delete($bookingId));
    }

    public function list(Request $request)
    {
        return response()->json($this->service->list($request));
    }
}
