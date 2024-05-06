<?php

namespace App\Http\Requests\Api\v1\Booking;

use App\Enums\BookingStatusType;
use App\Enums\PaymentStatusType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBookingRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'guestsCount' => ['numeric', 'max:10', 'min:1'],
            'checkInDate' => ['date', 'before:checkOutDate'],
            'checkOutDate' => ['date', 'after:checkInDate'],
            'bookingStatusId' => ['numeric', Rule::enum(BookingStatusType::class)],
            'paymentStatusId' => ['numeric', Rule::enum(PaymentStatusType::class)],
            'totalPrice' => ['numeric', 'min:1'],
            'additionalComments' => ['string', 'nullable']
        ];
    }
}
