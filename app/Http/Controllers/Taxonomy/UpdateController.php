<?php

namespace App\Http\Controllers\Taxonomy;

use App\Http\Controllers\Controller;
use App\Http\Requests\Taxonomy\UpdateRequest;
use App\Http\Resources\Taxonomy\TaxonomyResource;
use App\Models\Taxonomy;

class UpdateController extends Controller
{

    public function __invoke(UpdateRequest $request, Taxonomy $taxonomy)
    {

        $data = $request->validated($request);
        isset($data['data']) ? $data['data'] = json_encode($data['data']): '';
        $taxonomy->update($data);
        return new TaxonomyResource($taxonomy);
    }
}
