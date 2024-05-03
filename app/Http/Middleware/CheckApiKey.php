<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckApiKey
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the provided API key matches the expected value
        $apiKey = $request->header('X-API-Key');
        $expectedKey = env('API_KEY'); // API key stored in .env

        if ($apiKey !== $expectedKey) {
            // Respond with error if API key is invalid
            return response()->json(['error' => 'Unauthorized - Invalid API key'], 401);
        }

        return $next($request);
    }
}
