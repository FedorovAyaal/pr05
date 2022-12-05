<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;

class IndexController extends Controller
{
    public function __invoke()
    {
        $mainNew = Post::inRandomOrder()->limit(3)->get();;
        $threePosts = Post::all();
        return view('index', compact('threePosts', 'mainNew'));
    }
}
