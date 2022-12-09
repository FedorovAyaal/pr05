@extends('layouts.layout')
@section('title')
    Профиль {{auth()->user()->name}}
@endsection

@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="shortcut icon" href="{{asset('storage/images/avatar/cropped/'.auth()->user()->avatar)}}" type="image/png">
@endsection

@section('content')
    <div class="lg:flex-col flex-row mt-4 ">
        <div class="flex-1">
            <p class="text-4xl">Профиль</p>
            <div class="user-info mt-4 font-medium">
                <form method="POST" action="{{route('profile.change_info')}}">
                    @csrf
                    <p class="flex p-5"><span class="flex-1">Логин:</span>
                        <span class="flex-1">
                           <input value="{{auth()->user()->name}}" name="name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" value="{{old('name')}}" >
                           <p class="ml-5 text-red-500"><small>
                           @error('name') {{$message}} @enderror    
                           </small></p>
                       </span>
                       </p>
                   <p class="flex p-5"><span class="flex-1">Почта:</span>
                   <span class="flex-1">
                       <input value="{{auth()->user()->email}}" name="email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"  value="{{old('email')}}" >    
                   </span>
                   <p class="ml-5 text-red-500"><small>@error('email') {{$message}} @enderror    </small></p></p>
                   <p class="flex p-5"><span class="flex-1">Имя:</span>
                        <span class="flex-1"><input value="{{auth()->user()->first_name}}" name="first_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"  value="{{old('first_name')}}" ></span>
                        <p class="ml-5 text-red-500"><small>@error('first_name') {{$message}} @enderror    </small></p>
                       </p>
                   <p class="flex p-5"><span class="flex-1">Фамилия:</span> <span class="flex-1"><input value="{{auth()->user()->last_name}}" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" name="last_name"  value="{{old('last_name')}}" ></span>
                       <p class="ml-5 text-red-500"><small>@error('last_name') {{$message}} @enderror    </small></p></p>
                       <input type="submit" value="Сохранить" class="p-3 px-4 bg-green-400 text-white mt-4 rounded-lg">
                </form>
            </div>
        </div>
        <div class="flex flex-col lg:flex-row mt-5">
            <div class="flex-1 ">
                <div>
                    <p class="text-4xl">Аватар</p>
                    <div class="user-avatar mt-4 font-medium">
                        <img src="{{asset('storage/images/avatar/cropped/'.auth()->user()->avatar)}}" id="myimage"  class="h-32 w-32 rounded-full" alt="">
                        <form method="post" enctype="multipart/form-data" class="inline" action="{{route('profile.change_avatar')}}">
                            @csrf
                            <label class="input-file">
                                   <input type="file" name="avatar" onchange="onFileSelected(event)" class="font-medium mt-4" accept="image/png, image/jpeg"  >
                             </label><br>
                             <input type="submit" value="Изменить" class="p-3 px-4 bg-green-400 text-white mt-12 rounded-lg">
                        </form>
    
                    </div>
                </div>
                
            </div>
            <div class="flex-1 mt-4 lg:mt-0 mb-4">
                <div>
                    <p class="text-4xl">Пароль</p>
                    <div class="mt-4 font-medium">

                     
                            <div class="relative z-0 mb-6 w-full group">
                                <input type="password" name="new_password" id="new_password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" required />
                                @error('password')
                                <p class="text-red-500"><small>{{$message}}</small></p>
                                @enderror
                                <label for="floating_password" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Новый пароль</label>
                                
                            </div>
                            <div class="relative z-0 mb-6 w-full group">
                                <input type="password" name="confirm_new_password" id="confirm_new_password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" required />
                                @error('password')
                                <p class="text-red-500"><small>{{$message}}</small></p>
                                @enderror
                                <label for="floating_password" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Подтвердите пароль</label>
                                
                            </div>
                            <div class="relative z-0 mb-6 w-full group">
                                <input type="password" name="current_password" id="current_password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" required />
                                @error('password')
                                <p class="text-red-500"><small>{{$message}}</small></p>
                                @enderror
                                <label for="floating_password" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Текущий пароль</label>
                                
                            </div>
                             <input type="submit" id="change_password_btn" value="Изменить пароль" class="p-3 px-4 bg-green-400 text-white mt-4 rounded-lg">
                 
    
                    </div>
                </div>
                
            </div>

        </div>
        <div class=" mt-4  mb-4">
            <div>
                <p class="text-4xl">Мои комментарии</p>
                <div class="mt-4 font-medium">
                    @if(auth()->user()->comments->count() == 0)
                    <p class=" bg-gray-800 rounded text-white p-4 text-xs lg:text-sm">У вас нет комментариев</p> 
                    @endif
                 @foreach(auth()->user()->comments as $comment)
                 <div class="w-full py-4 flex space-y-0 space-x-6 bg-slate-200 rounded-lg p-4 mt-4 ">
                    <img class="block mx-0 h-12 lg:h-16 rounded-full shrink-0" src="{{asset('storage/images/avatar/cropped/'.$comment->author->avatar)}}" alt="Avatar">
                    <div class="space-y-2">
                      <div class="space-y-0.5">
                        <p class="text-xs text-slate-500">{{date_format($comment->created_at,'d.m.Y, H:i:s')}}  - <span class="italic font-bold">
                             <a href="{{route('post.show',$comment->post->slug)}}">{{$comment->post->title}}</a></span></p>
                        <p class="text-sm lg:text-lg text-slate-700 font-semibold">
                            {{$comment->author->first_name}} {{$comment->author->last_name}}
                        </p>
                        <p class="text-xs lg:text-sm text-slate-500">{!! $comment->text !!}</p>
                      </div>

    
                     
    
                    </div>
    
                  </div>
                 @endforeach
                        
                </div>
            </div>
            
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/profile.js')}}" ></script>    
@endsection
