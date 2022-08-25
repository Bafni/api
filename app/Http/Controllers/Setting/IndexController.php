<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Http\Resources\Setting\SettingResource;
use App\Models\Setting;
use Illuminate\Http\Request;

class IndexController extends Controller
{

    public function __invoke(Request $request)
    {
      $settings =  Setting::all();


      return SettingResource::collection($settings);
    }
}
