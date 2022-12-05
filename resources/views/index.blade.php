@extends('layouts.layout')
@section('title')
    Главные новости
@endsection

@section('content')
<div class="flex flex-col lg:flex-row mt-4 " >
    <div class="flex-1">
        <div class="left-news flex flex-col space-y-4 ">
        @foreach($mainNew as $post)
        <div class="main-new text-white relative">
            <a href="{{route('post.show',$post->slug)}}" ><img src="{{asset('storage/images/origin/'.$post->image)}}" class="rounded-xl w-full lg:w-[90%] transition-all duration-200 hover:transform hover:scale-95" alt=""></a>
            <p class="font-bold text-xl absolute bottom-6 left-6 w-2/3">
                <a href="{{route('post.show',$post->slug)}}" class="hover:text-red-500 transition-all duration-400">{{$post->title}}</a> <br>
                <span class="text-xs">{{date_format($post->created_at,'d.m.Y, H:i:s')}}</span>
            </p>
        </div>
        @endforeach

        </div>
    </div>
    <div class="flex-1 ">
        <div class="left-news flex flex-col sm:mt-4 space-y-4 ">
            @foreach($threePosts as $post)
            <div class="item p-6 bg-gray-200 rounded-xl">
                <div class="up-info italic text-gray-500"><small>От {{$post->owner->name}}</small></div>
                <p class="font-bold text-xl text-gray-700"><a href="{{route('post.show',$post->slug)}}" class="hover:text-red-500 transition-all duration-400">{{$post->title}}</a></p>
                <div class="content truncate sm:w-[300px] lg:w-[500px] text-gray-900">{{$post->content}}</div>
                <div class="info italic text-gray-500"><small>{{date_format($post->created_at,'d.m.Y, H:i:s')}} Категория: {{$post->category->name}}</small></div>
            </div>
            @endforeach
        </div>
    </div>

</div>

@endsection