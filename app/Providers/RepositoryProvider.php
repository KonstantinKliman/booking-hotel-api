<?php

namespace App\Providers;

use App\Repositories\EmailVerificationTokenRepository;
use App\Repositories\Interfaces\IEmailVerificationTokenRepository;
use App\Repositories\Interfaces\IProfileRepository;
use App\Repositories\Interfaces\IUserRepository;
use App\Repositories\ProfileRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(IProfileRepository::class, ProfileRepository::class);
        $this->app->bind(IEmailVerificationTokenRepository::class, EmailVerificationTokenRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
