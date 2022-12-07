<?php

namespace App\Http\Controllers\Post;

use Illuminate\Http\Request;
use App\Models\Comment;

class UpdateCommentController extends BasePostController
{
    public function __invoke(Request $request, Comment $comment)
    {
        $data = $request->validate([
            'text' => 'required|string',
            'post_id' => 'required',
        ]);
        $data['text'] = nl2br($data['text']);
        $comment->update($data);
        return back();
    }
}
