<?php

namespace arnehendriksen\LaravelIpRestrictions\Middleware;

use Closure;

class IpRestrictions
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

        $blacklist_all = config('ip-restrictions.blacklist.all');
        $blacklist_env = config('ip-restrictions.blacklist.'.config('app.env'));
        $whitelist_all = config('ip-restrictions.whitelist.all');
        $whitelist_env = config('ip-restrictions.whitelist.'.config('app.env'));

        if (is_array($blacklist_all) && count($blacklist_all) > 0) {
            if (in_array($request->ip(), $blacklist_all)) {
                abort(403);
            }
        }
        if (is_array($blacklist_env) && count($blacklist_env) > 0) {
            if (in_array($request->ip(), $blacklist_env)) {
                abort(403);
            }
        }
        if (is_array($whitelist_all) && count($whitelist_all) > 0) {
            if (in_array($request->ip(), $whitelist_all)) {
                $allow = true;
            }
        }
        if (is_array($whitelist_env) && count($whitelist_env) > 0) {
            if (in_array($request->ip(), $whitelist_env)) {
                $allow = true;
            }
        }
        if (!$allow) {
            abort(403);
        }
        return $next($request);
    }
}
