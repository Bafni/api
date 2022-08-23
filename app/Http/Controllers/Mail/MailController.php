<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use App\Mail\SendMail;
use App\Models\Post;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{

    public function __invoke()
    {
        $post = Post::find(2);

            Mail::to('reclamabafni@gmail.com')->send(new SendMail($post));

        return response()->json([
            "send" => 'Successfully!'
        ]);

    }
}
