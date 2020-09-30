<?php

namespace App\Providers;

use App\Models\Participant;
use App\Services\EmailService;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MemberAdded
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $participant;
    public $emailService;

    public function __construct(EmailService $emailService, Participant $participant)
    {
        $this->participant = $participant;
        $this->emailService = $emailService;
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
