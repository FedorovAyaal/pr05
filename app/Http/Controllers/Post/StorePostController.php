<?php

namespace App\Http\Controllers\Post;

use App\Http\Requests\StorePostRequest;
use Illuminate\Http\Request;


class StorePostController extends BasePostController
{
    public function __invoke(StorePostRequest $request)
    {
        $data = $request->validated();
        $data['image'] = $request->file('image');
        $data['user_id'] = auth()->user()->id;
        $this->service->store($data);
        return redirect()->route('home');
    }
}
