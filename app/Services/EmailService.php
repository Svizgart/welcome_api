<?php

namespace App\Services;

use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

final class EmailService
{
    public function send(array $emails, Mailable $mailable): void
    {
        Mail::to($emails)->send($mailable->build());
    }
}
