<?php

namespace App\Http\Resources\Taxonomy;

use Illuminate\Http\Resources\Json\JsonResource;

class TaxonomyResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'taxonomy_type' => $this->taxonomy_type,
            'data' => json_decode($this->data),
        ];
    }
}
