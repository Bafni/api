<?php

namespace App\Listeners;

use App\Events\RecordSettingsEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Storage;

class RecordSettingsEventHandler
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
     * @param  \App\Events\RecordSettingsEvent  $event
     * @return void
     */
    public function handle(RecordSettingsEvent $event)
    {
        $data_list = [
            'setting_id' => 'id-' . $event->data->id,
            'date_queue' => 'date_queue-' . $event->data->date_queue,
            'id' => 'setting_id-' . $event->data->id,
            'user_id' => 'user_id-' . $event->data->user_id,
        ];
        $list = implode(',', $data_list);

        Storage::append('mail/mail_list.txt', $list);
    }
}
