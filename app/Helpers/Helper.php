<?php

namespace App\Helpers;

if (!function_exists('ip_in_range')) {
    function ip_in_range($ip, $range)
    {
        list($subnet, $bits) = explode('/', $range);
        $subnet = ip2long($subnet);
        $ip = ip2long($ip);
        $mask = -1 << (32 - $bits);
        $subnet &= $mask;

        return ($ip & $mask) === $subnet;
    }
}