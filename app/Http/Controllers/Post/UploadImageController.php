<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\UploadImageRequest;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class UploadImageController extends Controller
{

    public function __invoke(UploadImageRequest $request, Post $post)
    {
        $data = $request->validated($request);

       $data['image'] = Storage::disk('public')->put('/images', $data['image']);

       $post->update($data);

       return new PostResource($post);
    }
}
