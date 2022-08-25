<?php

namespace App\Http\Resources\Setting;

use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'setting_type' => $this->setting_type,
            'date_queue' => $this->date_queue,
            'data' => json_decode($this->data),
        ];
    }
}
