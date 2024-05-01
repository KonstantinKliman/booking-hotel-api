<?php

namespace App\Http\Requests\Api\v1\Room;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateRoomRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'hotelId' => ['required', 'numeric', Rule::exists('hotels', 'id')],
            'typeId' => ['required', 'numeric', Rule::exists('room_types', 'id')],
            'description' => ['required', 'string'],
            'pricePerNight' => ['required', 'numeric'],
            'isAvailable' => ['required', 'boolean']
        ];
    }
}
