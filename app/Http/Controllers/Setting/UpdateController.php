<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\UpdateRequest;
use App\Http\Resources\Setting\SettingResource;
use App\Models\Setting;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(UpdateRequest $request, Setting $setting)
    {
        $data = $request->validated();
        isset($data['data']) ? $data['data'] = json_encode($data['data']): '';

        $setting->update($data);

        return new SettingResource($setting);
    }
}
