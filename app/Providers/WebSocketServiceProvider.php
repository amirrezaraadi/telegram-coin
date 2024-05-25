<?php

namespace App\Providers;

use App\Events\TokenEvent;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\ServiceProvider;

class WebSocketServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        //
    }

    public function boot()
    {
//        Redis::subscribe(['send_token'], function ($message) {
//            $data = json_decode($message, true);
//            event(new \App\Events\TokenEvent($data));
//        });
    }
}
