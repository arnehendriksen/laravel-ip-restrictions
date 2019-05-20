<?php namespace arnehendriksen\LaravelIpRestrictions;

class IpRestrictions
{
    /**
     * Returns whether the given (or current) IP is whitelisted.
     *
     * @param null $ip
     * @return bool
     */
    public static function whitelisted($ip = null)
    {
        $ip = ($ip ?: request()->ip());
        $all = config('ip-restrictions.whitelist.all', []);
        $env = config('ip-restrictions.whitelist.'.config('app.env'), []);
        $list = array_merge($all, $env);
        return in_array($ip, $list);
    }

    /**
     * Returns whether the given (or current) IP is blacklisted.
     *
     * @param null $ip
     * @return bool
     */
    public static function blacklisted($ip = null)
    {
        $ip = ($ip ?: request()->ip());
        $all = config('ip-restrictions.blacklist.all', []);
        $env = config('ip-restrictions.blacklist.'.config('app.env'), []);
        $list = array_merge($all, $env);
        return in_array($ip, $list);
    }
}
