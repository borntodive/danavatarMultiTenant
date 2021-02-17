<?php

namespace App\Http\Middleware;

use Closure;

class TenantHasSpecialty
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next,$specialty)
    {
        if(session()->get('tenant')->hasMedicalSpecilities($specialty))
            return $next($request);
        abort(403);
    }
}
