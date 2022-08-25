<?php

namespace App\Http\Controllers\Setting;

use App\Events\RecordSettingsEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\StoreRequest;
use App\Http\Resources\Setting\SettingResource;
use App\Models\Setting;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        $data['data'] = json_encode($data['data']);
        $data = Setting::create($data);
        for ($i = 0; $i < 10; $i++) {
            $data['id'] = $data['id'] + 1 ;
            RecordSettingsEvent::dispatch($data);
        }


        return new SettingResource($data);

    }
}
