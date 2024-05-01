<?php

namespace App\Http\Requests\Api\v1\Hotel;

use Illuminate\Foundation\Http\FormRequest;

class CreateHotelRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'address' => ['required', 'string'],
            'starRating' => ['required', 'numeric'],
            'description' => ['required', 'string'],
        ];
    }
}
