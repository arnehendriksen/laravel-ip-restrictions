<?php

namespace arnehendriksen\LaravelIpRestrictions\Middleware;

use Closure;

class Blacklist
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
        $allow = true;

        $blacklist_all = config('ip-restrictions.blacklist.all', []);
        $blacklist_env = config('ip-restrictions.blacklist.'.config('app.env'), []);
        $blacklist = array_merge($blacklist_all, $blacklist_env);

        if (in_array($request->ip(), $blacklist)) {
            $allow = false;
        }

        if (!$allow) {
            abort(403);
        }
        return $next($request);
    }
}
