<?php

namespace App\Http\Middleware;

use App\Repository\userRepo;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class ActivityByUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->header('info-user')) {
            $user = resolve(userRepo::class)->getIdName($request->header('info-user'));
            $expiresAt = Carbon::now()->addMinutes(1);
            Cache::put('user-is-online-' . $user->id , true, $expiresAt);
            resolve(userRepo::class)->last_seen($request->header('info-user'));
        }
        return $next($request);
    }
}
