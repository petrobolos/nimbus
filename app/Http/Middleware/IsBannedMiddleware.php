<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsBannedMiddleware
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
        if ($request->user() && $request->user()->isNotBanned()) {
            return $next($request);
        }

        return redirect()->route('banned');
    }
}
