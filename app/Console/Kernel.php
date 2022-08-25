<?php

namespace App\Console;

use App\Console\Commands\SendEmails;
use App\Events\SendMessageEvent;
use App\Mail\SendMail;
use App\Models\Post;
use App\Models\Setting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;
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
/*        $schedule->call(function () {
            Log::alert('ru ru');
        })->description('Send Mail')->everyMinute();

        $schedule->command('send:mail',)->everyMinute();*/

       $schedule->call(function () {
           Log::alert('run schedule');
           SendMessageEvent::dispatch();
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
