<?php

namespace App\Services\Post;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class Service
{
    public function store($data)
    {
        $data['slug'] = Str::slug($data['title'], '_');

        if ($data['image'] != null) {
            $unpreparedFilename = $data['image']->getClientOriginalName();
            $ext = pathinfo($unpreparedFilename, PATHINFO_EXTENSION);
            $filename = $data['slug'] . '.' . $ext;
            $data['image']->move(Storage::path('/public/images/') . 'origin/', $filename);

            $thumbnail = Image::make(Storage::path('/public/images/') . 'origin/' . $filename);
            $thumbnail->fit(250, 350);
            $thumbnail->save(Storage::path('/public/images/') . 'thumbnail/' . $filename);

            $data['image'] = $filename;
        } else {
            $data['image'] = 'photo_not_exists.jpg';
        }
        $data['content'] = nl2br($data['content']);
        Post::create($data);
    }
}
