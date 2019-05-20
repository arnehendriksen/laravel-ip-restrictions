<?php

namespace arnehendriksen\LaravelIpRestrictions\Middleware;

use Closure;

class Whitelist
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
        $allow = false;

        $whitelist_all = config('ip-restrictions.whitelist.all', []);
        $whitelist_env = config('ip-restrictions.whitelist.'.config('app.env'), []);
        $whitelist = array_merge($whitelist_all, $whitelist_env);

        if (in_array($request->ip(), $whitelist)) {
            $allow = true;
        }

        if (!$allow) {
            abort(403);
        }
        return $next($request);
    }
}
