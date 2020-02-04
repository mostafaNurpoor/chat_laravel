<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Broadcasting\PrivateChannel;

class ChatEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    public $threadId ;

    public function __construct($message , $threadId)
    {
        $this->message = $message;

        $this->threadId = $threadId;

    }

    public function broadcastOn()
    {

        return new PrivateChannel('chatChannel.' . $this->threadId);
       // return new Channel('chat.' . $this->userId);

    }

    public function broadcastAs()
    {

        return 'new.message';

    }

    public function broadcastWith()
    {

        return ['message' => $this->message];

    }

}
