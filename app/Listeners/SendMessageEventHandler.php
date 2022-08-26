<?php

namespace App\Listeners;

use App\Events\SendMessageEvent;
use App\Jobs\SendMailJob;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Storage;

class SendMessageEventHandler implements ShouldQueue
{
    public function __construct()
    {
        //
    }
    public function handle(SendMessageEvent $event)
    {
        $file = Storage::get('mail/mail_list.txt');
        preg_match_all('#(id-(?<id>\d+))\,((date_queue-(?<date_queue>(\d{4})-(\d{2})-(\d{2}).(\d{2}):(\d{2})))\,setting_id-(?<setting_id>[0-9]+))\,(user_id-(?<user_id>[0-9]+))#', $file, $match);
        $count = count($match['date_queue']);
        $arrays = [];
        for ($i = 0; $i < $count; $i++) {
            $arrays [$match['setting_id'][$i]] =
                [
                    'id' => $match['id'][$i],
                    'user_id' => $match['user_id'][$i],
                    'date_queue' => $match['date_queue'][$i],
                    'string' => $match[0][$i],
                ];
        }
        $date = Carbon::now()->timezone('Europe/Kiev')->format('Y-m-d H:i');
        foreach ($arrays as $key => $value) {
            if (strtotime($date) == strtotime($value['date_queue'])) {
                $user = User::find($value['user_id']);
                $post = Post::find(2);
                SendMailJob::dispatch($user, $post, $value, $file);
            }
        }
    }
}
