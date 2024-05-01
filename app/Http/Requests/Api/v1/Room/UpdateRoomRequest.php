<?php

namespace App\Http\Requests\Api\v1\Room;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRoomRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'typeId' => ['numeric', Rule::exists('room_types', 'id')],
            'description' => ['string'],
            'count' => ['numeric'],
            'pricePerNight' => ['numeric'],
            'isAvailable' => ['boolean']
        ];
    }
}
