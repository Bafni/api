<?php

namespace App\Listeners;

use App\Events\SendMessageEvent;
use App\Jobs\SendMailJob;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SendMessageEventHandler implements ShouldQueue
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
     * @param  \App\Events\SendMessageEvent  $event
     * @return void
     */
    public function handle(SendMessageEvent $event)
    {
        Log::alert('SendMessageEventHandler');
        $file = Storage::get('mail/mail_list.txt');
        preg_match_all('#(id-(?<id>\d+))\,((date_queue-(?<date_queue>(\d{4})-(\d{2})-(\d{2}).(\d{2}):(\d{2})))\,setting_id-(?<setting_id>[0-9]+))\,(user_id-(?<user_id>[0-9]+))#', $file, $match);
        $count = count($match['date_queue']);
        $arrays = [];
        for ($i = 0; $i < $count; $i++) {
            $arrays [
            $match['setting_id'][$i]
            ] =
                [
                    'id' => $match['id'][$i],
                    'user_id' => $match['user_id'][$i],
                    'date_queue' => $match['date_queue'][$i],
                    'string' => $match[0][$i],
                ];
        }
        $date = Carbon::now()->timezone('Europe/Kiev')->format('Y-m-d H:i');
        foreach ($arrays as $key => $value)
        {
            if (strtotime($date) == strtotime($value['date_queue']))
            {
                $user = User::find($value['user_id']);
                $post = Post::find(2);
                SendMailJob::dispatch($user, $post, $value, $file);
               /* Mail::to($user->email)->send(new SendMail(Post::find(2)));*/
                //стираємо зі списку mail_list.txt відправений сетінг
               // $file =  preg_replace('/[\r\n]+/s',"\n", preg_replace("/".$value['string']."/",'', $file));
              //  Storage::put('mail/mail_list.txt', $file);
                //стираємо з бази надісланий сетінг
               // Setting::where('id',$value['id'])->delete();
               /* dump('Successful' . ' - ' . $user->email);*/
            }
        }
    }
}
