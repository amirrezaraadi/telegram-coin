<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TokenEvent implements ShouldBroadcast, ShouldHandleEventsAfterCommit
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

//    public $click;
//    public $userId;
//
//    public function __construct($userId , $click)
//    {
//        $this->click = $click;
//        $this->userId = $userId;
//
//    }
//
//    public function broadcastOn(): Channel
//    {
//        return new Channel('laravel' . $this->userId);
//    }
//
//
//    public function broadcastAs()
//    {
//        return 'laravel';
//    }

//    public function getRequest(): Request
//    {
//        return $this->request;
//    }
//
//    public function getUser(): User
//    {
//        return $this->user;
//    }


    public $uuid_name;
    public $new_balance;
    public $time;

    public function __construct($data)
    {
        $this->uuid_name = $data['uuid_name'];
        $this->new_balance = $data['new_balance'];
        $this->time = $data['time'];
        dd($this->uuid_name);
    }

    public function broadcastOn()
    {
        return new Channel('token-received');
    }
}
