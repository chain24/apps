<?php

namespace App\Events;

use App\Models\Post\Post;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PostViewEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $ip;
    public $post;

    /**
     * PostViewEvent constructor.
     * @param Post $post
     * @param $ip
     */
    public function __construct(Post $post, $ip)
    {
        $this->ip =$ip;
        $this->post = $post;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
