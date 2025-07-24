<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\UserSession;
use Illuminate\Support\Facades\Request;

class LogSuccessfulLogin
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
    public function handle(Login $event)
    {
        $user = $event->user;
        UserSession::create([
            'user_id'    => $user->id,
            'ip_address' => Request::ip(),
            'user_agent' => Request::header('User-Agent'),
            'login_at'   => now(),
            'logout_at'  => null,
        ]);
    }
}
