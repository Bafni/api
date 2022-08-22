<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\IndexRequest;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;

class IndexController extends Controller
{

    public function __invoke(IndexRequest $request)
    {
        $data = $request->validated($request);
        $page = $data['page'] ?? 1; // номер сторінки
        $perPage = $data['per_page'] ?? 10; // кількість постів на сторінці
        $posts = Post::paginate($perPage, ['*'], 'page', $page );
        return PostResource::collection($posts);
    }
}
