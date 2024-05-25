<?php

namespace App\Http\Requests\Api\v1\Profile;

use App\Enums\RoleType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'firstName' => ['string', 'max:255'],
            'lastName' => ['string', 'max:255'],
            'phone' => ['string', 'regex:/^\+\d{11}$/'],
            'dob' => ['date'],
            'country' => ['string', 'max:255'],
            'city' => ['string', 'max:255'],
            'fullAddress' => ['nullable', 'string', Rule::requiredIf(fn () => $this->user()->profile->account_type === RoleType::Owner)], // Only required if accountType is 'owner'
        ];
    }
}
