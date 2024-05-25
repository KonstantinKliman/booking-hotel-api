<?php

namespace App\Http\Resources\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'userId' => $this->user_id,
            'roomId' => $this->room_id,
            'guestsCount' => $this->guests_count,
            'checkInDate' => $this->check_in_date,
            'checkOutDate' => $this->check_out_date,
            'bookingStatus' => $this->bookingStatus->name,
            'paymentStatus' => $this->paymentStatus->name,
            'totalPrice' => $this->total_price,
            'additionalComments' => $this->additional_comments
        ];
    }
}
