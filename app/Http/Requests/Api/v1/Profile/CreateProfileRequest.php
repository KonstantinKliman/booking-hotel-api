<?php

namespace App\Http\Requests\Api\v1\Profile;

use App\Enums\AccountType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateProfileRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'regex:/^\+\d{11}$/'],
            'dob' => ['required', 'date', 'date_format:d-m-Y'],
            'accountType' => ['required', 'string', Rule::enum(AccountType::class)],
            'country' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'fullAddress' => ['nullable', 'string', Rule::requiredIf(fn () => $this->input('accountType') === AccountType::Owner->value)], // Only required if accountType is 'owner'
        ];
    }
}
