<?php

namespace Tests\Feature;

use App\Models\Token;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostBroadcastTest extends TestCase
{
    use RefreshDatabase;

    public function testPostBroadcastChannel()
    {
        $post = Token::find(1);
        $this->assertEquals('post.'.$post->id, $post->broadcastOn());
    }
}
