<?php

namespace App\Events;

use App\Models\Stock;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;

class NowInStockEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Stock $stock;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Stock $stock)
    {

        $this->stock = $stock;
    }

    public function broadcastOn(): Channel|PrivateChannel
    {
        return new PrivateChannel('channel-name');
    }
}
