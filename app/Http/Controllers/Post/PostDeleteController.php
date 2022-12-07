<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Post\BasePostController;
use Illuminate\Http\Request;
use App\Models\Post;

class PostDeleteController extends BasePostController
{
    public function __invoke(Post $post)
    {
        $post->delete();
        return redirect()->route('home');
    }
}
