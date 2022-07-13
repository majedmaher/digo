<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MyNotification implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $title;
    public $content;

    public function __construct($data)
    {
        $this->title = $data['title'];
        $this->content = $data['content'];
    }
    // public $message;

    // public function __construct($message)
    // {
    //     $this->message = $message;
    // }

    // public function broadcastWith()
    // {
    //     // This must always  be an array. Since it will be parsed with json_encode()
    //     return [
    //         'title' => $this->title,
    //         'content' => $this->content,
    //     ];
    // }

    public function broadcastOn()
    {
        return ['my-channel'];
        // return new Channel('my-channel');
    }

    public function broadcastAs()
    {
        return 'my-event';
    }
}
