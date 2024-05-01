<?php

namespace App\Http\Requests\Api\v1\Hotel;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHotelRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['string'],
            'address' => ['string'],
            'starRating' => ['numeric'],
            'description' => ['string'],
        ];
    }
}
