<?php

namespace App\Http\Controllers\Post;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Reason;

class ShowPostController extends BasePostController
{
    public function __invoke(Request $request, $slug)
    {
        $post = Post::where('slug', $slug)->first();
        $reasons = Reason::all();
        return view('post.show', compact('post', 'reasons'));
    }
}
