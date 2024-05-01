<?php

namespace App\Http\Requests\Api\v1\Image;

use Illuminate\Foundation\Http\FormRequest;

class CreateImageRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'images.*' => ['required', 'image']
        ];
    }
}
