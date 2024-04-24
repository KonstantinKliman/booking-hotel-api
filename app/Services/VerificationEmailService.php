<?php

namespace App\Services;

use App\Exceptions\User\ExpiredEmailVerificationTokenException;
use App\Exceptions\User\FailedEmailVerificationTokenException;
use App\Exceptions\User\InvalidEmailVerificationTokenException;
use App\Exceptions\User\InvalidUserCredentialsException;
use App\Models\EmailVerificationToken;
use App\Models\User;
use App\Notifications\EmailVerificationNotification;
use App\Repositories\Interfaces\IEmailVerificationTokenRepository;
use App\Repositories\Interfaces\IUserRepository;
use App\Services\Interfaces\IVerificationEmailService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

class VerificationEmailService implements IVerificationEmailService
{
    private IUserRepository $userRepository;
    private IEmailVerificationTokenRepository $tokenRepository;

    public function __construct(IUserRepository $userRepository, IEmailVerificationTokenRepository $tokenRepository)
    {
        $this->userRepository = $userRepository;
        $this->tokenRepository = $tokenRepository;
    }

    public function generateVerificationLink(string $email)
    {
        $checkIfTokenExists = $this->tokenRepository->getByEmail($email);
        if ($checkIfTokenExists) {
            $this->tokenRepository->delete($checkIfTokenExists);
        }
        $token = Str::uuid();
        $url = config('app.url') . '?token=' . $token . '&email=' . $email;
        $data = [
            'email' => $email,
            'token' => $token,
            'expired_at' => now()->addMinutes(60)
        ];
        $saveToken = $this->tokenRepository->create($data);
        if ($saveToken)
        {
            return $url;
        }
    }

    public function sendVerificationLink(User $user): void
    {
        Notification::send($user, new EmailVerificationNotification($this->generateVerificationLink($user->email)));
    }

    public function verifyToken(string $email, string $token)
    {
        $token = $this->tokenRepository->getByEmailAndToken($email, $token);
        if (!$token) {
            throw new InvalidEmailVerificationTokenException();
        }

        if (!$token->expired_at >= now()) {
            $token->delete();
            throw new ExpiredEmailVerificationTokenException();
        }

        return $token;
    }

    public function checkIfEmailIsVerified(User $user)
    {
        if ($user->email_verified_at) {
            return response()->json([
                'message' => 'Email is already verified.'
            ]);
        }
    }

    public function verifyEmail(string $email, string $token)
    {
        $user = $this->userRepository->get($email);
        if (!$user) {
            throw new InvalidUserCredentialsException();
        }
        $this->checkIfEmailIsVerified($user);
        $verifiedToken = $this->verifyToken($email, $token);
            if (!$user->markEmailAsVerified()) {
            throw new FailedEmailVerificationTokenException();
        }
        $verifiedToken->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Email has been verified successfully'
        ]);
    }

    public function resendLink(string $email)
    {
        $user = $this->userRepository->get($email);
        if (!$user) {
            throw new InvalidUserCredentialsException();
        }
        $this->sendVerificationLink($user);
        return response()->json([
            'status' => 'success',
            'message' => 'Verification link send successfully'
        ]);
    }

    public function getTokenForRegisterResponse(string $email): string
    {
        return $this->tokenRepository->getTokenByEmail($email);
    }
}
