<?php

namespace App\Http\Controllers\Taxonomy;

use App\Http\Controllers\Controller;
use App\Http\Requests\Taxonomy\StoreRequest;
use App\Http\Resources\Taxonomy\TaxonomyResource;
use App\Models\Taxonomy;

class StoreController extends Controller
{

    public function __invoke(StoreRequest $request)
    {
        /*        if(!auth()->user()){
                    return response()->json([
                        'error' => 'Unauthorized'
                    ]);
                }*/

        $data = $request->validated();
        try {
            $data['data'] = json_encode($data['data']);


            $taxonomy = Taxonomy::create($data);
        } catch (\Exception $exception) {
            return response()->json([
                'database' => 'Failed to connect to the database'
            ]);
        }

        return new TaxonomyResource($taxonomy);
    }
}
