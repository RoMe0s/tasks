<?php

namespace App\Listeners;

use App\Events\User\PasswordResetEvent;
use App\Mail\PasswordResetMail;
use App\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class PasswordResetListener implements ShouldQueue
{

    use InteractsWithQueue;

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
     * @param PasswordResetEvent $event
     */
    public function handle(PasswordResetEvent $event)
    {
        $user = $event->user;

        $administartors = User::whereHas('roles', function($query) {

            return $query->whereIn('name', ['Administrators']);

        })->get();

        foreach($administartors as $administartor) {

            Mail::to($administartor->email)->queue(new PasswordResetMail($user));

        }

    }
}
