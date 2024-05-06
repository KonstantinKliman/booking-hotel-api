<?php

namespace App\Http\Middleware;

use App\Models\Room;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRoomOwnership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $room = Room::query()
            ->join('hotels', 'rooms.hotel_id', '=', 'hotels.id')
            ->where('hotels.user_id', $request->user()->id)
            ->first();

        if ($request->user()->id !== $room->user_id)
        {
            abort(403);
        }
        return $next($request);
    }
}
