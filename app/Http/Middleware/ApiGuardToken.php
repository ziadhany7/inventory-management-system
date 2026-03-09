<?php

namespace App\Http\Middleware;

use App\Traits\ApiResponseTrait;
use Closure;
use Illuminate\Http\Request;

class ApiGuardToken
{
    use ApiResponseTrait;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $secretKey = $request->header('X-SECRET-KEY') ?? $request->header('x-secret-key');


        // if (!$secretKey || $secretKey != env('API_SECRET_KEY')) {
        //     return $this->apiResponse([], 401, 'invalid key');
        // }

        return $next($request);
    }
}
