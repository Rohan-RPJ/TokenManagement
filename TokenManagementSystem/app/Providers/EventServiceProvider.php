<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'App\Events\QuestionsStored' => [
            'App\Listeners\StoreSubmissionDetails',
            'App\Listeners\StartSubmission',
        ],
        'App\Events\NewParticipantJoined'=>[
            'App\Listeners\JoinRound', //check if existing round is available and has room for new participants
            //'App\Listeners\StartRound', //check if min no of participants reached and then start round

        ],
        'App\Events\NewRoundNeeded'=>[
            'App\Listeners\CreateNewRound',
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
