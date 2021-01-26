<?php

namespace App\Http\Middleware;

use Closure;

class Tenant
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        session(['tenant' => $request->account]);
        return $next($request);
    }
}
