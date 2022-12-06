<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class CategoryController extends Controller
{
    public function __invoke($id)
    {
        $mainNew = Post::where('category_id', $id)->inRandomOrder()->limit(3)->get();;
        $threePosts =  Post::where('category_id', $id)->orderBy('id', 'DESC')->get();
        return view('index', compact('threePosts', 'mainNew'));
    }
}
