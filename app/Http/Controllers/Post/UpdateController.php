<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\UpdateRequest;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{

    public function __invoke(UpdateRequest $request, Post $post)
    {

        $data = $request->validated($request);

        isset($data['image']) ? $data['image'] = Storage::disk('public')->put('/images', $data['image']) : '';
        $data['image'] = Storage::disk('public')->url($data['image']);

        $post->update($data);

        return new PostResource($post);
    }
}
