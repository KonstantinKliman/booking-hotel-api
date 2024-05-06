<?php

namespace App\Http\Middleware;

use App\Enums\RoleType;
use App\Models\Booking;
use App\Repositories\Interfaces\IBookingRepository;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckBookingOwnership
{

    private IBookingRepository $repository;

    public function __construct(IBookingRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $booking = $this->repository->getById($request->route('bookingId'));

        if ($request->user()->role->id === RoleType::Customer->value) {
            if ($request->user()->id !== $booking->user_id) {
                return response()->json(null, 403);
            }
        }

        if ($request->user()->role->id === RoleType::Owner->value) {
            if ($booking->room->hotel->user_id !== $request->user()->id) {
                return response()->json(null, 403);
            }
        }

        return $next($request);
    }
}
