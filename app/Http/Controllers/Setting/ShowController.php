<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Http\Resources\Setting\SettingResource;
use App\Models\Setting;
use Illuminate\Http\Request;

class ShowController extends Controller
{

    public function __invoke(Setting $setting)
    {
        return new SettingResource($setting);
    }
}
