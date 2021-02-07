<?php

namespace App\Http\Middleware;

use App\Models\Tenant;
use Closure;

class requestHasTentant
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
        if (session()->get('tenant')) {
            return $next($request);
        }
        $url=$request->server->all()['HTTP_HOST'];
        $url=$str = preg_replace('#^https?://#', '', $url);
        preg_match('/^([a-z0-9|-]+[a-z0-9]{1,}\.)*[a-z0-9|-]+[a-z0-9]{1,}\.[a-z]{2,}$/',$url, $matches);
        $subdomain=null;
        if (isset($matches[1]))
            $subdomain=rtrim($matches[1], " \t.");
        if ($subdomain && $subdomain!='www') {
            $center=Tenant::where(['url'=>$subdomain])->firstOrFail();
            $request->session()->put('tenant', $center);
            session(['tenant' => $center]);
        }
        return $next($request);
    }
}
