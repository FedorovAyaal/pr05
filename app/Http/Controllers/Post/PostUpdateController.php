<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Post\BasePostController;
use App\Http\Requests\StorePostRequest;
use Illuminate\Http\Request;
use App\Models\Post;

class PostUpdateController extends BasePostController
{
    public function __invoke(Post $post)
    {

        return view('post.update', compact('post'));
    }
}
