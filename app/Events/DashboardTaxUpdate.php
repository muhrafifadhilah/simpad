<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class DashboardTaxUpdate implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $taxData;

    public function __construct($taxData)
    {
        $this->taxData = $taxData;
    }

    public function broadcastOn()
    {
        return new Channel('dashboard-tax');
    }

    public function broadcastAs()
    {
        return 'dashboard-tax-update';
    }
}
