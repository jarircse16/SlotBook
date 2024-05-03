<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class CorsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // Get the origin of the request
        $origin = $request->headers->get('Origin');

        // Allow origins based on custom rules
        if ($this->isAllowedOrigin($origin)) {
            $response->headers->set('Access-Control-Allow-Origin', $origin);
            $response->headers->set('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, PUT, DELETE');
            $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Accept, Authorization, X-Requested-With, Application');
            $response->headers->set('Access-Control-Allow-Credentials', 'true');
        }

        return $response;
    }

    /**
     * Check if the origin is allowed.
     *
     * @param  string|null  $origin
     * @return bool
     */
    protected function isAllowedOrigin($origin): bool
    {
        // Allow any port on localhost
        if (preg_match('/^http:\/\/localhost(:[0-9]+)?$/', $origin)) {
            return true;
        }

        // Allow any port on yourdomain.com
        if (preg_match('/^https:\/\/yourdomain\.com(:[0-9]+)?$/', $origin)) { // Change this when uploading to hosting
            return true;
        }

        // Add more domain checks here if needed
        return false;
    }
}
