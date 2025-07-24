<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\UserSession;
use Illuminate\Support\Facades\Request;

class LogSuccessfulLogout
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
    public function handle(Logout $event)
    {
        $user = $event->user;
        // Actualiza la última sesión abierta sin logout_at
        UserSession::where('user_id', $user->id)
            ->whereNull('logout_at')
            ->orderByDesc('login_at')
            ->limit(1)
            ->update([
                'logout_at' => now(),
            ]);
    }
}
