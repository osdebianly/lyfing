<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class IpWasChanged extends Event
{
    use SerializesModels;

    public $serveIP ;

    /**
     * Create a new event instance.
     *
     * @param $serverIP
     */
    public function __construct($serveIP)
    {
        $this->serveIP = $serveIP ;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
