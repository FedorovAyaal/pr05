<?php

namespace App\Http\Controllers\Post;

use App\Models\Comment;
use Illuminate\Http\Request;

class DeleteCommentController extends BasePostController
{
    public function __invoke(Request $request, Comment $comment)
    {
        $comment->delete();
        return back();
    }
}
