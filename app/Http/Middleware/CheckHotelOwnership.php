<?php

namespace App\Http\Middleware;

use App\Models\Hotel;
use App\Repositories\Interfaces\IHotelRepository;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckHotelOwnership
{

    private IHotelRepository $repository;

    public function __construct(IHotelRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $hotel = $this->getHotelFromRequest($request);

        if ($request->user()->id !== $hotel->user_id) {
            abort(403);
        }

        return $next($request);
    }

    private function getHotelFromRequest(Request $request)
    {
        $hotelId = $request->route('hotelId');
        if (!$hotelId && $request->hotelId) {
            $hotelId = $request->hotelId;
        }
        return $this->repository->getById($hotelId);
    }
}
