<?php

namespace App\Http\Controllers\Taxonomy;

use App\Http\Controllers\Controller;
use App\Http\Requests\Taxonomy\IndexRequest;
use App\Http\Resources\Taxonomy\TaxonomyResource;
use App\Models\Taxonomy;

class IndexController extends Controller
{

    public function __invoke(IndexRequest $request)
    {
        $data = $request->validated($request);
        $page = $data['page'] ?? 1; // номер сторінки
        $perPage = $data['per_page'] ?? 10; // кількість постів на сторінці
        $taxonomy = Taxonomy::paginate($perPage, ['*'], 'page', $page );
        return TaxonomyResource::collection($taxonomy);
    }
}
