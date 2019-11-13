<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Model\SaldoAwal;

class SaldoAwalBertambah
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $saldo_awal;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(SaldoAwal $saldo_awal)
    {
        $this->saldo_awal = $saldo_awal;
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
