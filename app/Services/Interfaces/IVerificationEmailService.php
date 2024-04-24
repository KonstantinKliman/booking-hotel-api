<?php

namespace App\Services\Interfaces;

use App\Models\User;
use Illuminate\Http\JsonResponse;

interface IVerificationEmailService
{
    public function generateVerificationLink(string $email);

    public function sendVerificationLink(User $user): void;

    public function verifyToken(string $email, string $token);

    public function checkIfEmailIsVerified(User $user);

    public function verifyEmail(string $email, string $token);

    public function resendLink(string $email);

    public function getTokenForRegisterResponse(string $email): string;
}
