<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class ThrottleRequests
{

    public function handle($request, Closure $next)
    {
        $user_id = auth()->id();
        $clicks = Cache::get('clicks_' . $user_id, 0);
        $last_click_time = Cache::get('last_click_time_' . $user_id, null);
        $current_time = now();
        if (!$last_click_time || $current_time->diffInSeconds($last_click_time) >= 3) {
            $clicks = 1;
            Cache::put('clicks_' . $user_id, $clicks, now()->addMinutes(1)); // زمان انقضای کش را یک دقیقه تنظیم کرده‌ایم
            Cache::put('last_click_time_' . $user_id, $current_time, now()->addMinutes(1));
        } else {
            $clicks++;
            Cache::put('clicks_' . $user_id, $clicks, now()->addMinutes(1)); // زمان انقضای کش را یک دقیقه تنظیم کرده‌ایم
        }
        return $next($request);
    }
}
