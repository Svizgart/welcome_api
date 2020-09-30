<?php

namespace App\Mail;

use App\Models\Participant;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailNotification extends Mailable
{
    use Queueable, SerializesModels;

    private $participant;

    public function __construct(Participant $participant)
    {
        $this->participant = $participant;
    }

    public function build()
    {
        $name = $this->participant;

        return $this->view('email.notification')
            ->from(config('mail.from.address'))
            ->with(['name' => $name])
            ->subject('Подтверждение участника события');
    }
}
