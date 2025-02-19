<?php
namespace App\Http\Middleware;

use App\Exceptions\ApiResponseException;
use Closure;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

class HasVerifiedEmail
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! auth()->user()->hasVerifiedEmail()) {
            throw new ApiResponseException("Email tastiyiqlanbag'an", 403);
        }

        return $next($request);
    }
}