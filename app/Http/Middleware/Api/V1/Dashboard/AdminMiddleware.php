<?php

namespace App\Http\Middleware\Api\V1\Dashboard;

use App\Http\Traits\ApiResponseTrait;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    use ApiResponseTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // dd($request->user()->role);
        if (!auth()->guard('admin-api')->check()) {
            return $this->apiError(message: 'Unauthorized', code: 401);
        }
        if (!in_array($request->user()->role, $roles)) {
            return $this->apiError(message: 'Unauthorized', code: 401);
        }
        return $next($request);
    }
}