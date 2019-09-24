<?php

namespace App\Listeners;

use App\Events\QuestionsStored;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Submissions;
use Carbon\Carbon; 

class StoreSubmissionDetails
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

    private function createDate($date)
    {
        $date = Carbon::parse($date)->format('Y-m-d');
        return $date;
    }
    /**
     * Handle the event.
     *
     * @param  QuestionsStored  $event
     * @return void
     */
    public function handle(QuestionsStored $event)
    {
        Submissions::create([
                'subject_id' => $event->request['subject_id'],
                'teacher_id' => $event->request['teacher_id'],
                'year' => $event->request['year'],
                'branch' => $event->request['branch'],
                'type' => 'Teacher',
                'submission_date' => $this->createDate($event->request['submission_date']),
                'start_time' => $event->request['start_time'],
                'end_time' => $event->request['end_time'],
            ]);
    }
}
