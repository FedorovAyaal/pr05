@extends('layouts.layout')
@section('title')
    {{$post->title}}
@endsection
@section('head')
<link rel="shortcut icon" href="{{asset('storage/images/thumbnail/'.$post->image)}}" type="image/jpg">
@endsection

@section('content')

<div class="container mx-auto">
    <div class="flex flex-col space-y-4 bg-gray-200 rounded-xl p-10 mt-4">
        <div class="info">
            <small>{{ date_format($post->created_at,'d.m.Y, H:i:s')}}</small> @can('view',auth()->user()) <a href="{{route('login')}}" class="inline-block float-right text-sm px-4 py-2 leading-none border rounded text-teal-500 border-teal-500 hover:border-transparent hover:text-teal-500 hover:bg-white mt-4 lg:mt-0">Редактировать пост</a>  @endcan
        </div>
        <div class="title font-bold text-3xl">
            {{$post->title}}
        </div>
        <div class="content">
            <img src="{{asset('storage/images/origin/'.$post->image)}}" width="30%" class="w-full md:w-[30%] md:float-right lg:ml-3 " alt="">
            {!! $post->content !!}
        </div>
    </div>
</div>
@endsection