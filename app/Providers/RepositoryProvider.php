<?php

namespace App\Providers;

use App\Repositories\BookingRepository;
use App\Repositories\EmailVerificationTokenRepository;
use App\Repositories\HotelRepository;
use App\Repositories\ImageRepository;
use App\Repositories\Interfaces\IBookingRepository;
use App\Repositories\Interfaces\IEmailVerificationTokenRepository;
use App\Repositories\Interfaces\IHotelRepository;
use App\Repositories\Interfaces\IImageRepository;
use App\Repositories\Interfaces\IProfileRepository;
use App\Repositories\Interfaces\IRoomRepository;
use App\Repositories\Interfaces\IUserRepository;
use App\Repositories\ProfileRepository;
use App\Repositories\RoomRepository;
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
        $this->app->bind(IHotelRepository::class, HotelRepository::class);
        $this->app->bind(IImageRepository::class, ImageRepository::class);
        $this->app->bind(IRoomRepository::class, RoomRepository::class);
        $this->app->bind(IBookingRepository::class, BookingRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
