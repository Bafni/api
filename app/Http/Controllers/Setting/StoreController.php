<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\StoreRequest;
use App\Http\Resources\Setting\SettingResource;
use App\Mail\SendMail;
use App\Models\Post;
use App\Models\Setting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\VarDumper\Cloner\Data;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {


       $data = $request->validated();
        $data['data'] = json_encode($data['data']);
        $data = Setting::create($data);
        $data_list = [
            'setting_id' => 'id-' . $data->id,
            'date_queue' => 'date_queue-' . $data->date_queue,
            'id' => 'setting_id-' . $data->id,
            'user_id' => 'user_id-' . $data->user_id,
        ];
        $list = implode(',', $data_list);

        Storage::append('mail/mail_list.txt', $list);



    return new SettingResource($data);
    }
}
