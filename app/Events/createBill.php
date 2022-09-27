<?php

namespace App\Events;

use App\Models\bills;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;

class createBill
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $bill;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct( bills $bill )
    {
        $this->bill = $bill;
    }
    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return  []; // new PrivateChannel('channel-name');
    }
}