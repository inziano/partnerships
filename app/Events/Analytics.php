<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Partner;
use App\Agreement;

class Analytics implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $partnershipStats;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Total partners
        $partnerCount = Partner::count();

        // Partners by country
        $partnerByCountry = Partner::all()->groupBy('country');

        // Partner by field
        $partnerByField = Partner::all()->groupBy('field');

        // Total agreements
        $agreementCount = Agreement::count();

        // Agreement by type
        $agreementByType = Agreement::all()->groupBy('type');

        // Stats
        $this->partnershipStats = [
            'partners' => $partnerCount,
            'countries' => $partnerByCountry,
            'fields' => $partnerByField,
            'agreements' => $agreementCount,
            'types' => $agreementByType
        ];

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('analytics');
    }
}
