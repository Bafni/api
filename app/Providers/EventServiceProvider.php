<?php

namespace App\Providers;

use App\Events\SendMessageEvent;
use App\Events\RecordSettingsEvent;
use App\Events\TestEvent;
use App\Listeners\RecordSettingsEventHandler;
use App\Listeners\TestEventListnerHendler;
use App\Listeners\SendMessageEventHandler;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        TestEvent::class =>[
            TestEventListnerHendler::class,
        ],
        RecordSettingsEvent::class =>[
            RecordSettingsEventHandler::class,
        ],
        SendMessageEvent::class =>[
            SendMessageEventHandler::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
