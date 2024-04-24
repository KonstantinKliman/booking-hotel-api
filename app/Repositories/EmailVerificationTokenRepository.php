<?php

namespace App\Repositories;

use App\Models\EmailVerificationToken;
use App\Repositories\Interfaces\IEmailVerificationTokenRepository;

class EmailVerificationTokenRepository implements IEmailVerificationTokenRepository
{
    public function getTokenByEmail(string $email): string
    {
        return EmailVerificationToken::query()->where('email', $email)->first()->token;
    }

    public function getByEmailAndToken(string $email, string $token)
    {
        return EmailVerificationToken::query()->where('email', $email)->where('token', $token)->first();
    }

    public function create(array $data)
    {
        return EmailVerificationToken::create($data);
    }

    public function getByEmail(string $email)
    {
        return EmailVerificationToken::query()->where('email', $email)->first();
    }

    public function delete(EmailVerificationToken $token)
    {
        $token->delete();
    }
}
