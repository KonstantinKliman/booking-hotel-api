<?php

namespace App\Http\Requests\Api\v1\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['email', Rule::unique('users', 'email')],
            'password' => ['string', 'min:8'],
            'passwordConfirmation' => ['string', 'min:8', 'same:password']
        ];
    }
}
