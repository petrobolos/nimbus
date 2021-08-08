<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Class IsUnbannedMiddleware
 *
 * @package App\Http\Middleware
 */
class IsUnbannedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if (auth()->user() && !auth()->user()->isBanned()) {
            return $next($request);
        }

        return redirect(route('account.banned'));
    }
}
