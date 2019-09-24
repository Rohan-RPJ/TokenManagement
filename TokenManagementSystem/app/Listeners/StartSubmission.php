<?php

namespace App\Listeners;

use App\Events\QuestionsStored;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class StartSubmission
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
     * @param  QuestionsStored  $event
     * @return void
     */
    public function handle(QuestionsStored $event)
    {
        
    }
}
