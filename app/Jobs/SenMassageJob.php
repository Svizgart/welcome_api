<?php

namespace App\Jobs;

use App\Mail\EmailNotification;
use App\Models\Event;
use App\Models\Participant;
use App\Services\EmailService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SenMassageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $participant;
    private $emailService;

    public function __construct(EmailService $emailService, Participant $participant)
    {
        $this->participant = $participant;
        $this->emailService = $emailService;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        info('отправка письма');
        //$mail = new EmailNotification($this->participant);
        //$this->emailService->send([$this->participant->email], $mail);
    }
}
