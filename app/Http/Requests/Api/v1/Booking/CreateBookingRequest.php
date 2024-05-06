<?php

namespace App\Http\Requests\Api\v1\Booking;

use App\Enums\BookingStatusType;
use App\Enums\PaymentStatusType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateBookingRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'roomId' => ['required', Rule::exists('rooms', 'id')],
            'guestsCount' => ['required', 'numeric', 'max:10', 'min:1'],
            'checkInDate' => ['required', 'date', 'before:checkOutDate'],
            'checkOutDate' => ['required', 'date', 'after:checkInDate'],
            'totalPrice' => ['required', 'numeric', 'min:1'],
            'additionalComments' => ['required', 'string', 'nullable']
        ];
    }
}
