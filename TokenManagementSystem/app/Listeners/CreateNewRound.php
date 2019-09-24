<?php

namespace App\Listeners;

use App\Events\NewRoundNeeded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateNewRound
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
     * @param  NewRoundNeeded  $event
     * @return void
     */
    public function handle(NewRoundNeeded $event)
    {
        //
    }
}
