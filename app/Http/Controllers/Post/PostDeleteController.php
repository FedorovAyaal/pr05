<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Post\BasePostController;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;


class PostDeleteController extends BasePostController
{
    public function __invoke(Post $post)
    {
        Comment::where('post_id', $post->id)->delete();
        $post->delete();


        return redirect()->route('home');
    }
}
