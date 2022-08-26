<?php

namespace App\Console;

use App\Console\Commands\SendEmails;
use App\Events\SendMessageEvent;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

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
