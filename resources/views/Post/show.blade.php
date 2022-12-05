@extends('layouts.layout')
@section('title')
    {{$post->title}}
@endsection


@section('content')

<div class="container mx-auto">
    <div class="flex flex-col space-y-4 bg-gray-200 rounded-xl p-10 mt-4">
        <div class="info">
            <small >{{ date_format($post->created_at,'d.m.Y, H:i:s')}}</small> @can('view',auth()->user()) <a href="{{route('login')}}" class="inline-block sm:float-right text-sm px-4 py-2 leading-none border rounded text-teal-500 border-teal-500 hover:border-transparent hover:text-teal-500 hover:bg-white mt-4 lg:mt-0">Редактировать пост</a>  @endcan
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
<div class="flex flex-col space-y-4 bg-gray-200 rounded-xl p-10 mt-4">
    @if($post->comments_available == 1)
    <h1 class="text-2xl">Комментарии <span class="text-gray-400">{{count($post->comments)}}</span> </h1>
    @if(auth()->check())
    <div class="form">
        <form action="{{route('post.store_comment',$post->id)}}" method="POST">
            @csrf
            <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ваш комментарий</label>

            <textarea id="message" name="text" rows="3" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Напишите что вы думаете о этой новости...">{{old('text')}}</textarea>
            </textarea> 
            <p class="text-gray-400"><small>Минимум 20 символов</small></p>
            @error('text')
            
            <p class="text-red-500 mt-4">{{$message}}</p>
            @enderror
            <input type="submit" value="Написать" class="text-sm px-4 py-2 leading-none border rounded text-teal-500 border-teal-500 hover:border-transparent hover:text-teal-500 hover:bg-white mt-4 ">
        </form>
    </div>
    @else
    <p class=" bg-gray-800 rounded text-white p-4">Чтобы оставлять комментарии, пожалуйста, <a href="{{route('login')}}" class="text-green-500">войдите</a> .</p> 
    @endif
    <hr class="">
    <div class="flex flex-col space-y-4 comments">
        @if(auth()->check())
        @if(count($post->comments) == 0)
        <p class=" bg-gray-800 rounded text-white p-4">Здесь пока нет комментариев. Станьте первым!</p> 
        @endif

      

        @endif
        @foreach($post->comments as $comment)
        <div class="comment bg-slate-300 p-5 rounded-xl">
            <small>{{date_format($comment->created_at,'d.m.Y, H:i:s')}}</small>
            <p class="font-bold text-gray-700">{{$comment->author->name}}</p>
            <p class="">{!!$comment->text!!}</p>
        </div>
    @endforeach
    </div>
    @else
    <h1 class="text-gray-500">К сожалению, комментарии к этой новости отключены.</h1>
    @endif
</div>
@endsection