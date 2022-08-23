<?php

namespace App\Http\Controllers\Taxonomy;

use App\Http\Controllers\Controller;
use App\Http\Resources\Taxonomy\TaxonomyResource;
use App\Models\Taxonomy;


class ShowController extends Controller
{

    public function __invoke(Taxonomy $taxonomy)
    {
        return new TaxonomyResource($taxonomy);
    }
}
