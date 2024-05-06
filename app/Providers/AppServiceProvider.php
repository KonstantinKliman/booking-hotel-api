<?php

namespace App\Providers;

use App\Services\BookingService;
use App\Services\HotelService;
use App\Services\Interfaces\IBookingService;
use App\Services\Interfaces\IHotelService;
use App\Services\Interfaces\IProfileService;
use App\Services\Interfaces\IRoomService;
use App\Services\Interfaces\IUserService;
use App\Services\Interfaces\IVerificationEmailService;
use App\Services\ProfileService;
use App\Services\RoomService;
use App\Services\UserService;
use App\Services\VerificationEmailService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IUserService::class, UserService::class);
        $this->app->bind(IProfileService::class, ProfileService::class);
        $this->app->bind(IVerificationEmailService::class, VerificationEmailService::class);
        $this->app->bind(IHotelService::class, HotelService::class);
        $this->app->bind(IRoomService::class, RoomService::class);
        $this->app->bind(IBookingService::class, BookingService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
