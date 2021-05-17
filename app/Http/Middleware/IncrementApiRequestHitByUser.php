<?php

namespace App\Http\Middleware;

use App\Events\ApiRequestHit;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class IncrementApiRequestHitByUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        ApiRequestHit::dispatch($request->user());
        return $next($request);
    }
}
