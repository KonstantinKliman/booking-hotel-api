<?php

namespace App\Http\Requests\Api\v1\Profile;

use App\Enums\AccountType;
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
            'dob' => ['date', 'date_format:d-m-Y'],
            'country' => ['string', 'max:255'],
            'city' => ['string', 'max:255'],
            'fullAddress' => ['nullable', 'string', Rule::requiredIf(fn () => $this->user()->profile->account_type === AccountType::Owner)], // Only required if accountType is 'owner'
        ];
    }
}
