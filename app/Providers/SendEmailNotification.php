<?php

namespace App\Providers;

use App\Jobs\SenMassageJob;
use App\Providers\MemberAdded;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendEmailNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  MemberAdded  $event
     * @return void
     */
    public function handle(MemberAdded $event)
    {
        SenMassageJob::dispatch($event->emailService, $event->participant);
    }
}
