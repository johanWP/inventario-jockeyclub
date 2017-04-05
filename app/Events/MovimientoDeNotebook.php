<?php

namespace App\Events;

use App\Asset;
use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MovimientoDeNotebook extends Event
{
    use SerializesModels;

    public $asset;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Asset $asset)
    {
        $this->asset = $asset;
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
