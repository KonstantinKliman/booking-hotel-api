<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Auth\ResendEmailVerificationLinkRequest;
use App\Services\Interfaces\IVerificationEmailService;

class EmailVerificationController extends Controller
{
    private IVerificationEmailService $service;

    public function __construct(IVerificationEmailService $service)
    {
        $this->service = $service;
    }

    public function verifyEmail(string $token, string $email)
    {
        return $this->service->verifyEmail($email, $token);
    }

    public function resendVerificationLink(ResendEmailVerificationLinkRequest $request)
    {
        return $this->service->resendLink($request->validated('email'));
    }
}
