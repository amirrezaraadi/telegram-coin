<?php

namespace App\Listeners;

use App\Events\TokenEvent;
use App\Jobs\TokenJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TokenListener
{

    public function __construct()
    {
        //
    }

    /**
     * @param  TokenEvent $event
     * @return void
     */
    public function handle(TokenEvent $event)
    {
        dd( $event->getRequest());
        TokenJob::dispatch(
            $event->getRequest(),
            $event->getUser(),
        );
    }
}
