<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class ProgressEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */

    public $text;
    public $perc;
    public $dive_n;

    public function __construct($text, $perc = null,$dive_n=null)
    {
        $this->text = $text;
        $this->perc = $perc;
        $this->dive_n=$dive_n;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('progress.'.Auth::id());
    }

    public function broadcastWith()
    {
        return ['text' => $this->text, 'perc' => $this->perc,'dive_n'=>$this->dive_n];
    }
}
