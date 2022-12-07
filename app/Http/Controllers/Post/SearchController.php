<?php

namespace App\Http\Controllers\Post;

use Illuminate\Http\Request;
use App\Models\Post;

class SearchController extends BasePostController
{
    public function __invoke(Request $request)
    {
        $search = $request->input('search');
        $mainNew = Post::where('title', 'like', '%' . $search . '%')->orWhere('content', 'like', '%' . $search . '%')->inRandomOrder()->limit(4)->get();;
        $threePosts =  Post::where('title', 'like', '%' . $search . '%')->orWhere('content', 'like', '%' . $search . '%')->orderBy('id', 'DESC')->get();
        return view('index', compact('threePosts', 'mainNew'));
    }
}
