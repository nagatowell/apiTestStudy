<?php

namespace App\Http\Middleware;

use App\Access;
use Closure;

class ApiTokenMiddleware
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
        $acc = Access::where('api_token', $request->bearerToken())->first();

        if(!empty($acc)){
            return $next($request);
        }

        return response()->json("", 401);
    }
}
