<?php

namespace App\Http\Controllers\Post;

use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class StoreUpdatePostController extends BasePostController
{

    public function __invoke(UpdatePostRequest $request, Post $post)
    {
        $data = $request->validated();
        $data['image'] = $request->file('image');
        $this->service->update($data, $post);
        return redirect()->route('post.show', $post->slug);
    }
}
