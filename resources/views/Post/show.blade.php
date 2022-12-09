@extends('layouts.layout')
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title')
    {{$post->title}}
@endsection
<!--
Бан
Пожаловаться
Аватарка
-->

@section('content')

<div class="w-full lg:container mx-auto ">
    <div class="flex flex-col space-y-4 bg-gray-200 rounded-xl p-10 mt-4">
        <div class="info sm:block flex flex-wrap">
            <small class="text-xs lg:text-lg" >{{ date_format($post->created_at,'d.m.Y, H:i:s')}}</small> @can('view',auth()->user()) <div class="inline"> <button  class="inline sm:float-right text-sm px-4 py-2 leading-none border rounded text-red-500 border-red-500 hover:border-transparent hover:text-red-500 hover:bg-white mt-4 lg:mt-0 lg:ml-4" id="deletePostBtn">Удалить пост</button> <a href="{{route('post.update',$post->id)}}" class="inline-block sm:float-right text-sm px-4 py-2 leading-none border rounded text-teal-500 border-teal-500 hover:border-transparent hover:text-teal-500 hover:bg-white mt-4 lg:mt-0">Редактировать пост</a>  </div>@endcan
        </div>
        <div class="title font-bold text-sm lg:text-3xl">
            {{$post->title}}
        </div>
        <div class="content">
            <img src="{{asset('storage/images/origin/'.$post->image)}}" width="30%" class=" mb-4 lg:mb-0 rounded w-full md:w-[30%] md:float-right lg:ml-3 " alt="">
           <span class="text-xs lg:text-sm mt-4 lg:mt-0"> {!! $post->content !!} </span>
        </div>
    </div>
</div>
<div class="flex flex-col my-4 space-y-4 bg-gray-200 rounded-xl p-10">
    @if($post->comments_available == 1)
    <h1 class=" text-xl lg:text-2xl">Комментарии <span class="text-gray-400">{{count($post->comments)}}</span> </h1>
    @if(auth()->check())
    @if(auth()->user()->status == 2)
    <p class=" bg-gray-800 rounded text-white p-4 text-sm lg:text-lg">Вы не можете отправлять комментарии</p> 
    @else
    <div class="form">
        <form action="{{route('post.store_comment',$post->id)}}" method="POST" id="commentForm">
            @csrf
            <label for="message" class="block mb-2 text-xs lg:text-sm font-medium text-gray-900 dark:text-white">Ваш комментарий</label>

            <textarea id="message" name="text" rows="3" class="block p-2.5 w-full text-xs lg:text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Напишите что вы думаете о этой новости...">{{old('text')}}</textarea>
            </textarea> 
            <p class="text-gray-400"><small>Минимум 5 символов</small></p>
            @error('text')
            <p class="text-red-500 mt-4">{{$message}}</p>
            @enderror
            
            <input type="button" id="sendComment" value="Написать" class="text-sm px-4 py-2 leading-none border rounded text-teal-500 border-teal-500 hover:border-transparent hover:text-teal-500 hover:bg-white mt-4 ">
        </form>
       
    </div>
    @endif
    @else
    <p class=" bg-gray-800 rounded text-white p-4 text-xs lg:text-sm">Чтобы оставлять комментарии, пожалуйста, <a href="{{route('login')}}" class="text-green-500">войдите</a> .</p> 
    @endif
    <hr class="">
    <div class="flex flex-col space-y-4 comments">
        @if(auth()->check())
        @if(count($post->comments) == 0 && auth()->user()->status != 2)
        <p class=" bg-gray-800 rounded text-white p-4 text-xs lg:text-sm">Здесь пока нет комментариев. Станьте первым!</p> 
        @endif

      

        @endif
        @foreach($post->comments as $comment)
        

            <div class="border-b-2 border-gray-300 w-full py-4 flex space-y-0 space-x-6">
                <img class="block mx-0 h-12 lg:h-16 rounded-full shrink-0" src="{{asset('storage/images/avatar/cropped/'.$comment->author->avatar)}}" alt="Avatar">
                <div class="space-y-2">
                  <div class="space-y-0.5">
                    <p class="text-xs text-slate-500">{{date_format($comment->updated_at,'d.m.Y, H:i:s')}}</p>
                    <p class="text-sm lg:text-lg text-black font-semibold">
                        {{$comment->author->first_name}} {{$comment->author->last_name}}
                    </p>
                    <p class="text-xs lg:text-sm">{!! $comment->text !!}</p>
                  </div>
                  @if(auth()->check() && auth()->user()->id == $comment->author->id OR auth()->check() && auth()->user()->status == 1)
                  <form action="{{route('post.delete_comment',$comment->id)}}" id="hoh" method="POST" class="inline">
                      @csrf
                      @method('delete')
                      <button class=" py-1 mr-4 text-xs lg:text-sm text-purple-600 font-semibold rounded-full   hover:text-red-400 " id="deleteComment" type="submit">Удалить</button>
                  </form>
                      @if(auth()->user()->id == $comment->author->id )
                      <button class="py-1 text-xs lg:text-sm text-purple-600 font-semibold rounded-full   hover:text-green-500 "  id="editComment" onclick="edit({{$comment}})">Редактировать</button>
           
                      @endif
                  @endif
                  @if(auth()->check() && auth()->user()->id != $comment->author->id && auth()->check() && auth()->user()->status != 2)
                  <button class="py-1 text-xs lg:text-sm text-purple-600 font-semibold rounded-full  hover:text-yellow-500" type="submit" id="reportComment" onclick="report({{$comment}})">Пожаловаться</button>
                 
                  @endif

                 

                </div>

              </div>

        

    @endforeach
    

    </div>
    @else
    <h1 class="text-gray-500">Комментарии к этой новости отключены.</h1>
    @endif
</div>

<div
	class="fixed hidden inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full"
	id="my-modal"
>
<!--modal content-->
<div
	class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white"
>
	<div class="mt-3 text-center">

		<h3 class="text-lg leading-6 font-medium text-gray-900">Вы точно хотите удалить пост?</h3>
		<div class="mt-2 px-7 py-3">
			<p class="text-xs text-gray-500">
				Это действие нельзя будет отменить
			</p>
		</div>
		<div class="flex space-x-1 px-4 py-3">
            <form action="{{route('post.delete',$post->id)}}" method="POST" class="w-1/2">
                @method('delete')
                @csrf
                <button id="ok-btn" type="submit" class="px-4 py-2 bg-green-500 w-full text-white text-base font-medium rounded-md shadow-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-300">
                    Да
                </button>
            </form>



            <button id="cancel-btn" class="px-4 py-2 bg-red-500 text-white text-base font-medium rounded-md w-1/2 shadow-sm hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300">
				Нет
			</button>
		</div>
	</div>
</div>
</div>


<div
	class="fixed hidden inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full"
	id="update-comment-modal"
>
<!--modal content-->
<div
	class="relative top-20 mx-auto p-2 border w-[500px] shadow-lg rounded-md bg-white"
>
	<div class="mt-3 text-center">

		<h3 class="text-lg leading-6 font-medium text-gray-900">Редактирование комментария</h3>
        <form method="POST" class="w-full" id="updateCommentForm">
            @method('patch')
            @csrf
            <input type="hidden" name="post_id" value="{{$post->id}}">
            <div class="mt-2 px-7 py-3">
                <p class="text-xs text-gray-500">
                    <textarea id="comment_message" name="text" rows="3" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Напишите что вы думаете о этой новости..."></textarea>
                    </textarea> 
                </p>
            </div>
            <div class="flex space-x-1 px-4 py-3">
                <button id="update-comment-btn" type="submit" class="px-4 py-2 bg-green-500 w-1/2 text-white text-base font-medium rounded-md shadow-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-300">
                    Редактировать
                </button>
                <button id="cancel-comment-btn" type="button" class="px-4 py-2 bg-red-500 text-white text-base font-medium rounded-md w-1/2 shadow-sm hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300">
                    Отменить
                </button>
            </div>
        </form>
	</div>
</div>
</div>

<div
	class="fixed hidden inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full"
	id="report-comment-modal"
>
<!--modal content-->
<div
	class="relative top-20 mx-auto p-2 border w-[400px] shadow-lg rounded-md bg-white"
>
	<div class="mt-3 text-center">

		<h3 class="text-xl leading-6 font-medium text-gray-900">Пожаловаться</h3>
            
            <input type="hidden" name="post_id" value="{{$post->id}}">
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-gray-500">

                    <select name="reason_id" id="reasons" class="w-full active:border-0 border-0 focus:border-0 outline-none">
                        @foreach($reasons as $reason)
                        <option value="{{$reason->id}}">{{$reason->name}}</option>
                        @endforeach
                        
                    </select>

                </p>
            </div>
            <div class="flex space-x-1 px-4 py-3">
                <button id="report-comment-btn" type="button" class="px-4 py-2 bg-green-500 w-1/2 text-white text-base font-medium rounded-md shadow-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-300">
                    Отправить
                </button>
                <button id="cancel-report-btn" type="button" class="px-4 py-2 bg-red-500 text-white text-base font-medium rounded-md w-1/2 shadow-sm hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300">
                    Отменить
                </button>
            </div>
        
	</div>
</div>
</div>

@endsection
@section('scripts')
<script src="{{asset('js/commentFilter.js')}}"></script>
<script src="{{asset('js/comment.js')}}"></script>
@endsection