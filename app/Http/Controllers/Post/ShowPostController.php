<?php

namespace App\Http\Controllers\Post;

use Illuminate\Http\Request;
use App\Models\Post;

class ShowPostController extends BasePostController
{
    public function __invoke(Request $request, $slug)
    {
        $post = Post::where('slug', $slug)->first();
        return view('post.show', compact('post'));
    }
}
