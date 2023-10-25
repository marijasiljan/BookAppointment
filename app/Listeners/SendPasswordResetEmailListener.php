<?php

namespace App\Listeners;

use App\Events\PasswordResetEvent;
use App\Mail\ResetPasswordEmail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class SendPasswordResetEmailListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PasswordResetEvent $event): void
    {
        $user = $event->user;
        $verificationCode = $event->verificationCode;

        Mail::to($user->email)->send(new ResetPasswordEmail($verificationCode));

    }

}
