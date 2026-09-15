<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateWithApiSecret
{
    public function handle(Request $request, Closure $next): Response
    {
        $configuredKey = config('app.api_secret_key');
        $providedKey = $request->bearerToken() ?? $request->header('X-API-Key');

        if (! is_string($configuredKey) || $configuredKey === '' || ! is_string($providedKey)
            || ! hash_equals($configuredKey, $providedKey)) {
            return response()->json(['message' => 'Unauthorized.'], Response::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }
}
