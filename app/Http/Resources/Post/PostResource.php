<?php

namespace App\Http\Resources\Post;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'seo_keywords' => $this->seo_keywords,
            'slug' => $this->slug,
            'small_description' => $this->small_description,
            'description' => $this->description,
            'image' => $this->image,
        ];
    }
}
