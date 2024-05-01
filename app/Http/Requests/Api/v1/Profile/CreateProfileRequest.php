<?php

namespace App\Http\Requests\Api\v1\Profile;

use App\Enums\RoleType;
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
            'roleType' => ['required', 'integer', Rule::enum(RoleType::class)], // 1 - owner, 2 - customer
            'companyName' => ['nullable', 'string', 'max:255', Rule::requiredIf(fn () => $this->input('roleType') === RoleType::Owner->value)], // Only required if roleType is 'owner'
            'country' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'fullAddress' => ['nullable', 'string', Rule::requiredIf(fn () => $this->input('roleType') === RoleType::Owner->value)], // Only required if roleType is 'owner'
        ];
    }
}
