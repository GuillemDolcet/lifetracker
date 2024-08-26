<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

final class DDoSProtection
{
    public function handle(Request $request, Closure $next)
    {
        $ip = $request->ip();
        $key = $this->getRateLimiterKey($ip);

        $maxAttempts = 100;

        if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            return response()->json([
                'message' => 'Too many requests. Please try again later.',
            ], 429);
        }

        RateLimiter::hit($key);

        return $next($request);
    }

    private function getRateLimiterKey($ip): string
    {
        return Str::lower($ip) . '|' . request()->path();
    }
}
