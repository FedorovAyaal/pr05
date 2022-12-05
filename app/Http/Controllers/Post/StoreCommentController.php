<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Post\BasePostController;
use App\Http\Requests\StoreCommentRequest;
use Illuminate\Http\Request;
use App\Models\Comment;

class StoreCommentController extends BasePostController
{
    public function __invoke(StoreCommentRequest $request, $post_id)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        $data['post_id'] = $post_id;
        $data['text'] = nl2br($data['text']);
        Comment::create($data);
        return back();
    }
}
