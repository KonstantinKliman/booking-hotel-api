<?php

namespace App\Services;

use App\Enums\BookingStatusType;
use App\Enums\RoleType;
use App\Http\Requests\Api\v1\Booking\CreateBookingRequest;
use App\Http\Requests\Api\v1\Booking\UpdateBookingRequest;
use App\Models\Booking;
use App\Repositories\Interfaces\IBookingRepository;
use App\Services\Interfaces\IBookingService;
use Illuminate\Http\Request;

class BookingService implements IBookingService
{
    private IBookingRepository $repository;

    public function __construct(IBookingRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(CreateBookingRequest $request)
    {

        $data = [
            'user_id' => $request->user()->id,
            'room_id' => $request->validated('roomId'),
            'guests_count' => $request->validated('guestsCount'),
            'check_in_date' => $request->validated('checkInDate'),
            'check_out_date' => $request->validated('checkOutDate'),
            'total_price' => $request->validated('totalPrice'),
            'additional_comments' => $request->validated('additionalComments')
        ];

        $booking = $this->repository->create($data);

        return $this->getById($booking->id);
    }

    public function getById(int $id)
    {
        $booking = $this->repository->getById($id);
        return [
            'id' => $booking->id,
            'userId' => $booking->user_id,
            'roomId' => $booking->room_id,
            'guestsCount' => $booking->guests_count,
            'checkInDate' => $booking->check_in_date,
            'checkOutDate' => $booking->check_out_date,
            'bookingStatus' => $booking->bookingStatus->name,
            'paymentStatus' => $booking->paymentStatus->name,
            'totalPrice' => $booking->total_price,
            'additionalComments' => $booking->additional_comments
        ];
    }

    public function update(UpdateBookingRequest $request, int $id)
    {
        $data = array_filter([
            'guests_count' => $request->validated('guestsCount'),
            'check_in_date' => $request->validated('checkInDate'),
            'check_out_date' => $request->validated('checkOutDate'),
            'total_price' => $request->validated('totalPrice'),
            'additional_comments' => $request->validated('additionalComments')
        ]);

        $this->repository->update($data, $id);

        return $this->getById($id);
    }

    public function delete(int $id)
    {
        $this->repository->delete($id);
        return [
            'status' => 'success'
        ];
    }

    public function list(Request $request)
    {
        $bookings = $this->repository->all();

        $result = [];

        if ($request->user()->role->id == RoleType::Customer->value) {
            foreach ($this->repository->getForCustomer($request->user()->id) as $booking) {
                $result[] = [
                    'id' => $booking->id,
                    'userId' => $booking->user_id,
                    'roomId' => $booking->room_id,
                    'guestsCount' => $booking->guests_count,
                    'checkInDate' => $booking->check_in_date,
                    'checkOutDate' => $booking->check_out_date,
                    'bookingStatus' => $booking->bookingStatus->name,
                    'paymentStatus' => $booking->paymentStatus->name,
                    'totalPrice' => $booking->total_price,
                    'additionalComments' => $booking->additional_comments
                ];
            }
        }

        if ($request->user()->role->id == RoleType::Owner->value) {
            foreach ($this->repository->getForOwner($request->user()->id) as $booking) {
                $result[] = [
                    'id' => $booking->id,
                    'userId' => $booking->user_id,
                    'roomId' => $booking->room_id,
                    'guestsCount' => $booking->guests_count,
                    'checkInDate' => $booking->check_in_date,
                    'checkOutDate' => $booking->check_out_date,
                    'bookingStatus' => $booking->bookingStatus->name,
                    'paymentStatus' => $booking->paymentStatus->name,
                    'totalPrice' => $booking->total_price,
                    'additionalComments' => $booking->additional_comments
                ];
            }
        }

        return $result;
    }
}
