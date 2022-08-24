<?php

namespace App\Console;

use App\Console\Commands\SendEmails;
use App\Mail\SendMail;
use App\Models\Post;
use App\Models\Setting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        SendEmails::class,
    ];
    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
       $schedule->call(function () {

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
                     dump('+');
                     $user = User::find($value['user_id']);
                     Mail::to($user)->send(new SendMail(Post::find(2)));
                     //стираємо зі списку mail_list.txt відправений сетінг
                     $file =  preg_replace('/[\r\n]+/s',"\n", preg_replace("/".$value['string']."/",'', $file));
                     Storage::put('mail/mail_list.txt', $file);
                     //стираємо з бази надісланий сетінг
                     Setting::where('id',$value['id'])->delete();
                 }
             }
         })->description('Send Mail')->everyMinute();
    }
    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
