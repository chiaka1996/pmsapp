<?php

namespace App\Http\Middleware;

use App\Enums\RoleEnum;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()->hasRole(RoleEnum::SUPER_ADMIN->value) || $request->user()->hasRole(RoleEnum::ADMIN->value)) {
            return $next($request);
        }
        return redirect(route('login'));
    }
}
