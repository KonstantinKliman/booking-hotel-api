<?php

namespace App\Repositories\Interfaces;

use App\Models\EmailVerificationToken;

interface IEmailVerificationTokenRepository
{
    public function getTokenByEmail(string $email): string;

    public function getByEmailAndToken(string $email, string $token);

    public function create(array $data);

    public function getByEmail(string $email);

    public function delete(EmailVerificationToken $token);
}
