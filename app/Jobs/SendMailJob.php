<?php

namespace App\Jobs;

use App\Mail\SendMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;
    public $post;
    public $value;
    public $file;

    public function __construct($user, $post, $value, $file)
    {
        $this->user = $user;
        $this->post = $post;
        $this->value = $value;
        $this->file = $file;

    }

    public function handle()
    {
        Mail::to($this->user->email)->send(new SendMail($this->post));
        /*стираємо із списку mail_list.txt відправений сетінг*/
        /*$file = preg_replace('/[\r\n]+/s', "\n", preg_replace("/" . $this->value['string'] . "/", '', $this->file));
        Storage::put('mail/mail_list.txt', $file);
        /*стираємо з бази надісланий сетінг*/
        /* Setting::where('id', $this->value['id'])->delete();*/
        Log::alert('send mail' . ' ' . $this->user->email);

    }
}
