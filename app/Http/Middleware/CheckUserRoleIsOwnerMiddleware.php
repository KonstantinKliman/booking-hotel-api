<?php

namespace App\Http\Middleware;

use App\Enums\RoleType;
use App\Exceptions\User\InvalidUserRoleException;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRoleIsOwnerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     * @throws InvalidUserRoleException
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()->role->id != RoleType::Owner->value) {
            throw new InvalidUserRoleException();
        }
        return $next($request);
    }
}
