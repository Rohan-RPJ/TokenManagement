<?php

namespace App\Listeners;

use App\Events\NewParticipantJoined;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class StartRound
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
     * @param  NewParticipantJoined  $event
     * @return void
     */
    public function handle(NewParticipantJoined $event)
    {
        //
    }
}
