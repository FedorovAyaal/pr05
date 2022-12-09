<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield("head")


    <title> @yield('title') </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        input:-webkit-autofill,
        input:-webkit-autofill:focus {
            transition: background-color 600000s 0s, color 600000s 0s;
        }
        input[data-autocompleted] {
            background-color: transparent !important;
        }
    </style>
</head>
<body class="bg-gray-100">
<header class="w-full bg-red-500">


    <div class="container mx-auto w-4/5 px-5 ">
        <div class="flex items-center justify-between flex-wrap py-6">

            <div class="flex items-center flex-shrink-0 text-white mr-6">
                <img src="{{asset('image/logo14.png')}}" class="p-0 m-0 mr-3" alt="">
              <span class="font-semibold text-xl tracking-wide"><a href="{{route('home')}}">News Sakha<a></span>
            </div>
            <div class="block lg:hidden">
              <button class="flex items-center px-3 py-2 border rounded text-teal-200 border-teal-400 hover:text-white hover:border-white" id="menu-target">
                <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
              </button>
            </div>
            <div class="w-full hidden flex-grow lg:flex lg:items-center lg:w-auto" id="menu">
              <div class="text-sm lg:flex-grow @if(request()->get('search')) hidden @endif " id="menu-links">

                @foreach($all_categories as $category)
                <a href="{{route('post.by_category',$category->id)}}" class="block mt-4 lg:inline-block lg:mt-0 text-teal-100 hover:underline hover:underline-offset-4 hover:text-white mr-4">
                  {{$category->name}}
                </a>
                @endforeach
              
                
              </div>

              <div class="search-bar flex lg:flex-grow mt-4 lg:mt-0 @if(request()->get('search')) block @else hidden @endif " id="search-bar">
                <form action="{{route('post.by_search')}}" method="GET" class="inline w-full" id="searchForm">
                  <input type="text" name="search" class="p-2 mr-6 w-[100%] lg:w-[95%] rounded"               @if(request()->get('search'))
                  value = "{{request()->get('search')}}"
                  @endif placeholder="Поиск...">
                </form>
              </div>
              <input type="button" class="inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-teal-500 hover:bg-white mt-4 lg:mt-0 mr-10" value="Поиск" id="btnDropdownMenu">
              <div>

                @if(auth()->check())
                <img src="{{asset('storage/images/avatar/cropped/'.auth()->user()->avatar)}}" class="mt-4 lg:mt-0 h-14 rounded-full" alt="" id="searchBtn">


              <div id="dropdownMenu" class="hidden absolute mt-2 z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700">
                  <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefault">
                    @can('view',auth()->user())
                    <li>
                      <a href="{{route('post.create')}}" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Создать пост</a>
                    </li>
                    <li>
                      <a href="{{route('admin.reports')}}" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Жалобы</a>
                    </li>
                    @endcan
                    <li>
                      <a href="{{route('profile.index')}}" class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Профиль</a>
                    </li>
                    <li>
                      <form action="{{route('logout')}}" method="POST" class="w-full m-0">
                        @csrf
                        <button class=" text-left block py-2 px-4 hover:bg-gray-100 w-full dark:hover:bg-gray-600 dark:hover:text-white" type="submit">Выйти</button>
                    </form>
                  
                    </li>
                  </ul>
              </div>
                


                @else
                <a href="{{route('login')}}" class="inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-teal-500 hover:bg-white mt-4 lg:mt-0">Войти</a>
                <a href="{{route('register')}}" class="inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-teal-500 hover:bg-white mt-4 lg:mt-0">Регистрация</a>
                @endif
              </div>
            </div>
            
          </div>
    </div>

  </header>

      <div class="container mx-auto w-4/5">
        @yield('content')
        <div
	class="fixed hidden inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full"
	id="message-modal"
>
<!--modal content-->
<div
	class="relative top-20 mx-auto p-2 border w-[400px] shadow-lg rounded-md bg-white"
>
	<div class="mt-3 text-center">

		<h3 class="text-xl leading-6 font-medium text-gray-900">Сообщение</h3>
   
            
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-gray-500" id="message_pop">

                </p>
            </div>
            <div class="flex space-x-1 px-4 py-3">
                <button id="message-comment-btn" type="submit" class="px-4 py-2 bg-green-500 w-full text-white text-base font-medium rounded-md shadow-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-300">
                    OK
                </button>
            </div>
        
	</div>
</div>
</div>
      </div>
    

    <footer>
  
    </footer>
    <script src="{{asset('js/layout.js')}}"></script>
    @yield("scripts")

</body>
</html>