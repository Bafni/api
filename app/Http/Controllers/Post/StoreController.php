<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;

class StoreController extends Controller
{

    public function __invoke(StoreRequest $request)
    {
        if(!auth()->user()){
            return response()->json([
                'error' => 'Unauthorized'
            ]);
        }

        $data = $request->validated();
        try {
            $post = Post::create($data);
        }catch (\Exception $exception){
            return response()->json([
                'database' => 'Failed to connect to the database'
            ]);
        }

        return new PostResource($post);
    }
}
