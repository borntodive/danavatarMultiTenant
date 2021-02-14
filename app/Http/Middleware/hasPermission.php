<?php

namespace App\Http\Middleware;

use Closure;

class hasPermission
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        $permission=$role.'_permission';
        if ($request->route('user') && $request->route('user')->id==auth()->user()->id)
            return $next($request);
        if (auth()->user()->isAbleTo($permission,session()->get('tenant')->slug))
            return $next($request);
        return abort(403);
    }
}
