<?php

namespace App\Http\Controllers\Post;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Report;

class DeleteCommentController extends BasePostController
{
    public function __invoke(Request $request, Comment $comment)
    {
        Report::where('comment_id', $comment->id)->delete();
        $comment->delete();
        return back();
    }
}
