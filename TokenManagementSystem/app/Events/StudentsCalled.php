<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class StudentsCalled implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $teacherName;
    public $subjectName;

    public $message;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($teacherName, $subjectName)
    {
        $this->teacherName = $teacherName;
        $this->subjectName = $subjectName;
        $this->message = "{$teacherName} called you for {$subjectName} submisison";
        //dd($this->teacherName,$this->subjectName,$this->message);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        //return new PrivateChannel('channel-name');
        //dd($this->teacherName,$this->subjectName,$this->message);
        return new Channel('students-called');
    }
}
